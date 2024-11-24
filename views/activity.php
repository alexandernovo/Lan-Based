<?php
$activity = first('activity', ['activity_id' => $_GET['activity_id'], 'activity_type' => 'activity']);
$submission_check = last('submission', ['activity_id' => $_GET['activity_id'], 'user_id' => $_SESSION['user_id']], 'submission_index');
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2 align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="?page=lab activities&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-secondary btn-sm px-4 mb-0">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                    <?php if ($_SESSION['usertype'] == 1 || $_SESSION['usertype'] == 2) : ?>
                        <a href="?page=edit activity&activity_id=<?php echo $_GET['activity_id'] ?>&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-outline-success btn-sm px-4 mb-0 font-bold">
                            <i class="fa fa-edit"></i>
                            Edit Activity
                        </a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <p class="title-activity">
                        <i class="fa fa-cubes"></i>
                        <?= $activity['activity_title'] ?>
                    </p>
                    <p class="activity-description font-bold m-0">Activity Description</p>
                    <li class="activity-description">
                        <?= $activity['activity_description'] ?>
                    </li>
                    <?php
                    $attachments = find_where('attachments', ['activity_id' => $_GET['activity_id']]);
                    ?>
                    <p class="m-0 mt-3 attachment_text">
                        <i class="fa fa-calendar"></i>
                        Last day of submission: <?= date("F d, Y", strtotime($activity['dueDate'])) ?>
                        <?php
                        if (!isset($submission_check) && $_SESSION['usertype'] == 0) {
                            echo "(" . dateDue($activity['dueDate']) . ")";
                        }
                        ?>
                    </p>

                    <p class="m-0 mt-3 attachment_text">
                        <i class="fa fa-paperclip"></i>
                        Attachments
                    </p>
                    <div class="d-flex flex-column">
                        <?php foreach ($attachments as $attachment) : ?>
                            <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-50 p-3 rounded mt-1 shadow shadow-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa fa-paperclip"></i>
                                    <?= $attachment['attachment_name'] ?>
                                </div>
                                <a href="<?= $attachment['attachment_file'] ?>" download="<?= $attachment['attachment_name'] ?>" class="text-black download-hover">
                                    <i class="fa fa-download"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
                    $dueDate = date('Y-m-d h:i:s') > $activity['dueDate'];
                    ?>
                    <div class="d-flex justify-content-between mb-1 align-items-center <?php echo $_SESSION['usertype'] == 0 ? "w-50" : "" ?>">
                        <p class="title-activity mb-0">
                            <i class="fa fa-folder mt-2"></i>
                            Submission
                        </p>
                        <?php if ($_SESSION['usertype'] == 1 || $_SESSION['usertype'] == 2) : ?>
                            <a href="?page=print activity&activity_id=<?php echo $_GET['activity_id'] ?>" class="btn btn-sm btn-primary mb-0 d-flex gap-1 align-items-center font-bold"><i class="fa fa-print"></i>Print Activity Results</a>
                        <?php endif; ?>

                        <?php if ($_SESSION['usertype'] == 0 && $dueDate) : ?>
                            <p class="text-danger mb-0 warning-text">The submission period for this activity has ended.</p>
                        <?php endif; ?>

                        <?php if ($submission_check && !$dueDate) : ?>
                            <button style="font-size: 11px; width:140px" id="activity_click" class="btn shadow-none mb-0 cursor-pointer text-end pe-0">Edit Submission</button>
                        <?php endif; ?>
                    </div>

                    <?php if ($_SESSION['usertype'] == 0) : ?>
                        <?php if (!$submission_check) { ?>
                            <div class="border rounded p-3 w-50">
                                <form method="POST" action="actions/manage_submission.php" enctype="multipart/form-data">
                                    <label class="mb-0 mx-0">Submission File</label>
                                    <input type="hidden" name="activity_id" value="<?php echo $_GET['activity_id'] ?>">
                                    <input type="hidden" name="class_id" value="<?php echo $_GET['class_id'] ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                    <input <?php echo $dueDate ? "disabled" : "" ?> name="submission_file[]" required type="file" class="form-control" multiple />
                                    <button <?php echo $dueDate ? "disabled" : "" ?> type="submit" name="add_submission" class="btn btn-success btn-sm mt-2 px-4">
                                        <i class="fa fa-check"></i>
                                        Submit
                                    </button>
                                </form>
                            </div>
                        <?php } else { ?>
                            <div id="activity_now">
                                <?php
                                $submissions = joinTable('submission', [['submission_file', 'submission_file.submission_id', 'submission.submission_id']], ['activity_id' => $submission_check['activity_id'], 'submission_index' => $submission_check['submission_index']]);
                                foreach ($submissions as $submission) : ?>
                                    <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-50 p-3 rounded mt-1 shadow shadow-sm">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa fa-paperclip"></i>
                                            <?= $submission['submission_fileName'] ?>
                                        </div>
                                        <a href="<?= $submission['submission_file'] ?>" download class="text-black download-hover">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                                <?php
                                if (isset($submission_check['activity_id'])) :
                                    $submission_first = first('submission', ['activity_id' => $submission_check['activity_id']]);
                                    if (isset($submission_first['submission_score'])) : ?>
                                        <div class="border rounded p-3 w-50 mt-1">
                                            <p class="feedback">Score: <span class="font-bold feedback"><?= $submission_first['submission_score'] ?> / <?= $activity['total_points'] ?></span></p>
                                            <p class="feedback mb-0">Remarks: <?= $submission_first['submission_remarks'] ?></p>
                                        </div>
                                <?php
                                    endif;
                                endif;
                                ?>
                            </div>

                    <?php }
                    endif; ?>

                    <?php if ($submission_check) : ?>
                        <div class="border rounded p-3 w-50 d-none" id="activity_edit">
                            <form method="POST" action="actions/manage_submission.php" enctype="multipart/form-data">
                                <label class="mb-0 mx-0">Submission File</label>
                                <input type="hidden" name="activity_id" value="<?php echo $_GET['activity_id'] ?>">
                                <input type="hidden" name="class_id" value="<?php echo $_GET['class_id'] ?>">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                <input type="hidden" name="submission_id" value="<?php echo $submission_check['submission_id'] ?>">
                                <input name="submission_file[]" required type="file" class="form-control" multiple />
                                <button type="submit" name="edit_submission" class="btn btn-success btn-sm mt-2 px-4">
                                    <i class="fa fa-check"></i>
                                    Submit
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>

                    <?php if ($_SESSION['usertype'] == 1 || $_SESSION['usertype'] == 2) : ?>
                        <div class="border rounded p-3 ">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 table-data">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Score</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Submission Date</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                        ?>
                                        <?php while ($people = mysqli_fetch_assoc($result)) : ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="public/assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?= $people['firstname'] . ' ' . $people['lastname'] ?></h6>
                                                            <p class="text-xs text-secondary mb-0"><?= $people['email'] ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <?= isset($people['submission_score']) ? $people['submission_score'] : 0 ?>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm <?= $people['submission_status'] == 1 ? "bg-gradient-primary" : ($people['submission_status'] == 3  ? "bg-gradient-success" : "bg-gradient-danger") ?>"><?= $people['submission_status'] == 1 ? "Pending" : ($people['submission_status'] == 3  ? "Done" : "Rejected") ?></span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?php echo date('F j, Y', strtotime($people['submission_date'])); ?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="?page=submission&submission_id=<?= $people['submission_id'] ?>" class="btn btn-primary btn-sm px-4 rounded mb-0 py-1">
                                                        <i class="fa fa-eye"></i>
                                                        View
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>