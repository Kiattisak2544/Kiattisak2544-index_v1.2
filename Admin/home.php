<?php

include_once('../config/class.php');
if(!isset($_SESSION['id_user'])){
    header("location: ../index");
    exit(); // Always exit after a header redirect
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../responsive.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.css" 
        integrity="sha512-fjO3Vy3QodX9c6G9AUmr6WuIaEPdGRxBjD7gjatG5gGylzYyrEq3U0q+smkG6CwIY0L8XALRFHh4KPHig0Q1ug==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- sweetalert2 -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.css" integrity="sha512-fjO3Vy3QodX9c6G9AUmr6WuIaEPdGRxBjD7gjatG5gGylzYyrEq3U0q+smkG6CwIY0L8XALRFHh4KPHig0Q1ug==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.js" integrity="sha512-LGHBR+kJ5jZSIzhhdfytPoEHzgaYuTRifq9g5l6ja6/k9NAOsAi5dQh4zQF6JIRB8cAYxTRedERUF+97/KuivQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <div class="container-fluid main p-0">
        <nav class="navbar navbar-expand-md navbar-light bg-body shadow-sm z-3 p-3 mb-0 bg-body rounded">
            <?php $web = new websystem(); $Data_user = $web->Display_user(); ?>
            <div class="container justify-content-between">
                <a class="btn-md btn-body " data-bs-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <a class="navbar-brand text-sm-center fs-5" href="#">DASHBORD</a>
                <div class="d-flex justify-content-between gap-5 dropdown">
                    <a href="#" class="text-decoration-none position-relative " role="button" id="popup-btn"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bell fs-4"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu left-1 p-1" aria-labelledby="popup-btn">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>

                    <div class="dropdown ">
                        <a href="#" class=" link-underline link-underline-opacity-0 " id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='fa-solid fa-user fs-4'></i>
                        </a>
                        <ul class="dropdown-menu col-md-z-3 " aria-labelledby="dropdownMenuButton1"
                            style="right: 0; left: auto;">
                            <li class="shadow-sm p-2 nav-link rounded">
                                <a class="dropdown-item " href="#"><?=$Data_user['Firstname_repair'];?>
                                    <?=$Data_user['Lastname_repair'];?>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a class="dropdown-item" href="#">
                                    <hr>
                                </a>
                            </li>
                            <li class="nav-link">
                                <a class="dropdown-item" href="#"><i
                                            class="fa-solid fa-gear rounded-circle bg-secondary text-light bg-gradient p-2"></i>
                                    ตั้งค่า</a></li>
                            <li class="nav-link">
                                <a class="dropdown-item" href="../logout.php"><i
                                            class="fa-solid fa-right-to-bracket rounded-circle bg-secondary text-light bg-gradient p-2"></i>
                                    ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row g-0">
            <nav class="collaspse show border col-12 col-md-12 col-lg-2 p-0 z-2 position-sm-absolute bg-body "
                id="collapseExample">
                <ul class="navbar-nav me-4 d-block me-auto mb-2 mb-lg-0 p-3">
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="manage_user" link-data="manage_user.php"><i
                                class="fa-solid fa-chart-line"></i> จัดการข้อมูล</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php"><i class="fa-solid fa-sign-out"></i> ออกจากระบบ</a>
                    </li>
                </ul>
            </nav>
            <div class="col p-0 bg-light">
                <div class="container" id="content">
                    </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.js" 
        integrity="sha512-LGHBR+kJ5jZSIzhhdfytPoEHzgaYuTRifq9g5l6ja6/k9NAOsAi5dQh4zQF6JIRB8cAYxTRedERUF+97/KuivQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Load initial page content
            $('#content').load('manage_user.php');

            $('a[link-data]').click(function(e) {
                e.preventDefault(); // Prevent default link behavior
                const page = $(this).attr('link-data'); // Get the page to load
                $('#content').load(page, function() {
                    // Callback function after content is loaded.
                    // This is where you would initialize DataTables for the loaded content.
                    // However, since DataTables JS is now global, manage_user.php's own script
                    // should handle it directly.
                });

                $('a[link-data]').removeClass('link-active'); // Remove active class from all links
                $(this).addClass('link-active'); // Add active class to the clicked link
            });
        });
    </script>
</body>
</html>
<?php } ?>