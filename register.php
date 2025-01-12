<?php
         include_once('config/class.php');
         $web = new websystem();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <!-- fontawesome v.6.6.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="responsive.css">
    <!-- bootstrap v5.0 -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />



</head>

<body class="bg-color">
    <div class="alert alert-danger z-1" id="response" role="alert" style="display:none"></div>
    <div class="container-fluid  ">
        <div class="col-sm-12 col-md-12 mt-md-5  position-absolute position-absolute top-50 start-50 translate-middle">
            <div class="col-md-12">
                <div class="text-center">
                    <!-- <img src="img/logo.png" alt="" class="img-fluid img-logo ml-md-2"> -->
                </div>
            </div>

            <div class="col p-0">
                <div class="card border-0 mx-auto shadow p-3 mb-5 bg-body rounded" style="width: 450px;">
                    
                    <div class="card-body">
                    <div class="col-12 col-md-12">
                        <a href="index.php" class="my-2 d-flex justify-content-end text-decoration-none text-dark"><i class="fa-solid fa-x"></i></a>
                    </div>
                        <div class="col-md-12">
                            <form method="POST" id="myform">
                                <?php
                                            $fecth = $web->brand();

                                            // print_r($fecth);
                                    ?>
                                <h3 class="card-title text-center text-header">สมัครสมาชิก</h3>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <label for="firstname" class="headders-1">ชื่อจริง</label>
                                        <input type="text" class="form-control firstname  " id="firstname"
                                            name="lastname" autocomplete="off">
                                        <span id="fname-alert" class="text text-danger"
                                            style="display : none; font-size:12px"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastname" class="headders-1">นามสกุล</label>
                                        <input type="text" class="form-control " id="lastname" name="lastname"
                                            autocomplete="off">
                                        <span id="lname-alert" class="text text-danger"
                                            style="display : none; font-size:12px"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="brand" class="headders-1">สาขา</label>
                                    <select class="form-select headders-1" aria-label="Default select example" id="brand"
                                        name="brand">
                                        <!-- <option value="0">Plese Enter brand...</option> -->
                                        <?php 
                                                    foreach($fecth as $row){
                                                ?>
                                        <option value="<?=$row['brand_id'];?>" id="brand"><?=$row['brand_name'];?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <span class="text text-danger" id ="text-brand" style="display : none"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="user_number" class="headders-1">รหัสพนักงาน</label>
                                    <input type="text" class="form-control " id="user_number" name="user_number"
                                        autocomplete="off">
                                        <span class="text text-danger" id ="user_alert" style="display : none; font-size:12px"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="headders-1">อีเมล</label>
                                    <input type="email" class="form-control " id="email" name="email"
                                        autocomplete="off">
                                        <span class="text text-danger" id ="email_alert" style="display : none; font-size:12px"></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="username" class="headders-1">ชื่อผู้ใช้</label>
                                    <input type="text" class="form-control " id="username" name="username"
                                        autocomplete="off">
                                </div>
                                <div class="col-md-12">
                                    <label for="password" class="headders-1">รหัสผ่าน</label>
                                    <input type="password" class="form-control " id="password" name="password"
                                        autocomplete="off">
                                        <div id="alert-password" class="text-danger" style=" font-size:14px"></div>
                                </div>
                                <div class="col-md-12">
                                    <label for="password" class="headders-1">ยืนยันรหัสผ่าน</label>
                                    <input type="password" class="form-control " id="confirm_password" name="confirm_password"
                                        autocomplete="off">
                                        <div class="text-danger" id ="alert-password" style="display : none; font-size:12px"></div>
                                </div>
                                <div class="col-md-12 mt-4 text-center">
                                    <button type="submit" class="col-12 col-md-12 btn btn-register btn-success btn-md "
                                        id="btn-regis" href="#" role="button">สร้างบัญชี</button>

                                </div>
                            </form>
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

    <!-- <script> 
   $(document).ready(function() {
        $('#myform').on('submit', function(e) {
            e.preventDefault();

            const formData = {
                firstname: $('#firstname').val(),
                lastname: $('#lastname').val(),
                brand: $('#brand').val(),
                user_number: $('#user_number').val(),
                email: $('#email').val(),
                username: $('#username').val(),
                password: $('#password').val()
            }
            // console.log(formData);
            $.ajax({
                url: '/index_v1.2/api/regis.php',
                type: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(res) {
                    if (res.success === true) {
                        $('#response').removeClass('alert-danger').addClass(
                            'alert-success').text(res.message).show();

                    } else {
                        $('#response').removeClass('alert-success').addClass(
                            'alert-danger').text(res.message).show();
                    }
                }
            });
        });
    });
    </script> -->
    <script src="script.js"></script>

</body>

</html>