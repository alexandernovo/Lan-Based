<?php
$activity = first('activity', ['activity_id' => $_GET['activity_id'], 'activity_type' => 'activity']);
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
                    <?php if ($_SESSION['usertype'] == 1) : ?>
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
                                <a href="<?= $attachment['attachment_file'] ?>" download class="text-black download-hover">
                                    <i class="fa fa-arrow-circle-o-down"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
                    $submission_check = last('submission', ['activity_id' => $_GET['activity_id'], 'user_id' => $_SESSION['user_id']], 'submission_index');
                    ?>
                    <div class="d-flex justify-content-between align-items-center w-50">
                        <p class="title-activity mb-0">
                            <i class="fa fa-folder mt-2"></i>
                            Submission
                        </p>
                        <button style="font-size: 11px;" class="btn shadow-none mb-0 cursor-pointer">Edit Submission</button>
                    </div>

                    <?php if ($_SESSION['usertype'] == 0) : ?>
                        <?php if (!$submission_check) { ?>
                            <div class="border rounded p-3 w-50">
                                <form method="POST" action="actions/manage_submission.php" enctype="multipart/form-data">
                                    <label class="mb-0 mx-0">Submission File</label>
                                    <input type="hidden" name="activity_id" value="<?php echo $_GET['activity_id'] ?>">
                                    <input type="hidden" name="class_id" value="<?php echo $_GET['class_id'] ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                    <input name="submission_file[]" type="file" class="form-control" multiple />
                                    <button type="submit" name="add_submission" class="btn btn-success btn-sm mt-2 px-4">
                                        <i class="fa fa-check"></i>
                                        Submit
                                    </button>
                                </form>
                            </div>
                        <?php } else { ?>
                            <?php
                            $submissions = find_where('submission', ['activity_id' => $submission_check['activity_id'], 'submission_index' => $submission_check['submission_index']]);
                            foreach ($submissions as $submission) : ?>
                                <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-50 p-3 rounded mt-1 shadow shadow-sm">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fa fa-paperclip"></i>
                                        <?= $submission['submission_fileName'] ?>
                                    </div>
                                    <a href="<?= $submission['submission_file'] ?>" download class="text-black download-hover">
                                        <i class="fa fa-arrow-circle-o-down"></i>
                                    </a>
                                </div>
                    <?php endforeach;
                        }
                    endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>