<?php
function getNotifData()
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    // Fetch user-specific classes from the database
    $class_ids = [];
    $sql = "SELECT class_id FROM class_people WHERE user_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $class_ids[] = $row['class_id'];
        }
        $stmt->close();
    }

    // Format class IDs for the SQL query
    if (!empty($class_ids)) {
        $placeholders = implode(',', array_fill(0, count($class_ids), '?'));
    } else {
        $placeholders = ''; // Handle the case where there are no class IDs
    }

    // Construct the SQL query for joining tables
    if (!empty($placeholders)) {
        $query = "SELECT notifications.*, users.*
                  FROM notifications
                  JOIN users ON users.user_id = notifications.user_id
                  WHERE (users.user_id = ? OR (notifications.included_id IN ($placeholders) AND notifications.notification_type = 'activity'))";
    } else {
        if ($_SESSION['usertype'] == 1) {
            $query = "SELECT notifications.*, users.*
            FROM notifications
            JOIN users ON users.user_id = notifications.user_id
            WHERE users.user_id = ?";
        } else {
            $query = "SELECT notifications.*, users.*
            FROM notifications
            JOIN users ON users.user_id = notifications.user_id";
        }
    }

    // Prepare and execute the SQL query
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters
        if (!empty($placeholders)) {
            $types = str_repeat('i', count($class_ids) + 1); // 'i' for integer type
            $params = array_merge([$user_id], $class_ids);
            $stmt->bind_param($types, ...$params);
        } else if ($_SESSION['usertype'] == 1) {
            $stmt->bind_param('i', $user_id);
        }

        // Execute the statement
        $stmt->execute();

        // Fetch results
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        // Close the statement
        $stmt->close();
        return $data;
        // Return the result as JSON
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Query preparation failed.']);
    }
}
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="min-height: 580px;">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="d-flex gap-2 ">
                            <i class="fa fa-bell text-primary text-sm opacity-10"></i>
                            <h6 class="mb-0">Notification</h6>
                        </div>
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#people" class="btn btn-outline-success btn-sm mb-0">
                                Mark all as read
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-items-center mb-0 table-data">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Notification</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Notified Date</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $notification = getNotifData();
                            ?>
                            <?php foreach ($notification as $notif): ?>
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 ps-3"><?= $notif['notification_title'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"><?= $notif['notification_description'] ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 ps-3"><?= date('F d, Y', strtotime($notif['notification_datetime'])) ?></p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0"></p>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>