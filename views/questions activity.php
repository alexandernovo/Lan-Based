<?php
$activity = first('activity', ['activity_id' => $_GET['activity_id'], 'activity_type' => 'question']);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2 align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="?page=questions&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-secondary btn-sm px-4 mb-0">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                    <?php if ($_SESSION['usertype'] == 1) : ?>
                        <a href="?page=edit question&class_id=<?php echo $_GET['class_id'] ?>&activity_id=<?php echo $_GET['activity_id'] ?>" class="btn btn-outline-success btn-sm px-4 mb-0 font-bold">
                            <i class="fa fa-edit"></i>
                            Edit Question
                        </a>
                    <?php endif; ?>

                </div>
                <div class="card-body">
                    <p class="title-activity">
                        <i class="fa fa-cubes"></i>
                        <?= $activity['activity_title'] ?>
                    </p>
                    <p class="activity-description font-bold m-0">Question Description</p>
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
                </div>
            </div>
        </div>
    </div>
</div>