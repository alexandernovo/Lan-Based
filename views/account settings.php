<div class="container-fluid py-4">
    <div class="row mx-auto">
        <div class="col-6 mx-auto">
            <div class="card mb-4 p-4">
                <form action="actions/manage_user.php" method="POST">
                    <div class="px-2 py-2">
                        <div class="form-row">
                            <label class="mb-1 mx-0">Firstname</label>
                            <input name="firstname" value="<?php echo $_SESSION['firstname'] ?>" class="form-control" placeholder="Firstname">
                        </div>
                        <div class="form-row">
                            <label class="mb-1 mx-0">Middlename</label>
                            <input name="middlename" value="<?php echo $_SESSION['middlename'] ?>" class="form-control" placeholder="Middlename">
                        </div>
                        <div class="form-row">
                            <label class="mb-1 mx-0">Lastname</label>
                            <input name="lastname" value="<?php echo $_SESSION['lastname'] ?>" class="form-control" placeholder="Lastname">
                        </div>
                        <div class="form-row">
                            <label class="mb-1 mx-0">Email</label>
                            <input name="email" value="<?php echo $_SESSION['email'] ?>" type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-row">
                            <label class="mb-1 mx-0">Username</label>
                            <input name="username" value="<?php echo $_SESSION['username'] ?>" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-row">
                            <label class="mb-1 mx-0">Password</label>
                            <div class="d-flex position-relative align-items-center">
                                <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                                <i class="fa fa-eye position-absolute password-class-icon cursor-pointer text-secondary" onclick="seePassword('password')"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm px-3 btn-primary w-100 mt-3" name="update_profile"><i class="fa fa-check"></i> Update Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>