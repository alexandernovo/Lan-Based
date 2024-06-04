<div class="border login-border">
    <div class="d-flex justify-content-center flex-column">
        <img src="public/assets/img/logo.png" class="mx-auto logo">
        <p class="text-center login-title">LAN-BASED Academic Files Repository System</p>
    </div>
    <form method="POST" action="actions/login.php">
        <div class="form-row">
            <label>Username</label>
            <input name="username" value="<?php echo getValue('username') ?>" class="form-control">
            <?php if (showError('username')) :
                echo showError('username');
            endif; ?>
        </div>
        <div class="form-row">
            <label>Password</label>
            <input name="password" type="password" class="form-control">
            <?php if (showError('password')) :
                echo showError('password');
            endif; ?>
        </div>
        <div class="form-row mb-3">
            <button name="login" type="submit" class="btn btn-success w-100 mt-3 login-button font-bold py-2">LOGIN</button>
        </div>
    </form>
</div>