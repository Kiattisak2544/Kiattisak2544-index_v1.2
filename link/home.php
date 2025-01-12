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
    <!-- ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- script js -->
    <script src="../script.js"></script>
    <script>
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
    // ทำปุ่ม updatae status 
    $(document).on("click", ".btn-update", function() {
        // ดึง ID จาก data-id ของปุ่มที่คลิก
        const id = $(this).data("id");

        // ส่งคำขอ AJAX เพื่ออัปเดตสถานะ
        $.ajax({
            url: "/index_v1.2/api/update_status.php", // URL สำหรับอัปเดต
            type: "POST",
            dataType: "JSON",
            data: JSON.stringify({
                id: id
            }), // ส่ง ID ไปที่เซิร์ฟเวอร์
            contentType: "application/json",
            success: function(response) {
                if (response.success) {
                    // แสดงข้อความแจ้งเตือน หรืออัปเดต UI
                    alert("สถานะอัปเดตสำเร็จ!");

                    // โหลดข้อมูลใหม่หลังจากอัปเดต
                    data_table();
                } else {
                    alert("ไม่สามารถอัปเดตสถานะได้: " + response.message);
                }
            },
            error: function() {
                alert("เกิดข้อผิดพลาดขณะส่งคำขอ!");
            },
        });
    });
    </script>

</body>

</html>
<?php } ?>