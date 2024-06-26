<?php
$find_archive = first('archive_class', ['user_id' => $_SESSION['user_id'], 'class_id' => $_GET['class_id']]);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2 align-items-center justify-content-between">
                    <div class="flex">
                        <?php
                        include 'class-header.php';
                        ?>
                    </div>
                    <?php if ($_SESSION['usertype'] == 0) : ?>
                        <button class="btn  <?php echo !isset($find_archive) ? "btn-danger" : "btn-primary" ?> mb-0 btn-sm" data-bs-toggle="modal" data-bs-target="#confirmation">
                            <i class="fa fa-archive"></i>
                            <?php echo !isset($find_archive) ? "Archive Class" : "Unarchive Class" ?>
                        </button>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="class-images">
                                        <img src="public/assets/img/lab_activity.jpg" class="preview-image-options border">
                                    </div>
                                    <p class="m-0 mt-1 class-title">LAB-Activities</p>
                                </div>
                                <div class="card-footer py-0 py-2 px-2">
                                    <a href="?page=lab activities&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-sm btn-options-text btn-success w-100 mb-0">
                                        <i class="fa fa-eye"></i>
                                        View LAB-Activities
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="class-images">
                                        <img src="public/assets/img/questions.png" class="preview-image-options ">
                                    </div>
                                    <p class="m-0 mt-1 class-title">Questions</p>
                                </div>
                                <div class="card-footer py-0 py-2 px-2">
                                    <a href="?page=questions&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-sm btn-options-text btn-success w-100 mb-0">
                                        <i class="fa fa-eye"></i>
                                        View Questions
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="class-images">
                                        <img src="public/assets/img/learning_materials.jpg" class="preview-image-options ">
                                    </div>
                                    <p class="m-0 mt-1 class-title">Material</p>
                                </div>
                                <div class="card-footer py-0 py-2 px-2">
                                    <a href="?page=materials&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-sm btn-options-text btn-success w-100 mb-0">
                                        <i class="fa fa-eye"></i>
                                        View Material
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="d-flex justify-content-center options-width border">
                        <div class="w-100">
                            <h5 class="create-text text-primary">
                                <i class="fa fa-edit"></i>
                                CREATE
                            </h5>
                            <div class="d-flex flex-column ">
                                <a class="btn btn-outline-primary w-100">LAB-Activities</a>
                                <a class="btn btn-outline-primary">Question</a>
                                <a class="btn btn-outline-primary">Material</a>
                                <a class="btn btn-outline-primary">Reuse Post</a>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <i class="fa fa-archive "></i>
                    <?php echo $class_settings['class_status'] == 1 ? "Archive Class" : "Unarchive Class" ?>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Are you sure you want to <?php echo !isset($find_archive) == 1 ? "archive" : "unarchive" ?> this class?
                </p>
            </div>
            <form method="POST" action="actions/manage_class.php">
                <input type="hidden" name="class_id" value="<?php echo $_GET['class_id'] ?>">
                <input type="hidden" name="status" value="<?php echo !isset($find_archive) == 1 ? 2 : 1 ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" name="archive_class" class="btn <?php echo !isset($find_archive) == 1 ? "btn-danger" : "btn-primary" ?>">
                        <i class="fa fa-archive"></i>
                        <?php echo !isset($find_archive) == 1 ? "Archive" : "Unarchive" ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>