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

    
        <div class="row g-1">
            <div class="col p-0 bg-light">
                <div class='text-header mt-4 '>
                    <h3 class='text-head_web'>เครื่องที่ซ่อมแล้ว</h3>
                    <hr>
                    <div class="col">
                        <h5 class="text-head_web">รายการซ่อม</h5>
                        <hr>
                        <div class="d-flex justify-content-md-between p-3 ">
                            <div class="row col-md-12">
                                <div class="col">
                                    <form action="">
                                        <div class="form-group">
                                            <input type="text" class="form-control " id="search"
                                                placeholder="ค้นหาชื่อ-นามสกุล หรือ เบอร์โทรศัพท์">
                                            <span id="search-massage"></span>
                                        </div>
                                    </form>
                                </div>
                                <!-- <div class="col-3 col-md-4">
                                    <button type="button" class="btn btm-md mx-auto btn-secondary"
                                        id="searchBtn">ค้นหา</button>
                                </div> -->
                                <div class="col-4 col-lg-4 d-flex justify-content-end">
                                    <button class="btn btn-primary " style="font-size:14px" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" id="addRepairBtn">เพิ่มข้อมูล</button>
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
    <!-- <script>
    $.Thailand({
        database: '../jquery.Thailand.js/database/db.json', // path หรือ url ไปยัง database
        $district: $('#district'), // input ของตำบล
        $amphoe: $('#amphoe'), // input ของอำเภอ
        $province: $('#province'), // input ของจังหวัด
        $zipcode: $('#zipcode'), // input ของรหัสไปรษณีย์
    });

    
    </script> -->

</body>

</html>
<?php } ?>