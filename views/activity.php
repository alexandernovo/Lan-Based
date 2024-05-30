<?php
$activity = first('activity', ['activity_id' => $_GET['activity_id']]);
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
                    <a href="#" class="btn btn-outline-success btn-sm px-4 mb-0">
                        <i class="fa fa-edit"></i>
                        Edit Activity
                    </a>
                </div>
                <div class="card-body">
                    <p class="title-activity">
                        <i class="fa fa-file"></i>
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
                            <a href="<?= $attachment['attachment_file'] ?>" download class="activity-file text-decoration-none d-flex gap-1 align-items-center mb-1">
                                <i class="fa fa-file"></i>
                                <u>
                                    <?= $attachment['attachment_name'] ?>
                                </u>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>