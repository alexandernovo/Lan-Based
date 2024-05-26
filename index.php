<?php require_once('config/config.php');

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/login_assets/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/login_assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/login_assets/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/login_assets/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/login_assets/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/login_assets/css/util.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="public/login_assets/css/main.css">
    <!--===============================================================================================-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--===============================================================================================-->
    <link href="public/assets/css/style.css" rel="stylesheet" />
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!--===============================================================================================-->
    <title>Resource Generation Unit Management System</title>
</head>


<body style="<?php echo isset($_SESSION['Admin_Username']) && isset($_GET['page']) && $_GET['page'] != "login" ? 'padding-left: 300px !important;' : ''; ?>">
    <div class="d-flex align-items-start position-relative">
        <?php if (isset($_SESSION['Admin_Username']) && isset($_GET['page']) && $_GET['page'] != "login") : ?>
            <div style="width: 280px; height:100vh; position:fixed !important; left:0">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; height:100vh">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <div class="sidebar-profile">
                            <img class="profile" src="public/assets/img/janiuay_logo.png">
                        </div>
                        <span class="fs-4 font-bold">RGU</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="?page=home" class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] == 'home' ? 'active' : 'link-dark' ?>" aria-current="page">
                                <i class="fa fa-home"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="?page=schools" class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] == 'schools' ? 'active' : 'link-dark' ?>">
                                <i class="fa fa-graduation-cap"></i>
                                Schools
                            </a>
                        </li>
                        <li>
                            <a href="?page=student" class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] == 'student' ? 'active' : 'link-dark' ?>">
                                <i class="fa fa-users"></i>
                                Student
                            </a>
                        </li>
                        <li>
                            <a href="?page=items" class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] == 'items' ? 'active' : 'link-dark' ?>">
                                <i class="fa fa-list-alt"></i>
                                Items
                            </a>
                        </li>
                        <li>
                            <a href="?page=orders" class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] == 'orders' ? 'active' : 'link-dark' ?>">
                                <i class="fa fa-list"></i>
                                Orders
                            </a>
                        </li>
                        <li>
                            <a href="?page=report" class="nav-link <?php echo isset($_GET['page']) && $_GET['page'] == 'report' ? 'active' : 'link-dark' ?>">
                                <i class="fa fa-list-alt"></i>
                                Report
                            </a>
                        </li>
                        <li>
                            <a href="actions/logout.php" class="nav-link link-dark">
                                <i class="fa fa-sign-out"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <!--===============================================================================================-->
        <?php
        if (isset($_GET['page'])) {
            if (!isset($_SESSION['Admin_Username'])) {
                require_once("views/login.php");
            } else {
                require_once("views/" . $_GET['page'] . ".php");
            }
        } else {
            require_once("views/login.php");
        }
        ?>
        <!--===============================================================================================-->

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <!--===============================================================================================-->
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/script.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/ajax.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/effects.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/description.js"></script>
    <!--===============================================================================================-->
    <?php if ($flash = getFlash('success')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: "<?php echo $flash; ?>",
                showConfirmButton: true,
            });
        </script>
    <?php endif; ?>
    <!--===============================================================================================-->
    <?php if ($flash = getFlash('failed')) : ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: "<?php echo $flash; ?>",
                showConfirmButton: true,
            });
        </script>
    <?php endif; ?>
    <!--===============================================================================================-->
</body>

</html>