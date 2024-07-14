<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4" style="min-height: 580px;">
                <div class="card-header d-flex p-2 align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="d-flex gap-2 ">
                            <i class="fa fa-file text-primary text-sm opacity-10"></i>
                            <h6 class="mb-0">Save Files</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                    $save_files = joinTable('saved_file', [['material_attachment', 'saved_file.attachment_id', 'material_attachment.material_attachment_id']], ['saved_file.user_id' => $_SESSION['user_id']]);
                    ?>
                    <div class="d-flex gap-2">
                        <?php foreach ($save_files as $save_file) : ?>
                            <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-50 p-3 rounded mt-1 shadow shadow-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa fa-paperclip"></i>
                                    <?= $save_file['material_fileName'] ?>
                                </div>
                                <div class="d-flex gap-4">
                                    <a href="actions/manage_saved_file.php?remove&type=<?= $save_file['attachment_type'] ?>&saved_file_id=<?= $save_file['saved_file_id'] ?>" class="download-hover text-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <a href="<?= $save_file['material_file'] ?>" download=" <?= $save_file['material_fileName'] ?>" class="download-hover">
                                        <i class="fa fa-arrow-circle-o-down"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>