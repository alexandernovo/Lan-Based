<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="flex">
                        <?php
                        include 'class-header.php';
                        ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-4 mb-xl-0 mb-4">
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
                        <div class="col-4 mb-xl-0 mb-4">
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
                        <div class="col-4 mb-xl-0 mb-4">
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