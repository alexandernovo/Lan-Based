<?php
// Get the absolute path to the root directory
$rootPath = realpath(dirname(__FILE__) . '/..');

// Absolute path to config.json
$configFilePath = $rootPath . '/config.json';

if (!file_exists($configFilePath)) {
	die('Error: config.json file not found');
}

$config_data = file_get_contents($configFilePath);
if ($config_data === false) {
	die('Error reading config.json');
}

$config_json = json_decode($config_data, true);
if ($config_json === null && json_last_error() !== JSON_ERROR_NONE) {
	die('Error decoding config.json: ' . json_last_error_msg());
}

$ip_address = $config_json['ip_address'];
// echo $ip_address;
define('HOST_NAME', $ip_address); // Use IP address instead of 'localhost'
define('PORT', 8090);
$null = NULL;

require_once('class.broadcasthandler.php');
$broadcastHandler = new BroadcastHandler();

// Create a TCP/IP socket resource
if (($socketResource = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
	echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
	exit;
}

// Set socket options
if (!socket_set_option($socketResource, SOL_SOCKET, SO_REUSEADDR, 1)) {
	echo "socket_set_option() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
	exit;
}

// Bind the socket to an address and port
if (!socket_bind($socketResource, HOST_NAME, PORT)) {
	echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($socketResource)) . "\n";
	exit;
}

// Listen for incoming connections
if (!socket_listen($socketResource, 5)) {
	echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($socketResource)) . "\n";
	exit;
}

$clientSocketArray = array($socketResource);

while (true) {
	$newSocketArray = $clientSocketArray;
	// Perform a select() system call to check for new incoming data
	if (socket_select($newSocketArray, $null, $null, 0, 10) === false) {
		echo "socket_select() failed: reason: " . socket_strerror(socket_last_error($socketResource)) . "\n";
		exit;
	}

	if (in_array($socketResource, $newSocketArray)) {
		// Accept a new connection
		if (($newSocket = socket_accept($socketResource)) === false) {
			echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($socketResource)) . "\n";
			continue;
		}
		// Add the new socket to the client socket array
		$clientSocketArray[] = $newSocket;

		// Perform WebSocket handshake
		$header = socket_read($newSocket, 1024);
		$broadcastHandler->doHandshake($header, $newSocket, HOST_NAME, PORT);

		// Get client IP address
		socket_getpeername($newSocket, $client_ip_address);
		// Send connection acknowledgement message
		$connectionACK = $broadcastHandler->newConnectionACK($client_ip_address);
		$broadcastHandler->send($connectionACK, $clientSocketArray);

		// Remove the server socket from the new socket array
		$newSocketIndex = array_search($socketResource, $newSocketArray);
		unset($newSocketArray[$newSocketIndex]);
	}

	foreach ($newSocketArray as $newSocketArrayResource) {
		// Receive data from clients
		while (socket_recv($newSocketArrayResource, $socketData, 1024, 0) >= 1) {
			$socketMessage = $broadcastHandler->unseal($socketData);
			$messageObj = json_decode($socketMessage);

			// Check if the message is an announcement
			if (isset($messageObj->name) && $messageObj->name === 'announcement') {
				// Create announcement message and broadcast it
				$chat_box_message = $broadcastHandler->createAnnouncementMessage($messageObj->data);
				$broadcastHandler->send($chat_box_message, $clientSocketArray);
			}
			if (isset($messageObj->name) && $messageObj->name === 'notification') {
				// Create announcement message and broadcast it
				$chat_box_message = $broadcastHandler->createNotificationtMessage($messageObj->data);
				$broadcastHandler->send($chat_box_message, $clientSocketArray);
			}
			break 2;
		}

		// Handle client disconnection
		$socketData = @socket_read($newSocketArrayResource, 1024, PHP_NORMAL_READ);
		if ($socketData === false) {
			socket_getpeername($newSocketArrayResource, $client_ip_address);
			$connectionACK = $broadcastHandler->connectionDisconnectACK($client_ip_address);
			$broadcastHandler->send($connectionACK, $clientSocketArray);

			$newSocketIndex = array_search($newSocketArrayResource, $clientSocketArray);
			unset($clientSocketArray[$newSocketIndex]);
		}
	}
}

// Close the socket resource
socket_close($socketResource);
