<?php
require_once('../config/config.php');

$days = [
    'monday',
    'tuesday',
    'wednesday',
    'thursday',
    'friday',
    'saturday',
    'sunday'
];

if (isset($_GET['getSchedules'])) {
    $schedules = [];
    foreach ($days as $day) {
        $conditions = [
            'schedule.' . $day => 1,
            'schedule_time.day' => $day
        ];

        if (isset($_GET['teacher']) && $_GET['teacher'] != '' && $_GET['teacher'] != 'All') {
            $conditions['users.user_id'] = $_GET['teacher'];
        }

        $find_time = joinTable('schedule', [
            ['schedule_time', 'schedule_time.schedule_id', 'schedule.schedule_id'],
            ['class', 'class.class_id', 'schedule.class_id'],
            ['users', 'users.user_id', 'class.user_id']
        ], $conditions);

        if ($find_time) {
            foreach ($find_time as &$time) {
                $time['timefrom'] = getDayDate($day) . ' ' . $time['timefrom'];
                $time['timeto'] = getDayDate($day) . ' ' . $time['timeto'];
                $time['day_mean'] = $day;
            }
            $schedules = array_merge($schedules, $find_time);
        }
    }

    // usort($schedules, function ($a, $b) {
    //     $timeA = strtotime($a['timefrom']);
    //     $timeB = strtotime($b['timefrom']);
    //     return $timeA - $timeB;
    // });

    http_response_code(200);
    echo json_encode(["status" => "success", "data" => $schedules]);
}

if (isset($_GET['schedule_details'])) {
    $find_time = firstJoin('schedule', [
        ['schedule_time', 'schedule_time.schedule_id', 'schedule.schedule_id'],
        ['class', 'class.class_id', 'schedule.class_id'],
        ['users', 'users.user_id', 'class.user_id']
    ], ['schedule_time.scheduletime_id' => $_GET['scheduletime_id']]);

    if ($find_time) {
        $find_time['timefrom'] = getDayDate('monday') . ' ' . $find_time['timefrom'];
        $find_time['timeto'] = getDayDate('monday') . ' ' . $find_time['timeto'];
    }

    http_response_code(200);
    echo json_encode(["status" => "success", "data" => $find_time]);
}

// echo '<pre>' . print_r($schedules, true) . '</pre>';

function getDayDate($day)
{
    $today = date('Y-m-d');
    $dayOfWeek = date('w', strtotime($today)); // Numeric value for the day (0=Sunday, 1=Monday, ..., 6=Saturday)

    // If today is Sunday, treat Sunday as the start of the week and calculate the next days from there
    if ($dayOfWeek == 0) {
        // Get the current Sunday date
        $sundayDate = date('Y-m-d', strtotime('sunday'));

        switch (strtolower($day)) {
            case 'sunday':
                return $sundayDate; // Return Sunday date
            case 'monday':
                return date('Y-m-d', strtotime($sundayDate . ' +1 day')); // Monday is the next day after Sunday
            case 'tuesday':
                return date('Y-m-d', strtotime($sundayDate . ' +2 days')); // Tuesday is two days after Sunday
            case 'wednesday':
                return date('Y-m-d', strtotime($sundayDate . ' +3 days')); // Wednesday is three days after Sunday
            case 'thursday':
                return date('Y-m-d', strtotime($sundayDate . ' +4 days')); // Thursday is four days after Sunday
            case 'friday':
                return date('Y-m-d', strtotime($sundayDate . ' +5 days')); // Friday is five days after Sunday
            case 'saturday':
                return date('Y-m-d', strtotime($sundayDate . ' +6 days')); // Saturday is six days after Sunday
            default:
                return "Invalid day provided!";
        }
    }

    $mondayDate = date('Y-m-d', strtotime('monday this week'));
    // If today is not Sunday, calculate the days based on the current week
    switch (strtolower($day)) {
        case 'sunday':
            return date('Y-m-d', strtotime($mondayDate . ' -1 day'));
        case 'monday':
            return $mondayDate;
        case 'tuesday':
            return date('Y-m-d', strtotime($mondayDate . ' +1 day'));
        case 'wednesday':
            return date('Y-m-d', strtotime($mondayDate . ' +2 days'));
        case 'thursday':
            return date('Y-m-d', strtotime($mondayDate . ' +3 days'));
        case 'friday':
            return date('Y-m-d', strtotime($mondayDate . ' +4 days'));
        case 'saturday':
            return date('Y-m-d', strtotime($mondayDate . ' +5 days'));
        default:
            return "Invalid day provided!";
    }
}






// }