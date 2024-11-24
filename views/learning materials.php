<?php
$material = first('material', ['material_id' => $_GET['material_id']]);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2 align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="?page=materials&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-secondary btn-sm px-4 mb-0">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>

                    <?php if ($_SESSION['usertype'] == 1) : ?>
                        <a href="?page=edit material&class_id=<?php echo $_GET['class_id'] ?>&material_id=<?= $material['material_id'] ?>" class="btn btn-outline-success btn-sm px-4 mb-0 font-bold">
                            <i class="fa fa-edit"></i>
                            Edit Material
                        </a>
                    <?php endif; ?>

                </div>
                <div class="card-body">
                    <p class="title-activity">
                        <i class="fa fa-cubes"></i>
                        <?= $material['material_name'] ?>
                    </p>
                    <?php
                    $materials = find_where('material_attachment', ['material_id' => $_GET['material_id']]);
                    ?>
                    <p class="m-0 mt-3 attachment_text">
                        <i class="fa fa-paperclip"></i>
                        Attachments
                    </p>
                    <div class="d-flex flex-column">
                        <?php foreach ($materials as $mat) : ?>
                            <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-50 p-3 rounded mt-1 shadow shadow-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa fa-paperclip"></i>
                                    <?= $mat['material_fileName'] ?>
                                </div>
                                <div class="d-flex gap-4">
                                    <a href="<?= $mat['material_file'] ?>" download="<?= $mat['material_fileName'] ?>" class="download-hover">
                                        <i class="fa fa-download"></i>
                                        Download
                                    </a>
                                    <?php
                                    $find_save = first('saved_file', ['user_id' => $_SESSION['user_id'], 'attachment_id' => $mat['material_attachment_id'], 'attachment_type' => 'material']);
                                    ?>

                                    <?php if (!$find_save) : ?>
                                        <a href="actions/manage_saved_file.php?save_file&attachment_id=<?= $mat['material_attachment_id'] ?>&class_id=<?php echo $_GET['class_id'] ?>&material_id=<?php echo $_GET['material_id'] ?>">
                                            <i class="fa fa-check"></i>
                                            Save
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>