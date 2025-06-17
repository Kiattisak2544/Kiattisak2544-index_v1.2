<?php
date_default_timezone_set('asia/bangkok');
$date = date('d-m-Y');

include_once('../config/class.php');

 $web = new websystem();

$fecth = $web->service_rates();

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
    <link rel="stylesheet" href="../responsive.css">
    <title>Modal</title>
</head>

<body>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form id="repairForm" method="POST">
                    <div class="modal-header ">
                        <h5 class="modal-title" id="exampleModalLabel">ฟอร์ม ส่งเครื่องซ่อม</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Step 1 -->
                    <div class="modal-body" id="step1">
                        <p class="position-absolute top-1 mt-1 mx-4 text-cusstomer">ข้อมูลลูกค้า</p>
                        <div class="col-md-12 p-1 border rounded border-1 mt-3 ">
                            <div class="row g-1 p-3">
                                <div class="col-12 col-md-4">
                                    <label for="firstname" class="col-form-label col-form-label-sm">ชื่อ</label>
                                    <input type="text" class="form-control form-control-sm" id="firstname"
                                        autocomplete="off">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="lastname" class="col-form-label col-form-label-sm">นามสกุล</label>
                                    <input type="text" class="form-control form-control-sm" id="lastname"
                                        autocomplete="off">
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="telnumber" class="col-form-label col-form-label-sm">เบอร์โทร</label>
                                    <input type="text" class="form-control form-control-sm" id="telnumber"
                                        autocomplete="off">
                                    <label id="tel-alert" style="font-size:14px!important"></label>
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="district" class="col-form-label col-form-label-sm">ตำบล</label>
                                    <input type="text" class="form-control form-control-sm" id="district"
                                        autocomplete="off">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="amphoe" class="col-form-label col-form-label-sm">อำเภอ</label>
                                    <input type="text" class="form-control form-control-sm" id="amphoe"
                                        autocomplete="off">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="province" class="col-form-label col-form-label-sm">จังหวัด</label>
                                    <input type="text" class="form-control form-control-sm" id="province"
                                        autocomplete="off">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="zipcode" class="col-form-label col-form-label-sm">รหัสไปรษณีย์</label>
                                    <input type="text" class="form-control form-control-sm" id="zipcode"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <p class="position-absolute top-1 mt-1 mx-4 text-cusstomer">อาการเสีย</p>
                        <div class="col-md-12 p-1 border rounded border-1 mt-3 ">
                            <div class="row g-3 p-3">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es1">
                                        <label class="form-check-label text-label" for="es1">
                                            เปิดไม่ติด
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es2">
                                        <label class="form-check-label text-label" for="es2">
                                            ภาพลาย
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es3">
                                        <label class="form-check-label text-label" for="3">
                                            รีสตาร์ทเอง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es4">
                                        <label class="form-check-label text-label" for="es4">
                                            ซ่อมครั้งที่1
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es5">
                                        <label class="form-check-label text-label" for="es5">
                                            เปิดติดบ้างไม่ติดบ้าง
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es6">
                                        <label class="form-check-label text-label" for="es6">
                                            ไม่ขึ้นภาพ
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es7">
                                        <label class="form-check-label text-label" for="es7">
                                            ไม่มีเสียง (เสียงไม่ออก)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="ซ่อมครั้งที่2" id="1">
                                        <label class="form-check-label text-label" for="es8">
                                            ซ่อมครั้งที่2
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es9">
                                        <label class="form-check-label text-label" for="es9">
                                            ลงวินโดว์ไม่ผ่าน
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es10">
                                        <label class="form-check-label text-label" for="es10">
                                            จอฟ้า
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" id="es11">
                                        <label class="form-check-label text-label" for="es11">
                                            เข้าวินโดว์ไม่ได้
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row g-0">
                                        <div class="col-6 col-sm-3 col-md-7">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="es12">
                                                <label class="form-check-label text-label" for="es12">
                                                    อื่น ๆ โปรดระบุ
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-4 col-md-5">
                                            <input type="text" name="other1" class="form-control form-control-sm"
                                                value="" id="other1" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row g-0">
                                        <div class="col-4 col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="es13">
                                                <label class="form-check-label text-label" for="es13">
                                                    สภาพสินค้า
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <input type="text" name="product_condition"
                                                class="form-control form-control-sm" value="" id="product_condition"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row g-0">
                                        <div class="col-6 col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="es14">
                                                <label class="form-check-label text-label" for="es14">
                                                    อื่น ๆ โปรดระบุโดยละเอียด
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-3">
                                            <input type="text" name="detail" class="form-control form-control-sm"
                                                value="" id="detail" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row g-0">
                                        <div class="col-4 col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="es15">
                                                <label class="form-check-label text-label" for="es15">
                                                    ข้อมูลสำคัญ
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <input type="text" name="Important" class="form-control form-control-sm"
                                                value="" id="Important" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="position-absolute top-1 mt-1 mx-4 text-cusstomer">อาการเสีย</p>
                        <div class="col-md-12 p-1 border rounded border-1 mt-3 ">
                            <div class="col-md-12">

                                <label for="mainternace_detail"
                                    class="col-form-label col-form-label-sm">สรุปรายการเสีย</label>
                                <input type="text" value="" name="mainternace_detail"
                                    class="form-control form-control-sm" id="mainternace_detail" autocomplete="off">

                            </div>
                        </div>

                        <p class="position-absolute top-1 mt-1 mx-4 text-cusstomer">ประเภทเครื่อง</p>
                        <div class="col-md-12 p-1 border rounded border-1 mt-3 ">
                            <div class="col-md-12">

                                <div class="row g-2">
                                    <div class="col-12 col-md-4">
                                        <label for="mainternace_detail"
                                            class="col-form-label col-form-label-sm">ประเภทของเครื่อง</label>
                                        <select class="form-select form-select-sm" id="Computer_type" aria-label="Small select example">
                                            <option selected>กรุณาเลือกประเภทเครื่อง...</option>
                                            <option value="computer_out">เครื่องนอก</option>
                                            <option value="computer_in-jib">เครื่องของ JIB Computer </option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="mainternace_detail"
                                            class="col-form-label col-form-label-sm">ประเภทการซ่อม</label>
                                        <select class="form-select form-select-sm" id="maintenance_type" aria-label="Small select example">
                                            <option selected>กรุณาเลือกประเภทการซ่อม...</option>
                                            <option value="mainternac">ซ่อมเอง</option>
                                            <option value="claim">ส่ง Claim </option>
                                            <option value=" warranty_expired">สินค้าหมดประกัน </option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="mainternace_detail"
                                            class="col-form-label col-form-label-sm">อัตตราค่าบริการ</label>
                                        <select class="form-select form-select-sm" id="service" aria-label="Small select example">
                                            <?php 
                                                    foreach($fecth as $row){

                                                ?>
                                            <option value="<?=$row['service_price'];?>" id="brand"><?=$row['Service_name'];?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn-cancel"
                            data-bs-dismiss="modal">ยกเลิก</button>
                        <button type="submit" class="btn btn-success" id="submitBtn"><i class="fa-solid fa-check"></i>
                            ยืนยัน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</body>

</html>
<?php } ?>