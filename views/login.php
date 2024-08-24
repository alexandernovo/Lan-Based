<div class="border login-border">
    <div class="d-flex justify-content-center flex-column">
        <img src="public/assets/img/logo.png" class="mx-auto logo">
        <p class="text-center login-title">LAN-BASED Academic Files Repository System</p>
    </div>
    <form method="POST" action="actions/login.php">
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
                <input name="password" placeholder="Password" id="password" type="password" class="form-control">
                <i class="fa fa-eye position-absolute password-class-icon cursor-pointer text-secondary" onclick="seePassword('password')"></i>
            </div>
            <?php if (showError('password')) :
                echo showError('password');
            endif; ?>
        </div>
        <div class="form-row mb-3">
            <button name="login" type="submit" class="btn btn-success w-100 mt-3 login-button font-bold py-2">LOGIN</button>
            <p class="text-center mt-2">No Acccount? <a class="text-decoration-none" href="?page=signup">Register Here</a></p>
        </div>
    </form>
</div>