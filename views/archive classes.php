<?php
if ($_SESSION['usertype'] == 1) {
    $classes = find_where('class', ['user_id' => $_SESSION['user_id']]);
} else {
    $classes = joinTable('class', [['class_people', 'class_people.class_id', 'class.class_id'], ['archive_class', 'class.class_id', 'archive_class.class_id']], ['class_people.user_id' => $_SESSION['user_id'], 'class_people.class_people_status' => 1]);
}
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex gap-2 ">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        <h6 class="mb-0">Archived Classes</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-4 classes-card">
                    <div class="d-flex">
                        <div class="h-100 w-100">
                            <?php if ($_SESSION['usertype'] == 0) : ?>
                                <?php if (!$classes) : ?>
                                    <div class="d-flex justify-content-center flex-column classes-icon-add">
                                        <a href="?page=join class" class="text-center">
                                            <i class="fa fa-object-group text-secondary text-sm opacity-10 text-center class-add-icons"></i>
                                        </a>
                                        <h5 class="text-secondary text-center">You have no archived class</h5>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if ($classes) : ?>
                                <div class="row mt-3">
                                    <?php foreach ($classes as $class) : ?>
                                        <div class="col-sm-12 col-md-4  mb-xl-0 mb-4">
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
                                                    <button id="copyButton" class-code="<?= $class['classcode'] ?>" class="btn btn-outline-success btn-sm w-100 mb-0 mt-1 btn-options-text">Class Code: <?= $class['classcode'] ?></button>
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