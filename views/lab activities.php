<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <a href="?page=class work&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-secondary btn-sm px-4 mb-0">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                        <?php if ($_SESSION['usertype'] == 1 || $_SESSION['usertype'] == 2) : ?>
                            <a href="?page=create activity&class_id=<?php echo $_GET['class_id'] ?>" class="btn font-bold btn-outline-success btn-sm px-4 mb-0">
                                <i class="fa fa-plus-circle"></i>
                                Create Activity
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <?php
                        $activities = find_where('activity', ['class_id' => $_GET['class_id'], 'activity_type' => 'activity']);
                        ?>
                        <?php foreach ($activities as $activity) : ?>
                            <div class="col-4 mb-xl-0 mb-4">
                                <div class="card">
                                    <div class="card-body p-3">
                                        <div class="activities-images">
                                            <img src="public/assets/img/lab_activity.jpeg" class="preview-image-options border">
                                        </div>
                                        <p class="m-0 mt-1 class-title"><?= $activity['activity_title'] ?></p>
                                        <p class="m-0 mt-1 activity-due">Due Date: <?= $activity['isDueDate'] == 1 ? date('F d Y h:i a', strtotime($activity['dueDate'])) : 'No due date'  ?></p>
                                    </div>
                                    <div class="card-footer py-0 py-2 px-2">
                                        <a href="?page=activity&activity_id=<?php echo $activity['activity_id'] ?>&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-sm btn-options-text btn-success w-100 mb-0">
                                            <i class="fa fa-eye"></i>
                                            View Activity
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>