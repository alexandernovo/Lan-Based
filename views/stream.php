<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2 align-items-center justify-content-between">
                    <?php
                    include 'class-header.php';
                    ?>
                    <button data-bs-toggle="modal" data-bs-target="#broadcast" class="btn btn-outline-primary mb-0 btn-sm font-bold">
                        <i class="fa fa-bullhorn "></i>
                        Announce
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-data">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Announcement</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Announcement Date</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $announcments = find_where('announcement', ['user_id' => $_SESSION['user_id']]);
                                ?>
                                <?php foreach ($announcments as $announcement) : ?>
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= $announcement['announcement_title'] ?></p>
                                        </td>

                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= $announcement['announcement_description'] ?></span>
                                        </td>

                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?= date('F j, Y h:i:s a', strtotime($announcement['announcement_date'])); ?></span>
                                        </td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="broadcast" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <i class="fa fa-bullhorn "></i>
                    Announcement
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="announcement_form">
                <div class="modal-body">
                    <div class="p-4 py-2">
                        <div class="form-row">
                            <label class="mx-0">Announcement Title</label>
                            <input required id="announcement_title" class="form-control">
                            <input id="user_id" class-id="<?php echo $_GET['class_id'] ?>" type="hidden" value="<?php echo $_SESSION['user_id'] ?>" class="form-control">
                        </div>
                        <div class="form-row">
                            <label class="mx-0">Announcement Description</label>
                            <textarea required id="announcement_description" class="form-control" style="height:150px"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-bullhorn "></i>
                        Announce
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>