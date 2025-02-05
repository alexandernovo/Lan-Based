<?php
$days = [
    'monday',
    'tuesday',
    'wednesday',
    'thursday',
    'friday',
    'saturday',
    'sunday'
];

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

function arrangeSchedule($data)
{
    // Sort the data by time from earliest to latest
    usort($data, function ($a, $b) {
        return strtotime($a['timefrom']) - strtotime($b['timefrom']);
    });

    // Prepare an empty array for each day's schedule (Monday to Sunday)
    $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
    $schedule = array_fill_keys($daysOfWeek, []);

    // Group the data by day
    foreach ($data as $item) {
        $day = strtolower($item['day']);
        if (in_array($day, $daysOfWeek)) {
            $schedule[$day][] = $item;
        }
    }

    // Prepare the table
    echo "<table class='table table-bordered w-100' border='1' cellspacing='0' cellpadding='5'>";
    echo "<thead><tr>";

    // Table headers (Days of the week)
    foreach ($daysOfWeek as $day) {
        echo "<th>" . ucfirst($day) . "</th>";
    }

    echo "</tr></thead><tbody>";

    // Now, loop through the maximum number of rows (based on the day with the most classes)
    $maxRows = max(array_map('count', $schedule));

    // Output rows
    for ($i = 0; $i < $maxRows; $i++) {
        echo "<tr>";
        foreach ($daysOfWeek as $day) {
            if (isset($schedule[$day][$i])) {
                $item = $schedule[$day][$i];
                echo "<td class='text-wrap'>";
                echo "<strong>Time: </strong><span>" . date('h:i A', strtotime($item['timefrom'])) . " - " . date('h:i A', strtotime($item['timeto'])) . "</span><br>";
                echo "<strong>Class: </strong><span>" . $item['classname'] . "</span><br>";
                echo "<strong>Course: </strong><span>" . $item['course'] . " " . $item['section'] . " " . $item['program'] . "</span><br>";
                echo "<strong>Instructor: </strong><span>" . $item['firstname'] . " " . $item['lastname'] . "</span><br>";
                echo "<strong>Lab: </strong><span>" . ($item['classroom_lab'] ? $item['classroom_lab'] : 'Not specified') . "</span>";
                echo "</td>";
            } else {
                echo "<td class='text-wrap border'></td>";
            }
        }
        echo "</tr>";
    }

    echo "</tbody></table>";
}
?>
<style>
    th {
        background-color: gray !important;
        color: white !important;
        text-align: center !important;
        width: 20% !important;
    }

    @media print {

        @page {
            size: 11in 8.5in;
            margin: 0.5in;
        }

        /* Ensure content fits within the 11x8.5 layout */
        body {
            margin: 0;
            padding: 0;
        }

        /* Make sure the container is flexible to the page size */
        #printthis {
            width: 100%;
            height: 100%;
            page-break-before: always;
        }

        /* You can also adjust other elements like fonts or page breaks here */
        .container-fluid,
        .row,
        .col-12 {
            width: 100%;
            page-break-inside: avoid;
        }

        /* Optional: Customize the layout of specific elements for printing */
        .d-flex {
            display: flex;
        }

        .border {
            border: 1px solid #000;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .btn {
            display: none;
            /* Hide print button in print */
        }
    }
</style>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-primary mb-1" onclick="printContent()">
                <i class="fa fa-print"></i>
                Print
            </button>
        </div>
        <div class="col-12" id="printthis">
            <div class="border bg-white rounded" style="min-height: 8.5in; padding:0.5in">
                <div style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom:5px">
                    <img src="public/assets/img/logoantique.png" alt="" style="width: 80px; height: 80px">
                    <div>
                        <p class="mb-0" style="text-align: center;">UNIVERSITY OF ANTIQUE TARIO-LIM MEMORIAL CAMPUS TIBIAO ANTIQUE COLLEGE OF COMPUTER STUDIES</p>
                    </div>
                    <img src="public/assets/img/logo.png" alt="" style="width: 80px; height: 80px">
                </div>
                <div class="mt-2">
                    <?php
                    arrangeSchedule($schedules);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printContent() {
        var printContents = document.getElementById('printthis').innerHTML;
        var originalContents = document.body.innerHTML;

        // Create a temporary iframe to handle the print content and apply print styles
        var iframe = document.createElement('iframe');
        iframe.style.position = 'absolute';
        iframe.style.width = '0px';
        iframe.style.height = '0px';
        iframe.style.border = 'none';

        // Append iframe to the body
        document.body.appendChild(iframe);

        // Get the iframe document and write content into it
        var iframeDoc = iframe.contentWindow.document;

        // Write the header content to the iframe, including print styles
        iframeDoc.open();
        iframeDoc.write(`
        <html>
            <head>
                <style>
                    #printthis {
                    width: 100%;
                    min-height: 8.5in;
                    padding: 0.5in;
                    box-sizing: border-box;
                    background-color: white;
                    border: 1px solid #ccc;
                    border-radius: 8px;
                }

                #printthis .d-flex {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 15px;
                }

                #printthis img {
                    width: 80px;
                    height: 80px;
                }

                #printthis p {
                    margin: 0;
                    text-align: center;
                    font-size: 16px;
                }

                #printthis .mt-2 {
                    margin-top: 1rem;
                }
                th {
                    background-color: gray !important;
                    color: white !important;
                    text-align: center !important;
                    width: 20% !important;
                }
                @media print {
                    #printthis {
                        width: 100%;
                        min-height: 8.5in; /* Ensure it fits the page */
                        padding: 0.5in;
                        background-color: white;
                        border: none;
                        border-radius: 0;
                        box-shadow: none;
                    }

                    /* Prevent images from being too big */
                    #printthis img {
                        max-width: 100%;
                        height: auto;
                    }

                    /* Hide the print button in print mode */
                    .btn {
                        display: none;
                    }

                    /* Adjust the page layout */
                    @page {
                        size: 13in 8.5in; /* Landscape format */
                    }

                    /* Style for the body during printing */
                    body {
                        margin: 0;
                        padding: 0;
                        font-family: Arial, sans-serif;
                    }
                }

                </style>
            </head>
            <body>
                ${printContents}
            </body>
        </html>
    `);
        iframeDoc.close();

        // Trigger the print dialog for the content inside iframe
        iframe.contentWindow.focus();
        iframe.contentWindow.print();

        // After printing, remove the iframe and restore original page content
        document.body.removeChild(iframe);
        document.body.innerHTML = originalContents;
    }
</script>