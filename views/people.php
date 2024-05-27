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
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#people" class="btn btn-outline-success btn-sm mb-0">
                                <i class="fa fa-plus-circle"></i>
                                Add People
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-data">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Added Date</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $peoples = joinTable('users', [['class_people', 'class_people.user_id', 'users.user_id']], ['class_people.class_id' => $_GET['class_id']]);
                                ?>
                                <?php foreach ($peoples as $people) : ?>
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
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"><?= $people['usertype'] == 1 ? "Teacher" : "Student" ?></p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm <?= $people['userstatus'] == 1 ? "bg-gradient-success" : "bg-gradient-danger" ?>"><?= $people['userstatus'] == 1 ? "Active" : "Inactive" ?></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo date('F j, Y', strtotime($people['added_date'])); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="actions/manage_people.php?remove&class_people_id=<?= $people['class_people_id'] ?>&class_id=<?php echo $_GET['class_id'] ?>" class="d-flex align-items-center justify-content-center gap-1 remove-button text-danger">
                                                <i class="fa fa-times"></i>
                                                Remove
                                            </a>
                                        </td>
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

<div class="modal fade" id="people" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add People</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="actions/manage_people.php" method="POST">
                <div class="px-4 py-2">
                    <table class="table align-items-center mb-0 table-data">
                        <thead>
                            <tr>
                                <th class="text-secondary opacity-7 text-center ps-2 pe-5" width="5%">
                                    <input type="checkbox" id="userid_all">
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $class_id = $_GET['class_id'];
                            $query = "
                            SELECT * FROM users 
                            WHERE users.user_id NOT IN (
                                SELECT class_people.user_id 
                                FROM class 
                                INNER JOIN class_people ON class.class_id = class_people.class_id 
                                WHERE class.class_id = '$class_id'
                            )
                            AND users.usertype = 0
                            ";
                            $result = mysqli_query($conn, $query);
                            ?>

                            <?php while ($people = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td width="5%">
                                        <input type="checkbox" class="userid" value="<?= $people['user_id'] ?>" name="user_id[]">
                                        <input type="hidden" name="class_id" value="<?php echo $_GET['class_id'] ?>">
                                    </td>
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
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  px-3 btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-sm  px-3 btn-primary" name="add_people"><i class="fa fa-plus-circle"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>