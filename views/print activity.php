<?php
$activity_id = $_GET['activity_id'];
$query = "
SELECT u.*, s.*
FROM users u
INNER JOIN submission s ON u.user_id = s.user_id
INNER JOIN (
    SELECT user_id, MAX(submission_index) AS max_submission_index
    FROM submission
    WHERE activity_id = '$activity_id'
    GROUP BY user_id
) max_submission ON s.user_id = max_submission.user_id AND s.submission_index = max_submission.max_submission_index
WHERE s.activity_id = '$activity_id';
";
$result = mysqli_query($conn, $query);

$activity = first('activity', ['activity_id' => $activity_id]);
?>
<div class="container-fluid py-4 d-flex justify-content-center">
    <div class="paper_long">
        <h4 class="text-center mb-2" style="font-weight:bold"><?= $activity['activity_title'] ?></h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Score</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td class="border"><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                        <td class="text-center border"><?= isset($row['submission_status']) ? ($row['submission_status'] == 1 ? "Pending" : ($row['submission_status'] == 3 ? "Done" : "Rejected")) : "Did not submit" ?></td>
                        <td class="text-center border"><?= isset($row['submission_score']) ? $row['submission_score'] . " /" . $activity['total_points']  : "N/A"  ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>