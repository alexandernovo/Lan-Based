<?php
$classes = find_where('class', ['user_id' => $_SESSION['user_id']]);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex gap-2 ">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        <h6 class="mb-0">Classes</h6>
                    </div>
                    <a href="?page=add class" class="btn btn-sm btn-outline-success mb-0 btn-outline">
                        <i class="fa fa-plus-circle"></i>
                        Create Class
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-4 classes-card">
                    <div class="d-flex">
                        <div class="h-100 w-100">
                            <?php if (!$classes) : ?>
                                <div class="d-flex justify-content-center flex-column classes-icon-add">
                                    <a href="?page=add class" class="text-center">
                                        <i class="fa fa-plus-square-o text-secondary text-sm opacity-10 text-center class-add-icons"></i>
                                    </a>
                                    <h5 class="text-secondary text-center">You have no existing class</h5>
                                    <h6 class="text-secondary text-center">Add Class to Get Started</h6>
                                </div>
                            <?php endif; ?>

                            <?php if ($classes) : ?>
                                <div class="row mt-3">
                                    <?php foreach ($classes as $class) : ?>
                                        <div class="col-4 mb-xl-0 mb-4">
                                            <div class="card">
                                                <div class="card-body p-3">
                                                    <div class="class-images">
                                                        <img src="<?= empty($class['class_image']) || $class['class_image'] == ""  ? "public/assets/img/class_default.jpg" :  $class['class_image'] ?>" class="preview-image ">
                                                    </div>
                                                    <p class="m-0 mt-1 class-title"><?= $class['classname'] ?> (<?= $class['section'] ?>)</p>
                                                    <p class="m-0 class-room text-secondary"><?= $class['room'] ?></p>
                                                </div>
                                                <div class="card-footer py-0 py-2 px-2">
                                                    <a href="?page=class work&class_id=<?= $class['class_id'] ?>" class="btn btn-sm btn-success w-100 mb-0 btn-options-text">
                                                        <i class="fa fa-eye"></i>
                                                        View Class
                                                    </a>
                                                    <button class="btn btn-outline-success btn-sm w-100 mb-0 mt-1 btn-options-text">Class Code: <?= $class['classcode'] ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>