<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['subject'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="d-flex gap-1">
                            <a href="?page=class settings&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "class settings" ? "btn-primary" : "btn-outline-primary" ?> btn-sm px-2 mb-0">
                                <i class="fa fa-cog"></i>
                                Class Settings
                            </a>
                            <a href="?page=stream&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "stream" ? "btn-success" : "btn-outline-success" ?> btn-sm px-4 mb-0">Stream</a>
                            <a href="?page=class work&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "class work" ? "btn-success" : "btn-outline-success" ?> btn-sm px-4 mb-0">Class Work</a>
                            <a href="?page=people&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "people" ? "btn-success" : "btn-outline-success" ?> btn-sm px-4 mb-0">People</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>