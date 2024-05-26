<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex p-2  align-items-center justify-content-between">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="d-flex gap-2 ">
                            <i class="fa fa-users text-primary text-sm opacity-10"></i>
                            <h6 class="mb-0">Users</h6>
                        </div>
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#people" class="btn btn-outline-success btn-sm mb-0">
                                <i class="fa fa-plus-circle"></i>
                                Register Users
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registered Date</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $peoples = findAll('users');
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
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo date('F j, Y', strtotime($people['registereddate'])); ?></span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Register People</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="actions/manage_user.php" method="POST">
                <div class="px-4 py-2">
                    <div class="form-row">
                        <label class="mb-1 mx-0">Type</label>
                        <select name="usertype" class="form-select">
                            <option value="0">Student</option>
                            <option value="1">Teacher</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <label class="mb-1 mx-0">Firstname</label>
                        <input name="firstname" class="form-control" placeholder="Firstname">
                    </div>
                    <div class="form-row">
                        <label class="mb-1 mx-0">Middlename</label>
                        <input name="middlename" class="form-control" placeholder="Middlename">
                    </div>
                    <div class="form-row">
                        <label class="mb-1 mx-0">Lastname</label>
                        <input name="lastname" class="form-control" placeholder="Lastname">
                    </div>
                    <div class="form-row">
                        <label class="mb-1 mx-0">Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-row">
                        <label class="mb-1 mx-0">Username</label>
                        <input name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-row">
                        <label class="mb-1 mx-0">Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  px-3 btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-sm  px-3 btn-primary" name="register"><i class="fa fa-check"></i> Register</button>
                </div>
            </form>
        </div>
    </div>
</div>