<?php
$material = first('material', ['material_id' => $_GET['material_id']]);
$attachments = find_where('material_attachment', ['material_id' => $_GET['material_id']]);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <a href="?page=materials&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-secondary btn-sm px-4 mb-0">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="actions/manage_material.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="material_id" value="<?= $material['material_id'] ?>">
                        <div class="form-row">
                            <label class="mx-0">Material Name</label>
                            <input required class="form-control" value="<?= $material['material_name'] ?>" name="material_name" placeholder="Material Name" />
                            <input type="hidden" name="class_id" value="<?php echo $_GET['class_id'] ?>" />
                        </div>
                        <div class="form-row mt-2">
                            <label class="mx-0">Material Files <i>(Press ctrl to select multiple)</i></label>
                            <input required type="file" class="form-control" name="material_file[]" multiple />
                        </div>
                        <?php foreach ($attachments as $attachment) : ?>
                            <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-full p-3 rounded mt-1 shadow shadow-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa fa-paperclip"></i>
                                    <?= $attachment['material_fileName'] ?>
                                </div>
                                <a href="<?= $attachment['material_file'] ?>" download class="text-black download-hover">
                                    <i class="fa fa-download"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" name="edit_material" class="btn btn-success mt-3 px-4 btn-sm">
                            <i class="fa fa-check"></i>
                            Upload Materials
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>