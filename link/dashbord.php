<?php
include_once('../config/class.php');
// $web = new websystem();
// $Data_user = $web->data_repair();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashbord</title>
    <!-- fontawesome v.6.6.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Css link -->
    <link rel="stylesheet" href="../responsive.css">
    <!-- bootstrap v5.0 -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />

</head>

<body>

    <div class='col-12 col-md-12 mx-auto'>
        <div class='text-header mt-4 '>
            <h3 class='text-head_web'>หน้าหลัก</h3>
            <hr>
            <div class="row  text-center g-2">
                <div class="col-12 col-md-4">
                    <div class="card mx-auto" style="width: 100%;">
                        <div class="card-body text-center">
                            <h5 class="card-title ">จำนวนการซ่อม</h5>
                            <p class="card-title fs-6 ">จำนวนการซ่อม / เดือน</p>
                            <span class="fs-6 mx-auto">100 เครื่อง</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card mx-auto" style="width: 100%;">
                        <div class="card-body text-center">
                            <h5 class="card-title ">ที่ทำการซ่อมแล้ว</h5>
                            <p class="card-title fs-6 "> เครื่อง / เดือน</p>
                            <h5 class="fs-6 mx-auto text-success">100 เครื่อง</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card mx-auto" style="width: 100%;">
                        <div class="card-body text-center">
                            <h5 class="card-title ">ที่ยังไม่ทำการซ่อม</h5>
                            <p class="card-title fs-6 "> เครื่อง / เดือน</p>
                            <h5 class="fs-6 mx-auto text-danger">100 เครื่อง</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 mx-auto">
                    <div class="mx-auto " id="chart_div"></div>
                </div>
            </div>
            <hr>
            <div class="col-12 col-md-12">
                <h5 class="text-head_web">รายการซ่อม</h5>
                <div class="d-flex justify-content-end p-1">
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 mb-1 col-form-label"
                            style="font-size:16px">ค้นหา</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class=" text-center" style="font-size: 14px;">#</th>
                                <th scope="col" class=" text-center" style="font-size: 14px;">ชื่อ-นามสกุล</th>
                                <th scope="col" class=" text-centerr"style="font-size: 14px;">เบอร์โทร</th>
                                <th scope="col" class=" text-center" style="font-size: 14px;">อาการเสีย</th>
                                <th scope="col" class=" text-center" style="font-size: 14px;">สถานะการซ่อม</th>
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
        </div>
    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="../script.js"></script>
</body>

</html>