<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="flex">
                        <a href="?page=stream&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "stream" ? "btn-success" : "btn-outline-success" ?> btn-sm px-4 mb-0">Stream</a>
                        <a href="?page=class work&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "class work" ? "btn-success" : "btn-outline-success" ?> btn-sm px-4 mb-0">Class Work</a>
                        <a href="?page=people&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "people" ? "btn-success" : "btn-outline-success" ?> btn-sm px-4 mb-0">People</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>