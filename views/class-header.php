<div class="d-flex gap-1">

    <?php if ($_SESSION['usertype'] == 1) : ?>
        <a href="?page=class settings&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "class settings" ? "btn-primary" : "btn-outline-primary" ?> btn-sm px-2 mb-0">
            <i class="fa fa-cog"></i>
            Class Settings
        </a>
        <a href="?page=stream&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "stream" ? "btn-success" : "btn-outline-success" ?> btn-sm px-4 mb-0">Stream</a>
    <?php endif; ?>

    <a href="?page=class work&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "class work" ? "btn-success" : "btn-outline-success" ?> btn-sm px-4 mb-0">Class Work</a>

    <?php if ($_SESSION['usertype'] == 1) : ?>
        <a href="?page=people&class_id=<?php echo $_GET['class_id'] ?>" class="btn <?php echo $_GET['page'] == "people" ? "btn-success" : "btn-outline-success" ?> btn-sm px-4 mb-0">People</a>
    <?php endif; ?>
</div>