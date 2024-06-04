<?php
if (isset($_GET['search_code'])) {
    $class = first("class", ['classcode' => $_GET['search_code']]);
}
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex gap-2 ">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        <h6 class="mb-0">Join Class</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2 px-4 classes-card">
                    <?php if (!isset($_GET['search_code']) || trim($_GET['search_code']) == "") { ?>
                        <div class="w-100 d-flex justify-content-center align-items-center" style="height: 74vh;">
                            <div class="w-100 d-flex justify-content-center flex-column align-items-center">
                                <i class="fa fa-cubes icon-size text-secondary"></i>
                                <p class="text-center mb-0 mb-2 text-secondary font-instruction">Ask your teacher for the class code then enter it here</p>
                                <form method="GET" class="w-100 d-flex justify-content-center">
                                    <input type="hidden" name="page" value="join class">
                                    <input type="search" name="search_code" placeholder="Class Code" class="form-control search-center-classcode" />
                                    <button class="btn btn-success btn-search-code mb-0 font-bold-free">
                                        <i class="fa fa-search"></i>
                                        Search</button>
                                </form>
                                <div class="w-100 under-instruction">
                                    <p class="mb-0 mt-2 mb-2 text-secondary font-instruction ">To join with a class code</p>
                                    <ul>
                                        <li class="font-instruction-li text-secondary ">
                                            Use an authorized account
                                        </li>
                                        <li class="font-instruction-li text-secondary ">
                                            Use a class code with 6-8 letters or numbers, no space or symbol
                                        </li>
                                    </ul>
                                    <p class="mb-0 mt-2 mb-2 text-secondary font-instruction ">If you have problem join the course subject</p>
                                    <ul>
                                        <li class="font-instruction-li text-secondary ">
                                            Ask for the advice of teacher in-charge
                                        </li>
                                        <li class="font-instruction-li text-secondary ">
                                            Ask teacher in-charge to add you in class directly
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="d-flex mt-2 justify-content-center">
                            <form method="GET" class="w-100 d-flex justify-content-center mt-3">
                                <input type="hidden" name="page" value="join class">
                                <input value="<?php echo isset($_GET['search_code']) ? $_GET['search_code'] : "" ?>" type="search" name="search_code" placeholder="Class Code" class="form-control search-center-classcode" />
                                <button class="btn btn-success btn-search-code mb-0 font-bold-free">
                                    <i class="fa fa-search"></i>
                                    Search</button>
                            </form>
                        </div>
                        <div>
                            <?php if (!$class) { ?>
                                <p class="text-center mt-2 text-secondary font-instruction">There's no class with the class code of <i><?php echo $_GET['search_code'] ?></i></p>
                            <?php } else { ?>
                                <div class="d-flex justify-content-center mt-3">
                                    <div class="card col-5">
                                        <div class="card-body p-3">
                                            <div class="class-images">
                                                <img src="<?= empty($class['class_image']) || $class['class_image'] == ""  ? "public/assets/img/class_default.jpg" :  $class['class_image'] ?>" class="preview-image ">
                                            </div>
                                            <p class="m-0 mt-1 class-title"><?= $class['classname'] ?> (<?= $class['section'] ?>)</p>
                                            <p class="m-0 class-room text-secondary"><?= $class['room'] ?></p>
                                        </div>
                                        <div class="card-footer py-0 py-2 px-2">
                                            <?php
                                            $find_class = first('class_people', ['class_id' => $class['class_id'], 'user_id' => $_SESSION['user_id']])
                                            ?>
                                            <?php if (!$find_class) { ?>
                                                <a href="actions/manage_class.php?join_class&class_id=<?= $class['class_id'] ?>&class_code=<?= $class['classcode'] ?>" class="btn btn-sm btn-success w-100 mb-0 btn-options-text">
                                                    <i class="fa fa-cubes me-1" style="font-size:14px"></i>
                                                    Join Class
                                                </a>
                                            <?php } else if ($find_class['class_people_status'] == 0) { ?>
                                                <button disabled href="?page=class work&class_id=<?= $class['class_id'] ?>" class="btn btn-sm btn-secondary w-100 mb-0 btn-options-text">
                                                    <i class="fa fa-spinner me-1"></i>
                                                    Pending Request
                                                </button>
                                            <?php } else { ?>
                                                <a href="?page=class work&class_id=<?= $class['class_id'] ?>" class="btn btn-sm btn-success w-100 mb-0 btn-options-text">
                                                    <i class="fa fa-eye"></i>
                                                    View Class
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>