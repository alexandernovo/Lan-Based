<?php
$day = [
    1 => 'monday',
    2 => 'tuesday',
    3 => 'wednesday',
    4 => 'thursday',
    5 => 'friday',
    6 => 'saturday',
    7 => 'sunday'
];

if ($_SESSION['usertype'] == 1) {
    $classes = find_where('class', ['user_id' => $_SESSION['user_id']]);
} else if ($_SESSION['usertype'] == 2) {
    $classes = findAll('class');
} else {
    $archive_class = find_where('archive_class', ['user_id' => $_SESSION['user_id']]);
    $ids = array_column($archive_class, 'class_id');
    $classes = joinTable('class', [['class_people', 'class_people.class_id', 'class.class_id']], ['class_people.user_id' => $_SESSION['user_id'], 'class.class_status' => 1, 'class_people.class_people_status' => 1],  ['class.class_id' => $ids]);
}
function isDisabled($schedule)
{
    global $day;
    if ($schedule) {
        $num = $day[date('N')];
        if ($schedule[$num] == 1) {
            $time = find_where('schedule_time', ['schedule_id' => $schedule['schedule_id'], 'day' => $num]);
            if ($time) {
                $current_time = date('H:i');
                foreach ($time as $tim) {
                    $timefrom = date("H:i", strtotime($tim['timefrom']));
                    $timeto = date("H:i", strtotime($tim['timeto']));
                    if ($current_time >= $timefrom && $current_time <= $timeto) {
                        return '';
                    }
                }
                return 'disabled';
            } else {
                return 'disabled';
            }
        } else {
            return 'disabled';
        }
    } else {
        return 'disabled';
    }
}
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
                    <?php if ($_SESSION['usertype'] == 1) : ?>
                        <div>
                            <a href="?page=schedule" class="btn font-bold btn-sm btn-outline-primary mb-0 btn-outline">
                                <i class="fa fa-calendar"></i>
                                Set Schedule
                            </a>
                            <a href="?page=add class" class="btn font-bold btn-sm btn-outline-success mb-0 btn-outline">
                                <i class="fa fa-plus-circle"></i>
                                Create Class
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if ($_SESSION['usertype'] == 0) : ?>
                        <a href="?page=join class" class="btn font-bold btn-sm btn-outline-success mb-0 btn-outline">
                            <i class="fa fa-object-group"></i>
                            Join Class
                        </a>
                    <?php endif; ?>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-4 classes-card">
                    <div class="d-flex">
                        <div class="h-100 w-100">
                            <?php if ($_SESSION['usertype'] == 1) : ?>
                                <?php if (!$classes) : ?>
                                    <div class="d-flex justify-content-center flex-column classes-icon-add">
                                        <a href="?page=add class" class="text-center">
                                            <i class="fa fa-plus-square-o text-secondary text-sm opacity-10 text-center class-add-icons"></i>
                                        </a>
                                        <h5 class="text-secondary text-center">You have no existing class</h5>
                                        <h6 class="text-secondary text-center">Add Class to Get Started</h6>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if ($_SESSION['usertype'] == 0) : ?>
                                <?php if (!$classes) : ?>
                                    <div class="d-flex justify-content-center flex-column classes-icon-add">
                                        <a href="?page=join class" class="text-center">
                                            <i class="fa fa-object-group text-secondary text-sm opacity-10 text-center class-add-icons"></i>
                                        </a>
                                        <h5 class="text-secondary text-center">You have no existing joined class</h5>
                                        <h6 class="text-secondary text-center">Join a Class to Get Started</h6>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if ($classes) : ?>
                                <div class="row mt-3">
                                    <?php foreach ($classes as $class) : ?>
                                        <?php if ($_SESSION['usertype'] == 0) : ?>
                                            <?php
                                            $schedule = first('schedule', ['class_id' => $class['class_id']]);
                                            ?>
                                            <div class="col-sm-12 col-md-4  mb-xl-0 mb-4 ">
                                                <div class="card" style="min-height: 316px;">
                                                    <div class="card-body p-3">
                                                        <div class="class-images">
                                                            <img src="<?= empty($class['class_image']) || $class['class_image'] == ""  ? "public/assets/img/class_default.jpg" :  $class['class_image'] ?>" class="preview-image ">
                                                        </div>
                                                        <p class="m-0 mt-1 class-title w-100 text-truncate"><?= $class['course'] ?> (<?= $class['section'] ?>)- <?= $class['program'] ?></p>
                                                        <p class="m-0 class-room text-secondary"><?= $class['room'] ?></p>
                                                    </div>
                                                    <div class="card-footer py-0 py-2 px-2">
                                                        <button <?php echo isDisabled($schedule) ?> href="?page=class work&class_id=<?= $class['class_id'] ?>" class="redirectClass btn btn-sm btn-success w-100 mb-0 btn-options-text">
                                                            <i class="fa fa-eye"></i>
                                                            View Class
                                                        </button>
                                                        <button id="copyButton" class-code="<?= $class['classcode'] ?>" class="btn btn-outline-success btn-sm w-100 mb-0 mt-1 btn-options-text">Class Code: <?= $class['classcode'] ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-sm-12 col-md-4  mb-xl-0 mb-4">
                                                <div class="card" style="min-height: 316px;">
                                                    <div class="card-body p-3">
                                                        <div class="class-images">
                                                            <img src="<?= empty($class['class_image']) || $class['class_image'] == ""  ? "public/assets/img/class_default.jpg" :  $class['class_image'] ?>" class="preview-image ">
                                                        </div>
                                                        <p class="m-0 mt-1 class-title  w-100 text-truncate"><?= $class['course'] ?> (<?= $class['section'] ?>)- <?= $class['program'] ?></p>
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
                                        <?php endif; ?>
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