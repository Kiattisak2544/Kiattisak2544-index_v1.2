<?php
include_once('../config/class.php');

 $web = new websystem();
 $result = $web->num_rows();

 $repair = $web->pass_repair();

 $not_repair = $web->notpass_repair();

 

 if(!isset($_SESSION['id_user'])){

        
    header("location: ../index");
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashbord</title>
    <!-- fontawesome v.6.6.0 -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <!-- Css link -->
    <link rel="stylesheet" href="../responsive.css">
    <!-- bootstrap v5.0 -->
    <!-- <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" /> -->


</head>

<body>

    <div class='col-12 col-md-12 mx-auto'>
        <div class='text-header mt-4 '>
            <h3 class='text-head_web'>หน้าหลัก</h3>
            <hr>
            <div class="row g-1">
                <div class="col-12 col-md-4">
                    <div class="card card-row card-primary mx-auto " style="width: 70%">
                        <div class="card-body  text-white">
                            <div class="row g-2 ">
                                <div class="col-3"><i class="fa-solid fa-toolbox fs-2"></i></div>
                                <div class="col-9">
                                    <h5 class="card-title " style="font-size:14px!important">จำนวนการซ่อม</h5>
                                    <span class="fs-6 mx-auto"> <?=$result; ?> </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card card-row card-success  mx-auto" style="width: 70%;">
                        <div class="card-body text-white">
                            <div class="row g-2 ">
                                <div class="col-3"><i class="fa-solid fa-check fs-2"></i></div>
                                <div class="col-9">
                                    <h5 class="card-title " style="font-size:14px!important">ที่ทำการซ่อมแล้ว</h5>
                                    <h5 class="fs-6 mx-auto "><?=$repair ?></h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card card-row card-warning  mx-auto" style="width: 70%;">
                        <div class="card-body text-white">
                            <div class="row g-2 ">
                                <div class="col-3"><i class="fa-solid fa-triangle-exclamation fs-2"></i></div>
                                <div class="col-9">
                                    <h5 class="card-title " style="font-size:14px!important">ที่ยังไม่ทำการซ่อม</h5>
                                    <h5 class="fs-6 mx-auto text-white"><?=$not_repair; ?> </h5>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 mx-auto">
                    <div class="mx-auto " id="chart_div"></div>
                </div>
            </div>
            <hr>
            <!--                
            <div class="col-12 col-md-12">
                <h5 class="text-head_web">รายการซ่อม</h5>

                <div class="d-flex justify-content-end p-1">
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 mb-1 col-form-label"
                            style="font-size:16px">ค้นหา</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="seach-input">
                        </div>
                    </div>
                </div>
                <div class="table-responsive shadow-sm  bg-body-tertiary rounded">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class=" text-center" style="font-size: 14px;">#</th>
                                <th scope="col" class=" text-center" style="font-size: 14px;">ชื่อ-นามสกุล</th>
                                <th scope="col" class=" text-center" style="font-size: 14px;">เบอร์โทร</th>
                                <th scope="col" class=" text-center" style="font-size: 14px;">อาการเสีย</th>
                                <th scope="col" class=" text-center" style="font-size: 14px;">วันที่แจ้งซ่อม</th>
                                <th scope="col" class=" text-center" style="font-size: 14px;">สถานะการซ่อม</th>
                                <th scope="col" class=" text-center" style="font-size: 14px;">ช่างผู้ทำการซ่อม</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                
                            </tr>
                        </thead>
                        <tbody id="response">


                        </tbody>
                    </table>
                </div>

                <div class="btn-toolbar m-3 d-flex justify-content-end" role="toolbar"
                    aria-label="Toolbar with button groups">
                    <div class="btn-group me-2" role="group" aria-label="First group" id="btn-group">

                    </div>
                </div>
                <hr>
            </div>
        </div> -->
            <div class="row g-2 p-1">
                <div class=" col-12 col-lg-6  ">
                    <div class="card  mx-auto">
                            <div class="card-body" style="width: 100%;height: 500px;">
                                <h5 class="card-title text-center text-content">สรุปการซ่อมประจำเดือน</h5>
                                <?php include_once('Chart.php') ?>
                            </div>
                        
                    </div>
                </div>
                <div class=" col-12 col-lg-6  ">
                    <div class="card mx-auto">
                        <div class="card-body" style="width: 100%;">
                            <h5 class="card-title text-center text-content" id = "card-title">ประเภทการซ่อม ภายใน(JIB)/ ภายนอก (รายเดือน)</h5>
                            <?php include('Chart_circle_type_com.php') ?>
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
        <!-- โหลด Chart.js -->
        <script src="../script.js"></script>




</body>

</html>
<?php }?>