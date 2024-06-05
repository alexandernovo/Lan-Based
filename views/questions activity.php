<?php
$activity = first('activity', ['activity_id' => $_GET['activity_id'], 'activity_type' => 'question']);
?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <p class="m-0 text-white class_header"><?= $class_settings['classname'] ?> (<?= $class_settings['section'] ?>)</p>
            <div class="card mb-4">
                <div class="card-header d-flex p-2 align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="?page=questions&class_id=<?php echo $_GET['class_id'] ?>" class="btn btn-secondary btn-sm px-4 mb-0">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                    <?php if ($_SESSION['usertype'] == 1) : ?>
                        <a href="?page=edit question&class_id=<?php echo $_GET['class_id'] ?>&activity_id=<?php echo $_GET['activity_id'] ?>" class="btn btn-outline-success btn-sm px-4 mb-0 font-bold">
                            <i class="fa fa-edit"></i>
                            Edit Question
                        </a>
                    <?php endif; ?>

                </div>
                <div class="card-body">
                    <p class="title-activity">
                        <i class="fa fa-cubes"></i>
                        <?= $activity['activity_title'] ?>
                    </p>
                    <p class="activity-description font-bold m-0">Question Description</p>
                    <li class="activity-description">
                        <?= $activity['activity_description'] ?>
                    </li>
                    <?php
                    $attachments = find_where('attachments', ['activity_id' => $_GET['activity_id']]);
                    ?>
                    <p class="m-0 mt-3 attachment_text">
                        <i class="fa fa-paperclip"></i>
                        Attachments
                    </p>
                    <div class="d-flex flex-column">
                        <?php foreach ($attachments as $attachment) : ?>
                            <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-50 p-3 rounded mt-1 shadow shadow-sm">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa fa-paperclip"></i>
                                    <?= $attachment['attachment_name'] ?>
                                </div>
                                <a href="<?= $attachment['attachment_file'] ?>" download class="text-black download-hover">
                                    <i class="fa fa-arrow-circle-o-down"></i>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
                    $submission_check = last('submission', ['activity_id' => $_GET['activity_id'], 'user_id' => $_SESSION['user_id']], 'submission_index');
                    ?>
                    <div class="d-flex justify-content-between align-items-center w-50">
                        <p class="title-activity mb-0">
                            <i class="fa fa-folder mt-2"></i>
                            Submission
                        </p>
                        <?php if ($submission_check) : ?>
                            <button style="font-size: 11px;" class="btn shadow-none mb-0 cursor-pointer">Edit Submission</button>
                        <?php endif; ?>
                    </div>
                    <?php if ($_SESSION['usertype'] == 0) : ?>
                        <?php if (!$submission_check) { ?>
                            <div class="border rounded p-3 w-50">
                                <form method="POST" action="actions/manage_submission.php" enctype="multipart/form-data">
                                    <label class="mb-0 mx-0">Submission File</label>
                                    <input type="hidden" name="activity_id" value="<?php echo $_GET['activity_id'] ?>">
                                    <input type="hidden" name="class_id" value="<?php echo $_GET['class_id'] ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                                    <input name="submission_file[]" type="file" class="form-control" multiple />
                                    <button type="submit" name="add_submission_question" class="btn btn-success btn-sm mt-2 px-4">
                                        <i class="fa fa-check"></i>
                                        Submit
                                    </button>
                                </form>
                            </div>
                        <?php } else { ?>
                            <?php
                            $submissions = find_where('submission', ['activity_id' => $submission_check['activity_id'], 'submission_index' => $submission_check['submission_index']]);
                            foreach ($submissions as $submission) : ?>
                                <div class="activity-file text-decoration-none d-flex gap-1 justify-content-between align-items-center mb-1 text-dark border w-50 p-3 rounded mt-1 shadow shadow-sm">
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="fa fa-paperclip"></i>
                                        <?= $submission['submission_fileName'] ?>
                                    </div>
                                    <a href="<?= $submission['submission_file'] ?>" download class="text-black download-hover">
                                        <i class="fa fa-arrow-circle-o-down"></i>
                                    </a>
                                </div>
                    <?php endforeach;
                        }
                    endif; ?>

                    <?php if ($_SESSION['usertype'] == 1) : ?>
                        <div class="border rounded p-3 ">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 table-data">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Submission Date</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $activity_id = $_GET['activity_id'];
                                        $query = "SELECT * FROM users 
                                                    INNER JOIN submission ON users.user_id = submission.user_id 
                                                    WHERE submission.activity_id = '$activity_id'
                                                    GROUP BY submission.submission_index, submission.activity_id";
                                        $result = mysqli_query($conn, $query);
                                        ?>
                                        <?php while ($people = mysqli_fetch_assoc($result)) : ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="public/assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?= $people['firstname'] . ' ' . $people['lastname'] ?></h6>
                                                            <p class="text-xs text-secondary mb-0"><?= $people['email'] ?></p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm <?= $people['userstatus'] == 1 ? "bg-gradient-success" : "bg-gradient-danger" ?>">Pending</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold"><?php echo date('F j, Y', strtotime($people['submission_date'])); ?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <a class="btn btn-primary btn-sm px-4 rounded mb-0 py-1">View</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>