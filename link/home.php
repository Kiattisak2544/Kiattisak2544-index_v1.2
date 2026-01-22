<?php

   include_once('../config/class.php');
     if(!isset($_SESSION['id_user'])){

        
             header("location: ../index");
     }else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- fontawesome v.6.6.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Css link -->
    <link rel="stylesheet" href="../responsive.css">
    <!-- bootstrap v5.0 -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.css"
        integrity="sha512-fjO3Vy3QodX9c6G9AUmr6WuIaEPdGRxBjD7gjatG5gGylzYyrEq3U0q+smkG6CwIY0L8XALRFHh4KPHig0Q1ug=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.js"
        integrity="sha512-LGHBR+kJ5jZSIzhhdfytPoEHzgaYuTRifq9g5l6ja6/k9NAOsAi5dQh4zQF6JIRB8cAYxTRedERUF+97/KuivQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- MCDatepicker -->
    <link href="https://cdn.jsdelivr.net/npm/mc-datepicker/dist/mc-calendar.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/mc-datepicker/dist/mc-calendar.min.js"></script>





</head>

<body>
    <div class="container-fluid main p-0">
        <?php include('../tool/header.php'); ?>
        <div class="row g-0">

            <?php  include('../tool/silebar.php')?>
            <div class="col p-0 bg-light">
                <div class="container" id="content">

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- โหลด Chart.js -->
    <script src="../script.js"></script>
    <!-- จัดการ Chart -->
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>
    <script src='../Chart_js.js'></script>
    <!-- Update Status -->
    <script src="../update_status.js"></script>
    <!-- ทำlink โดยไม่ต้อง refresh หน้า -->
    <script type="text/javascript">
    $(document).ready(function() {

        function loadPage(page) {

            $('#content').load(page, function() {

                // 🔥 เรียก dashboard หลังโหลดเสร็จ
                if (page === 'dashbord.php' && typeof dashboardChartInit === 'function') {
                    dashboardChartInit();
                }

                // ถ้ามี DataTable หน้าอื่น
                if (typeof data_table === 'function') {
                    data_table();
                }
            });
        }

        // โหลดหน้าแรก
        loadPage('dashbord.php');

        // คลิกเมนู
        $('a[link-data]').on('click', function(e) {
            e.preventDefault();

            const page = $(this).attr('link-data');
            loadPage(page);

            $('a[link-data]').removeClass('link-active');
            $(this).addClass('link-active');
        });

    });
    </script>
    <script>
    $(function() {

        $('#date-picker').load('date.html', function() {

            console.log('MCDatepicker =', window.MCDatepicker);

            if (!window.MCDatepicker) {
                console.error('MCDatepicker not loaded');
                return;
            }

            MCDatepicker.create({
                el: '#datepicker',
                bodyType: 'modal',
                dateFormat: 'yyyy-mm-dd'
            });

        });

    });
    </script>

</body>

</html>
<?php } ?>