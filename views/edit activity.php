<?php
$activity = first('activity', ['activity_id' => $_GET['activity_id'], 'activity_type' => 'activity']);
$attachments = find_where('attachments', ['activity_id' => $_GET['activity_id']]);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <a href="?page=activity&class_id=<?php echo $_GET['class_id'] ?>&activity_id=<?php echo $_GET['activity_id'] ?>" class="btn btn-secondary btn-sm px-4 mb-0">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="actions/manage_activity.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="class_id" value="<?php echo $_GET['class_id'] ?>">
                        <div class="d-flex gap-2">
                            <div class="w-50">
                                <div class="form-row">
                                    <label class="mx-0">Activity Title</label>
                                    <input type="hidden" name="activity_id" value="<?php echo $_GET['activity_id'] ?>">
                                    <input required value="<?= $activity['activity_title'] ?>" class="form-control" name="activity_title" placeholder="Activity Title" />
                                    <?php if (showError('activity_title')) :
                                        echo showError('activity_title');
                                    endif; ?>
                                </div>
                                <div class="form-row">
                                    <label class="mx-0">Activity Description</label>
                                    <textarea required name="activity_description" class=" form-control description-activity" placeholder="Activity Description"><?= $activity['activity_description'] ?></textarea>
                                    <?php if (showError('activity_description')) :
                                        echo showError('activity_description');
                                    endif; ?>
                                </div>
                                <div class="form-check mt-2">
                                    <input required name="isDueDate" checked="<?= $activity['isDueDate'] ?>" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Set due date
                                    </label>
                                </div>
                                <div class="form-row">
                                    <input required value="<?= $activity['dueDate'] ?>" type="datetime-local" name="dueDate" class="form-control" />
                                    <?php if (showError('dueDate')) :
                                        echo showError('dueDate');
                                    endif; ?>
                                </div>

                                <button type="submit" name="edit_activity" class="btn btn-success mt-3 px-4 btn-sm">
                                    <i class="fa fa-check"></i>
                                    Update Activity
                                </button>
                            </div>
                            <div class="w-50">
                                <div class="form-row">
                                    <label class="mx-0">Add Attachment</label>
                                    <input type="file" value="" name="attachments[]" class="form-control" multiple />
                                </div>
                                <?php foreach ($attachments as $attachment) : ?>
                                    <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-full p-3 rounded mt-1 shadow shadow-sm">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa fa-paperclip"></i>
                                            <?= $attachment['attachment_name'] ?>
                                        </div>
                                        <a href="<?= $attachment['attachment_file'] ?>" download class="text-black download-hover">
                                            <i class="fa fa-arrow-circle-o-down"></i>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                                <div class="form-row">
                                    <label class="mx-0">Total Points</label>
                                    <input required value="<?= $activity['total_points'] ?>" placeholder="Total Points" type="number" name="total_points" value="100" class="form-control" />
                                    <?php if (showError('total_points')) :
                                        echo showError('total_points');
                                    endif; ?>
                                </div>
                                <!-- <div class="form-row">
                                    <label class="mx-0">Add Topic</label>
                                    <input required type="file" name="topics[]" class="form-control" multiple />
                                </div> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>