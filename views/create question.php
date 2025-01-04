<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <a href="?page=questions&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-secondary btn-sm px-4 mb-0">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="actions/manage_activity.php" id="add_question" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="class_id" value="<?php echo $_GET['class_id'] ?>">
                        <input type="hidden" name="typeAct" id="typeAct" value="question">
                        <div class="d-flex gap-2">
                            <div class="w-50">
                                <div class="form-row">
                                    <label class="mx-0">Question Type</label>
                                    <select class="form-control" name="question_type">
                                        <option value="Short Answer">Short Answer</option>
                                        <option value="Multiple Choice">Multiple Choice</option>
                                    </select>
                                </div>
                                <div class="form-row">
                                    <label class="mx-0">Question Title</label>
                                    <input required value="<?php echo getValue('activity_title') ?>" class="form-control" name="activity_title" placeholder="Question Title" />
                                    <p class="mb-0 text-danger d-none" id="duplicateMessage" style="font-size: 11px">Question title already exist in this class!</p>
                                    <?php if (showError('activity_title')) :
                                        echo showError('activity_title');
                                    endif; ?>
                                </div>
                                <div class="form-row">
                                    <label class="mx-0">Question Description</label>
                                    <textarea required name="activity_description" class="form-control  description-activity" placeholder="Question Description"></textarea>
                                    <?php if (showError('activity_description')) :
                                        echo showError('activity_description');
                                    endif; ?>
                                </div>

                                <div class="form-check mt-2">
                                    <input required checked name="isDueDate" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Set due date
                                    </label>
                                </div>

                                <div class="form-row">
                                    <input required value="<?php echo getValue('dueDate') ?>" type="datetime-local" name="dueDate" class="form-control" />
                                    <?php if (showError('dueDate')) :
                                        echo showError('dueDate');
                                    endif; ?>
                                </div>

                                <button type="submit" name="add_question" class="btn btn-success mt-3 px-4 btn-sm">
                                    <i class="fa fa-check"></i>
                                    Create Question
                                </button>
                            </div>
                            <div class="w-50">
                                <div class="form-row">
                                    <label class="mx-0">Add Attachment</label>
                                    <input required type="file" name="attachments[]" class="form-control" multiple />
                                </div>
                                <div class="form-row">
                                    <label class="mx-0">Total Points</label>
                                    <input required value="<?php echo getValue('total_points') ?>" placeholder="Total Points" type="number" name="total_points" value="100" class="form-control" />
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