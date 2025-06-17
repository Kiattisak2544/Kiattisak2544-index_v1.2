<?php
include_once('../config/class.php');
if(!isset($_SESSION['id_user'])){
    $_SESSION['Firstname_repair'];
    header("location: ../index");
}else{

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>repair</title>
    <link rel="stylesheet" href="../responsive.css">
    <!-- Sweet alert v.2 -->

    <!-- ✅ Load SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    <div class="container-fluid">
        <div class="row g-1">
            <div class="col p-0 bg-light">
                <div class='text-header mt-4 '>
                    <h3 class='text-head_web'>เครื่องที่ซ่อมแล้ว</h3>
                    <hr>
                    <div class="col-12 col-md-12">
                        <h5 class="text-head_web">รายการซ่อม</h5>
                        <hr>
                        <div class="d-flex justify-content-between p-3 ">
                            <div class="row col-md-g-5 col-md-12 g-2">
                                <div class="col-5 col-md-4">
                                    <form action="">
                                        <input type="text" class="form-control search" id="search"
                                            placeholder="ค้นหาชื่อ-นามสกุล หรือ เบอร์โทรศัพท์">
                                        <span id="search-massage"></span>
                                    </form>
                                </div>
                                <div class="col-3 col-md-4">
                                    <button type="button" class="btn btm-md mx-auto btn-secondary"
                                        id="searchBtn">ค้นหา</button>
                                </div>
                                <div class="col-4 col-lg-4 ่d-flex justify-content-end">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" id="addRepairBtn">เพิ่มรายการซ่อม</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="technician" value="<?php echo $_SESSION['Firstname_repair']; ?>">
                        <!-- Modal -->
                        <div class="modal-dialog" id="modal">
                            <?php include_once('modal.php') ?>
                        </div>
                        <div class="table-responsive shadow-sm  bg-body-tertiary rounded">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" class=" text-center text-header-1">#</th>
                                        <th scope="col" class=" text-center text-header-1">ชื่อ-นามสกุล</th>
                                        <th scope="col" class=" text-center text-header-1">เบอร์โทร</th>
                                        <th scope="col" class=" text-center text-header-1">อาการเสีย</th>
                                        <th scope="col" class=" text-center text-header-1">วันที่แจ้งซ่อม</th>
                                        <th scope="col" class=" text-center text-header-1">สถานะการซ่อม</th>
                                        <th scope="col" class=" text-center text-header-1">ผู้ทำการซ่อม</th>
                                        <th scope="col"></th>
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
        </div>
    </div>
    <!-- jquery -->

    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> -->
    <!-- ajax -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

    <!-- Api autocomplete Thailand -->
    <script type="text/javascript" src="../jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="../jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <link rel="stylesheet" href="../jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript" src="../jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
    <script src="../fetch_table.js"></script>
    <script>
    $.Thailand({
        database: '../jquery.Thailand.js/database/db.json', // path หรือ url ไปยัง database
        $district: $('#district'), // input ของตำบล
        $amphoe: $('#amphoe'), // input ของอำเภอ
        $province: $('#province'), // input ของจังหวัด
        $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
    });

    $(document).ready(function() {
        // หน้าข้อมูล
        function render_data() {
            var html = "";
            for (var i = (page - 1) * 10; i < page * 10; i++) {
                if (i < data.length) {
                    if (data[i].status === "1") {
                        repairClass = 'text-success';
                        repairText = 'success';
                    } else {
                        repairClass = 'text-warning';
                        repairText = 'waiting';
                    }
                    html += ` <tr>
                      <th class='text-center text-content-table' style = 'font-size:14px'>${i + 1}</th>
                        <td class='text-center text-content-table' style = 'font-size:14px'>${data[i].firstname}   ${data[i].lastname}</td>
                        <td class='text-center text-content-table' style = 'font-size:14px'>${data[i].telephone}</td>
                        <td class='text-center text-content-table' style = 'font-size:14px'>${data[i].detail}</td>   
                        <td class='text-center text-content-table' style = 'font-size:14px'>${data[i].date}</td>   
                        <td class='text-center text-content-table ${repairClass}' style='font-size:14px!important' id='status' data-id = '${data[i].id}'>${repairText}</td>
                        <td class='text-center text-content-table' style = 'font-size:14px'>${data[i].technician}</td> 
                        <td class='text-center text-content-table' style = 'font-size:14px'><button class='btn btn-sm btn-success btn-update' data-id = '${data[i].id}'><i class="fa-solid fa-check"></i></button></td> 
                        <td class='text-center text-content-table' style = 'font-size:14px'><buttom class='btn btn-sm btn-danger btn-remove' data-id = '${data[i].id}'><i class="fa-solid fa-trash"></i></buttom></td> 
                        <td class='text-center text-content-table' style = 'font-size:14px'><buttom class='btn btn-sm btn-primary btn-view' id = 'btn-view'  data-id = '${data[i].id}'><i class="fa-regular fa-eye"></i></buttom></td> 
                        </tr>
                  `;
                }
                // แสดงข้อมูลในตาราง
                $("#response").html(html);
                // ceil ปัดเศษ ในกรณีหารกันแล้วมีเลขทศนิยม
                totalpage = Math.ceil(data.length / 10);
                var pagination_html = "";
                pagination_html =
                    `<div onclick="back_page()" class="btn btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> </div>`;
                for (let i = 1; i <= totalpage; i++) {
                    pagination_html += `<div id="page${i}" onclick="current_page(${i})" class="btn btn btn-outline-secondary ${page === i ? "active" : ""
                                }  " aria-current='page'>${i}</div>`;
                }
                pagination_html +=
                    `<div onclick="next_page()" class="number-pagination btn btn btn-secondary"><i class="fa-solid fa-arrow-right"></i> </div>`;

                // update page
                $("#btn-group").html(pagination_html);
            }
        }
        // ปุ่มถัดไปและปุ่มก่อนหน้า
        function next_page() {
            if (page != totalpage) {
                page++;
                render_data();
            }
        }
        // ปุ่มก่อนหน้า
        function back_page() {
            if (page != 1) {
                page--;
                render_data();
            }
        }
        // ปุ่มหน้า
        function current_page(cupage) {
            page = cupage;

            render_data();
        }
        //  สร้าง function data_table
        function data_table() {
            $.ajax({
                url: "/index_v1.2/api/search_repair.php",
                type: "post",
                dataType: "JSON",
                success: function(res) {
                    data = res.map(function(item) {
                        console.log(item);
                        return {
                            id: item.id_broken,
                            firstname: item.firstname,
                            lastname: item.lastname,
                            detail: item.mainternace_detail,
                            status: item.status,
                            telephone: item.telephone,
                            technician: item.technician,
                            date: item.date.split(" ")[0],
                        };
                    });
                    render_data();
                },
            });
        }
        $('#searchBtn').click(function() {
            const searchValue = $('#search').val();

            if (searchValue.trim() === "") {
                // $('#search-massage').text("กรุณากรอกข้อมูล!!");
                // $('#search-massage').addClass('text-danger');
                data_table();
                return;
            } else {
                $('#search-massage').text("");
                $('#search-massage').removeClass('text-danger');

                $.ajax({
                    url: '/index_v1.2/api/search_repair.php',
                    type: 'POST',
                    dataType: 'json',
                    data: JSON.stringify({
                        searchValue: searchValue
                    }),
                    contentType: 'application/json',
                    success: function(res) {
                        data = res.map(function(item) {
                            return {
                                id: item.id_broken,
                                firstname: item.firstname,
                                lastname: item.lastname,
                                detail: item.mainternace_detail,
                                status: item.status,
                                telephone: item.telephone,
                                date: item.date.split(" ")[0]
                            };
                        });
                        render_data();
                    }

                });
            }

        });



        $('#repairForm').on('submit', function(e) {
            e.preventDefault();
            // .prop('checked') ตรวจสอบ checkbox ถูกเลือกหรือไม่

            const FormData = {
                firstname: $('#firstname').val(),
                lastname: $('#lastname').val(),
                telnumber: $('#telnumber').val(),
                district: $('#district').val(),
                amphoe: $('#amphoe').val(),
                province: $('#province').val(),
                zipcode: $('#zipcode').val(),
                es1: $('#es1').prop('checked') ? $('#es1').val() : "",
                es2: $('#es2').prop('checked') ? $('#es2').val() : "",
                es3: $('#es3').prop('checked') ? $('#es3').val() : "",
                es4: $('#es4').prop('checked') ? $('#es4').val() : "",
                es5: $('#es5').prop('checked') ? $('#es5').val() : "",
                es6: $('#es6').prop('checked') ? $('#es6').val() : "",
                es7: $('#es7').prop('checked') ? $('#es7').val() : "",
                es8: $('#es8').prop('checked') ? $('#es8').val() : "",
                es9: $('#es9').prop('checked') ? $('#es9').val() : "",
                es10: $('#es10').prop('checked') ? $('#es10').val() : "",
                es11: $('#es11').prop('checked') ? $('#es11').val() : "",
                es12: $('#es12').prop('checked') ? $('#es12').val() : "",
                es13: $('#es13').prop('checked') ? $('#es13').val() : "",
                es14: $('#es14').prop('checked') ? $('#es14').val() : "",
                es15: $('#es15').prop('checked') ? $('#es15').val() : "",
                other1: $('#other1').val(),
                product_condition: $('#product_condition').val(),
                mainternace_detail: $('#mainternace_detail').val(),
                detail: $('#detail').val(),
                Important: $('#Important').val(),
                status: 0,
                Computer_type: $('#Computer_type').val(),
                maintenance_type: $('#maintenance_type').val(),
                service: $('#service').val(),
                technician: $('#technician').val(),
            };



            // console.log(FormData.es1);
            $('#submitBtn').prop('disabled', true).text('กำลังส่งข้อมูล...');

            $.ajax({
                url: "/index_v1.2/api/submit_repair.php",
                type: "POST",
                dataType: "JSON",
                data: JSON.stringify(FormData),
                contentType: "application/json",
                success: function(res) {
                    // console.log(res)
                    $('#submitBtn').prop('disabled', false).text('ส่งข้อมูล');
                    // alert(res.success);
                    // console.log(res);
                    if (res.success == true) {
                        Swal.fire({
                            title: "บันทักข้อมูลสำเร็จ",
                            text: "บันทึกข้อมูลสำเร็จ",
                            icon: "success",
                            draggable: true
                        });
                        setTimeout(() => {
                            window.location.href = "../link/home.php";
                        }, 2000);
                    } else {
                        Swal.fire({
                            title: "บันทึกข้อมูลไม่สำเร็จ!!",
                            text: "กรุณาลองใหม่อีกครั้งภายหลัง",
                            icon: "error",
                            draggable: false
                        });
                        setTimeout(() => {

                        }, 2000);
                    }
                },


            });
        });

        $(document).ready(function() {
            $('#telnumber').on('input', function() {
                let phone = $(this).val().replace(/\D/g, ''); // ลบตัวอักษรที่ไม่ใช่ตัวเลข
                if (phone.length > 10) phone = phone.substring(0, 10); // จำกัดแค่ 10 ตัว

                // จัดรูปแบบ xxx-xxx-xxxx
                if (phone.length >= 7) {
                    phone = phone.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
                } else if (phone.length >= 4) {
                    phone = phone.replace(/(\d{3})(\d{3})/, '$1-$2');
                }
                $(this).val(phone);

                // ตรวจสอบว่าเบอร์ถูกต้องหรือไม่
                if (phone.replace(/\D/g, '').length !== 10) { // เอาแค่ตัวเลขมานับ
                    $(this).removeClass('border-success').addClass('border-danger border-2');
                    $('#tel-alert').addClass('text-danger').text(
                        "กรุณาระบุเบอร์โทรศัพท์มือถือให้ถูกต้อง");
                } else {
                    $(this).removeClass('border-danger').addClass('border-success border-2');
                    $('#tel-alert').removeClass('text-danger').text(
                        ""); // ลบข้อความแจ้งเตือนเมื่อถูกต้อง
                    $('#tel-alert').addClass('text-success').text(
                        "กรอกเบอร์โทรศัพท์มือถือถูกต้อง");
                }
            });

        });

    });
    $(document).on('click', '.btn-remove', function() {
        const id = $(this).data('id');
        const row = $(this).closest('tr');
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการลบข้อมูลนี้!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบเลย!'

        }).then((result) => {
            // เช็คว่าผู้ใช้กดยืนยันการลบหรือไม่
            if (result.isConfirmed) {
                $.ajax({
                    url: '/index_v1.2/api/delete_repair.php',
                    type: 'POST',
                    dataType: 'json',
                    data: JSON.stringify({
                        id: id
                    }),
                    contentType: 'application/json',
                    success: function(res) {
                        if (res.success) {
                            Swal.fire('ลบแล้ว!', 'ข้อมูลถูกลบแล้ว', 'success');
                            row.remove(); // ลบแถวออกจากตาราง
                        } else {
                            Swal.fire('เกิดข้อผิดพลาด!', res.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('เกิดข้อผิดพลาด!', 'ไม่สามารถลบข้อมูลได้', 'error');
                    }
                });
            }
        });


    });

    $(document).on('click', '.btn-view', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '/index_v1.2/api/view_repair.php?id=' + id,
            type: 'GET',
            dataType: 'json',
            data: JSON.stringify({
                id: id
            }),
            contentType: 'application/json',
            success: function(res) {
                if (res.success) {
                    window.location.href = "../link/view_data.php?id=" + id;
                } else {
                    Swal.fire('เกิดข้อผิดพลาด!', res.message, 'error');
                }
            },
            error: function() {
                Swal.fire('เกิดข้อผิดพลาด!', 'ไม่สามารถดึงข้อมูลได้', 'error');
            }
        });

    });
    </script>

</body>

</html>
<?php } ?>