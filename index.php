<?php require_once('config/config.php');


if (isset($_GET['class_id'])) {
    $class_settings = first('class', ['class_id' => $_GET['class_id']]);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <!--===============================================================================================-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="public/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="public/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="public/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="public/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="public/assets/css/main.css">
    <!--===============================================================================================-->
    <?php if (isset($_GET['page']) == 'calendar') : ?>
        <link rel="stylesheet" href="public/assets/fullcalendar/fullcalendar.min.css" />
    <?php endif; ?>
    <!--===============================================================================================-->
    <title>LAN-Based Academic Files Repository System</title>
</head>

<body class="g-sidenav-show bg-gray-100 h-height-100">
    <div class="min-height-300 bg-success position-absolute w-100"></div>
    <?php
    if (isset($_SESSION['username'])) {
    ?>
        <aside class="sidenav bg-white navbar border navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
            <div class="sidenav-header position-sticky top-0 bg-white">
                <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
                <a class="navbar-brand m-0 bg-white" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
                    <img src="public/assets/img/logo.png" class="navbar-brand-img h-100" alt="main_logo">
                    <span class="ms-1 font-weight-bold">LAN BASED AFRS</span>
                </a>
                <hr class="horizontal dark mt-0">
            </div>
            <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="?page=classes">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Classes</span>
                        </a>
                    </li>

                    <?php if ($_SESSION['usertype'] == 1) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=users">
                                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-users text-primary text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Users</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <a class="nav-link " href="?page=calendar">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Calendar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="?page=notification">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-bell cursor-pointer text-success text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Notification</span>
                        </a>
                    </li>

                    <?php if ($_SESSION['usertype'] == 0) : ?>
                        <li class="nav-item">
                            <a class="nav-link align-items-center" href="?page=offline files">
                                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-file cursor-pointer text-secondary text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Offline Files</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($_SESSION['usertype'] == 0) : ?>
                        <li class="nav-item">
                            <a class="nav-link " href="?page=archive classes">
                                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-cloud-download cursor-pointer text-primary text-sm opacity-10"></i>
                                </div>
                                <span class="nav-link-text ms-1">Archived Classes</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="?page=settings">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-cog text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="?page=help">
                            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-question-circle text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Help</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
    <?php
    }
    ?>
    <main class="main-content position-relative border-radius-lg h-height-100">
        <?php
        if (isset($_SESSION['username'])) {
        ?>
            <nav class="navbar navbar-main navbar-expand-lg px-0 me-2 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
                <div class="container-fluid py-1 px-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                            <li class="breadcrumb-item text-sm text-white active text-capitalize" aria-current="page"><?php echo isset($_GET['page']) ? $_GET['page'] : '' ?></li>
                        </ol>
                        <h6 class="font-weight-bolder text-white mb-0 text-capitalize"><?php echo isset($_GET['page']) ? $_GET['page'] : '' ?></h6>
                    </nav>
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">

                        </div>
                        <ul class="navbar-nav  justify-content-end">
                            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item px-3 d-flex align-items-center dropdown dropstart">
                                <button type="button" class="btn btn-transparent shadow-none px-1 dropdown-toggle mb-0 text-white" id="dropdownMenuLink" aria-expanded="false">
                                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                                    <li>
                                        <button class="dropdown-item" type="button">
                                            <i class="fa fa-cog "></i>
                                            Settings
                                        </button>
                                    </li>
                                    <li>
                                        <a href="actions/login.php?logout" class="dropdown-item" type="button">
                                            <i class="fa fa-sign-out "></i>
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                                <a onclick="showPopup('notif')" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell cursor-pointer"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4 popup" id="notif" aria-labelledby="dropdownMenuButton">
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                    <img src="public/assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New message</span> from Laur
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        13 minutes ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md " href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="my-auto">
                                                    <img src="public/assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">New album</span> by Travis Scott
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        1 day
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                                                    <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <title>credit-card</title>
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                                                <g transform="translate(1716.000000, 291.000000)">
                                                                    <g transform="translate(453.000000, 454.000000)">
                                                                        <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                                                        <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        Payment successfully completed
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        2 days
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php
        }
        ?>
        <?php
        if (isset($_GET['page'])) {
            if (!isset($_SESSION['username'])) {
                require_once("views/login.php");
            } else {
                require_once("views/" . $_GET['page'] . ".php");
            }
        } else {
            require_once("views/login.php");
        }
        ?>
    </main>
    <!--===============================================================================================-->
    <!-- Toast Message Notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fa fa-bell me-2"></i>
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" data-bs-toggle="#liveToast" id="close-broadcast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <p id="title_announcement" class="font-bold-free">
                </p>
                <p id="description_announcement">
                </p>
            </div>
        </div>
    </div>
    <!--===============================================================================================-->
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
    <script src="public/assets/js/core/popper.min.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/core/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/plugins/chartjs.min.js"></script>
    <!--===============================================================================================-->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/datatable.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/websocket.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/main.js"></script>
    <!--===============================================================================================-->
    <script src="public/assets/js/extension.js"></script>
    <!--===============================================================================================-->
    <?php if (isset($_GET['page']) == 'calendar') : ?>
        <script src="public/assets/fullcalendar/lib/jquery.min.js"></script>
        <script src="public/assets/fullcalendar/lib/moment.min.js"></script>
        <script src="public/assets/fullcalendar/fullcalendar.min.js"></script>
        <script src="public/assets/fullcalendar/calendarCode.js"></script>
    <?php endif; ?>
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
    <script>
        $(document).ready(function() {
            <?php if (isset($_SESSION['user_id'])) : ?>
                localStorage.setItem('user_id', <?php echo $_SESSION['user_id'] ?>);
            <?php endif; ?>
        });
    </script>


</body>

</html>