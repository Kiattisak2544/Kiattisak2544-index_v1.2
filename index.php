<?php
    include_once('config/class.php');

    $web = new websystem();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <!-- fontawesome v.6.6.0 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Css link -->
    <link rel="stylesheet" href="responsive.css">
    <!-- bootstrap v5.0 -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.css" integrity="sha512-fjO3Vy3QodX9c6G9AUmr6WuIaEPdGRxBjD7gjatG5gGylzYyrEq3U0q+smkG6CwIY0L8XALRFHh4KPHig0Q1ug==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.js" integrity="sha512-LGHBR+kJ5jZSIzhhdfytPoEHzgaYuTRifq9g5l6ja6/k9NAOsAi5dQh4zQF6JIRB8cAYxTRedERUF+97/KuivQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</head>

<body class="bg-color">
    <div class="container mx-auto ">
        <div class="col-sm-10 col-md-11  position-absolute position-absolute top-50 start-50 translate-middle">
            <div class=" d-md-flex justify-content-between">
                <div class="col-12 col-md-6 px-md-3 px-3 mr-0">
                    <div class="col-sm-12 mb-sm-3 col-sm-6  col-md-12">
                        <img src="img/logo.png" alt="" class="img-fluid img-logo ml-md-2">
                        <h4 class="text-head_web">ระบบจัดการฐานข้อมูลลูกค้าการซ่อม และ ข้อมูลลูกค้าเคลมสินค้าภายในร้าน
                        </h4>
                    </div>
                </div>
                <div class="col-12 col-md-6 p-0">
                    <div class="card border-0 mx-auto shadow p-3 mb-5 bg-body rounded">
                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="post" id="myform">
                                    <!-- <h3 class="card-title text-center">เข้าสู่ระบบ</h3> -->
                                    <div class="col-md-12">
                                        <label for="" class="headders-1">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control rounded-pill" id="username">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="" class="headders-1">รหัสผ่าน</label>
                                        <input type="password" class="form-control rounded-pill" id="password">
                                    </div>
                                    <div class="col-md-12 mt-4 text-center">
                                        <button type="submit"
                                            class="col-12 col-md-12 btn btn-login btn-primary btn-md rounded-pill"
                                            id="btn-login" href="#" role="button"><i class="fa fa-sign-in"
                                                aria-hidden="true"></i>เข้าสู่ระบบ</button>
                                        <hr>
                                        <a href="register.php" class="link ">สมัครสมาชิก</a>
                                    </div>
                                </form>
                            </div>
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
    <script>
    $(document).ready(function() {
        $('#myform').on('submit', function(e) {
            e.preventDefault();
            const formData = {
                username: $('#username').val(),
                password: $('#password').val()
            }

            $.ajax({
                url: '/index_v1.2/api/login',
                type: 'post',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(res) {
                    if (res.success === true && res.User_status == "Technician") {
                        Swal.fire({
                            title: "Login",
                            icon: "success",
                            text : res.message,
                            draggable: true
                        });
                        setTimeout(() => {
                            window.location.href = "link/home";
                        }, 2000);
                    }else if(res.success === true && res.User_status == "Admin"){
                             Swal.fire({
                            title: "Login",
                            icon: "success",
                            text : res.message,
                            draggable: true
                        });
                        setTimeout(() => {
                            window.location.href = "Admin/home";
                        }, 2000);
                    }
                    else if(res.success === true && res.User_status == "Sale"){
                             Swal.fire({
                            title: "Login",
                            icon: "success",
                            text : res.message,
                            draggable: true
                        });
                        setTimeout(() => {
                            window.location.href = "Sale/home";
                        }, 2000);
                    }
                    else {
                        Swal.fire({
                            title: "Login",
                            icon: "error",
                            text : res.message,
                            draggable: true
                        });
                    }
                }
            });
        });
        
    });
    </script>
</body>

</html>