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
                    $session_user_id = $_SESSION['user_id'];
                    // $save_files = joinTable('saved_file', [['material_attachment', 'saved_file.attachment_id', 'material_attachment.material_attachment_id']], ['saved_file.user_id' => $_SESSION['user_id']]);
                    $query = "
                        SELECT 
                            ma.material_fileName AS filename,
                            sf.attachment_type,
                            sf.saved_file_id,
                            ma.material_file AS file,
                            sf.saved_datetime
                        FROM material_attachment as ma INNER JOIN saved_file AS sf ON sf.attachment_id = ma.material_attachment_id
                        WHERE sf.user_id = $session_user_id

                        UNION ALL

                         SELECT 
                            at.attachment_name AS filename,
                            sf.attachment_type,
                            sf.saved_file_id,
                            at.attachment_file AS file,
                            sf.saved_datetime
                        FROM attachments as at INNER JOIN saved_file AS sf ON sf.attachment_id = at.attachment_id
                        WHERE sf.user_id = $session_user_id
                        
                        ORDER BY saved_datetime DESC
                    ";

                    $result = mysqli_query($conn, $query);
                    $save_files = [];

                    while ($row = mysqli_fetch_assoc($result)) {
                        $save_files[] = $row;
                    }
                    ?>
                    <div class="d-flex w-100">
                        <?php foreach ($save_files as $save_file) : ?>
                            <div class="col-2 d-flex justify-content-center align-items-center flex-column p-2">
                                <div class="border p-3 rounded">
                                    <div class="border p-2 rounded" style="height: 130px; width:100%">
                                        <img src="public/assets/img/defaultfile.png" class="w-100 h-100 object-fit-cover" alt="">
                                    </div>
                                    <hr class="my-1">
                                    <p style="font-size: 12px; width: 80%" class="mb-0 text-truncate"><?= $save_file['filename'] ?></p>
                                    <div class="d-flex gap-4">
                                        <a href="actions/manage_saved_file.php?remove&type=<?= $save_file['attachment_type'] ?>&saved_file_id=<?= $save_file['saved_file_id'] ?>" message="Remove this File?" class="download-hover text-danger routeFile">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <a href="<?= $save_file['file'] ?>" download=" <?= $save_file['filename'] ?>" class="download-hover">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>