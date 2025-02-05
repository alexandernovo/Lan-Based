<div class="border signup-border">
    <div class="d-flex justify-content-center flex-column">
        <img src="public/assets/img/logo.png" class="mx-auto logo">
        <p class="text-center login-title">LAN-BASED Academic Files Repository System</p>
    </div>
    <form method="POST" action="actions/register.php">
        <div class="form-row">
            <label>Firstname</label>
            <input name="firstname" placeholder="Firstname" value="<?php echo getValue('firstname') ?>" class="form-control">
            <?php if (showError('firstname')) :
                echo showError('firstname');
            endif; ?>
        </div>
        <div class="form-row">
            <label>Middlename</label>
            <input name="middlename" placeholder="Middlename" value="<?php echo getValue('middlename') ?>" class="form-control">
            <?php if (showError('middlename')) :
                echo showError('middlename');
            endif; ?>
        </div>
        <div class="form-row">
            <label>Lastname</label>
            <input name="lastname" placeholder="Lastname" value="<?php echo getValue('lastname') ?>" class="form-control">
            <?php if (showError('lastname')) :
                echo showError('lastname');
            endif; ?>
        </div>
        <!-- <div class="form-row">
            <label>Email</label>
            <input name="email" placeholder="Email" value="<?php echo getValue('email') ?>" class="form-control">
            <?php if (showError('email')) :
                echo showError('email');
            endif; ?>
        </div> -->
        <div class="form-row">
            <label>Username</label>
            <input name="username" placeholder="Username" value="<?php echo getValue('username') ?>" class="form-control">
            <?php if (showError('username')) :
                echo showError('username');
            endif; ?>
        </div>
        <div class="form-row">
            <label>Password</label>
            <div class="d-flex position-relative align-items-center">
                <input name="password" placeholder="Password" value="<?php echo getValue('password') ?>" id="password" type="password" class="form-control">
                <i class="fa fa-eye position-absolute password-class-icon cursor-pointer text-secondary" onclick="seePassword('password')"></i>
            </div>
            <?php if (showError('password')) :
                echo showError('password');
            endif; ?>
        </div>
        <div class="form-row">
            <label>Confirm Password</label>
            <div class="d-flex position-relative align-items-center">
                <input name="confirmpassword" placeholder="Confirm Password" value="<?php echo getValue('confirmpassword') ?>" id="confirmpassword" type="password" class="form-control">
                <i class="fa fa-eye position-absolute password-class-icon cursor-pointer text-secondary" onclick="seePassword('confirmpassword')"></i>
            </div>
            <?php if (showError('confirmpassword')) :
                echo showError('confirmpassword');
            endif; ?>
        </div>
        <div class="form-row mb-3">
            <button name="register" type="submit" class="btn btn-success w-100 mt-3 login-button font-bold py-2">SIGN UP</button>
            <p class="text-center mt-2">Already have an account?? <a class="text-decoration-none" href="?page=login">Login Here</a></p>
        </div>
    </form>
</div>