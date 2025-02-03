<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['course'] ?> (<?= $class_settings['section'] ?>) - <?= $class_settings['program'] ?></p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="d-flex justify-content-between w-100">
                            <?php
                            include 'class-header.php';
                            ?>
                            <a href="actions/manage_class.php?delete_class&class_id=<?php echo $_GET['class_id'] ?>" class="delete-class btn btn-danger align-items-center btn-sm px-4 mb-0 d-flex align-items-center gap-2"><i class="fa fa-trash"></i>Delete Class</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mx-auto class-add-card">
                        <form method="POST" action="actions/manage_class.php" enctype="multipart/form-data">
                            <div class="image-now mt-4" id="image-container">
                                <img class="img-fluid h-100 border" src="<?= empty($class_settings['class_image']) || $class_settings['class_image'] == ""  ? "public/assets/img/default.jpg" :  $class_settings['class_image'] ?>" id="preview-image">
                                <input type="file" name="image" class="d-none" id="image-upload">
                                <label for="image-upload" type="button" class="btn btn-sm btn-secondary mt-1 mx-0 px-3">Upload</;>
                            </div>
                            <input type="hidden" value="<?php echo $_GET['class_id'] ?>" name="class_id">
                            <div class="form-row">
                                <!-- <label class="mx-0">Class name</label> -->
                                <input type="hidden" name="classname" value="<?= $class_settings['classname'] ?>" class="form-control">
                            </div>

                            <div class="form-row m">
                                <!-- <label class="mx-0">Subject</label> -->
                                <input type="hidden" name="subject" value="<?= $class_settings['subject'] ?>" class="form-control">
                            </div>
                            <div class="form-row mt-5">
                                <label class="mx-0">Course</label>
                                <input name="course" value="<?= $class_settings['course'] ?>" class="form-control">
                            </div>
                            <div class="form-row mt-2">
                                <label class="mx-0">Year and Section</label>
                                <input required name="section" value="<?= $class_settings['section'] ?>" class="form-control">
                            </div>
                            <div class="form-row mt-2">
                                <label class="mx-0">Program</label>
                                <input value="<?= $class_settings['program'] ?>" name="program" class="form-control">
                            </div>
                            <div class="form-row mt-2">
                                <p class="mb-0 font-bold">Schedule of Classes</p>
                                <!-- <label class="mx-0">Lecture</label> -->
                                <select name="schedclass_lecture" class="form-select">
                                    <option value="Lecture">Lecture</option>
                                    <option value="Lab">Lab</option>
                                </select>
                            </div>
                            <!-- <div class="form-row mt-2">
                                <p class="mb-0 font-bold">Class Room</p>
                                <label class="mx-0">Lecture</label>
                            </div> -->
                            <div class="form-row mt-2">
                                <p class="mb-0 font-bold">Class Room</p>
                                <label class="mx-0">Lab</label>
                                <input value="<?= $class_settings['classroom_lab'] ?>" name="classroom_lab" class="form-control">
                            </div>
                            <div class="form-row mt-3 mb-5">
                                <button name="update_class" class="btn btn-success w-100 button-text-size">Update Class</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>