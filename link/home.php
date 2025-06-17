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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.css" integrity="sha512-fjO3Vy3QodX9c6G9AUmr6WuIaEPdGRxBjD7gjatG5gGylzYyrEq3U0q+smkG6CwIY0L8XALRFHh4KPHig0Q1ug==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.js" integrity="sha512-LGHBR+kJ5jZSIzhhdfytPoEHzgaYuTRifq9g5l6ja6/k9NAOsAi5dQh4zQF6JIRB8cAYxTRedERUF+97/KuivQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
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
    <!-- ทำlink โดยไม่ต้อง refresh หน้า -->
    <script  type="text/javascript">
        $(document).ready(function() {
            data_table();
                // โหลดหน้า page ที่มีการคลิก
                $('#content').load('dashbord.php');
                $('a[link-data]').click(function(e) {
                    e.preventDefault(); // ป้องกันการโหลดหน้าใหม่
                const page = $(this).attr('link-data'); // ดึงค่า data-page มาเก็บไว้ในตัวแปร page
                    $('#content').load(page); // โหลดหน้า page มาแสดงใน content

                    $('a[link-data]').removeClass('link-active'); // ลบ class active ทุกตัว
                    $(this).addClass('link-active'); // เพิ่ม class active ให้กับลิงค์ที่ถูกคลิก
            });
        });
    </script>
    <script src="../update_status.js"></script>
    <!-- script js -->
    <!-- <script src="../script.js"></script> -->

</body>

</html>
<?php } ?>