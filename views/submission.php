<?php
$submission = first('submission', ['submission_id' => $_GET['submission_id']]);
$user = first('users', ['user_id' => $submission['user_id']]);
$activity = first('activity', ['activity_id' => $submission['activity_id']]);
$submissions = joinTable('submission', [['submission_file', 'submission_file.submission_id', 'submission.submission_id']], ['submission.submission_id' => $_GET['submission_id']]);
$back_button_url = $activity['activity_type'] == "activity"
    ? "?page=activity&activity_id=" . $activity['activity_id'] . "&class_id=" . $activity['class_id']
    : "?page=questions%20activity&activity_id=" . $activity['activity_id'] . "&class_id=" . $activity['class_id'];
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex p-2 align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?php echo $back_button_url ?>" class="btn btn-secondary btn-sm px-4 mb-0">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="p-4">
                    <p class="m-0 class_header">
                        <i class="fa fa-cubes"></i>
                        <?= $activity['activity_title'] ?>
                    </p>
                    <p class="m-0 class_description mb-2 border rounded p-2"><?= $activity['activity_description'] ?></p>
                    <hr class="p-0 border-0 my-0 my-1 mt-4 border-bottom border-dark">
                    </hr>
                    <p class="m-0 class_header mt-4">
                        <i class="fa fa-cubes"></i>
                        <?= $user['firstname'] . ' ' . $user['lastname']  ?> Submission
                    </p>
                    <?php foreach ($submissions as $submission) : ?>
                        <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-50 p-3 rounded mt-1 shadow shadow-sm">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa fa-paperclip"></i>
                                <?= $submission['submission_fileName'] ?>
                            </div>
                            <a href="<?= $submission['submission_file'] ?>" download class="text-black download-hover">
                                <i class="fa fa-arrow-circle-o-down"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>

                    <?php $check_submission = first('submission', ['submission_id' => $_GET['submission_id']]);
                    $disable = isset($check_submission['submission_score']) ? true : false;
                    ?>
                    <div class="border rounded p-3 mt-4 w-50">
                        <form method="POST" action="actions/manage_submission.php">
                            <input type="hidden" name="submission_id" value="<?php echo $_GET['submission_id'] ?>">
                            <div class="form-row">
                                <div class="d-flex justify-content-between">
                                    <label>Score (Max Score: <?= $activity['total_points'] ?>)</label>
                                    <?php if ($disable) : ?>
                                        <label class="cursor-pointer" id="submission_disable">
                                            <i class="fa fa-edit me-1"></i>
                                            Edit Score
                                        </label>
                                    <?php endif; ?>
                                </div>
                                <input type="number" <?php echo $disable ? "disabled" : "" ?> value="<?= $check_submission['submission_score'] ?>" required name="submission_score" max="<?= $activity['total_points'] ?>" class="form-control submission">
                            </div>
                            <div class="form-row">
                                <label>Remarks</label>
                                <textarea class="form-control submission" <?php echo $disable ? "disabled" : "" ?> value="<?= $check_submission['submission_remarks'] ?>" name="submission_remarks"></textarea>
                            </div>
                            <button type="submit" <?php echo $disable ? "disabled" : "" ?> name="submitted" class="mt-3 btn btn-success w-100 submission">Submit Score</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>