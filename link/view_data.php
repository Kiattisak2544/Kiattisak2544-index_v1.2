<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View_data</title>
    <link rel="stylesheet" href="../responsive.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />

    <!-- ✅ Load SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container-fluid ">
        <div class="row g-2 p-3">
            <div class="col-4 col-md-2">
                <img src="../img/logo.png" alt="" class="img-fluid" style="width: 100px; height: 70px;">
            </div>
            <div class="col-8 col-md-10 ">
                <h3 class="text-head_web text-label fw-bold">บริษัท เจ.ไอ.บี คอมพิวเตอร์ กรุ๊ป (สาขาชัยนาท)</h3>
                <p class="text-lowercase text-label mb-1">เลขที่ 90/3-4 ถนนพรหมประเสริฐ ตำบลในเมือง อำเภอเมืองชัยนาท จังหวัดชัยนาท 17000</p>
                
            </div>
            <hr>
            <div class="col-12 col-md-12 text-center">
                <h1 class="text-head_web fw-bold fs-5">ใบแจ้งซ่อม</h1>
            </div>
            <div class="col-6 col-md-8">
                <lebel class="fw-bold">วันที่รับงาน:</lebel>&nbsp;<span class="fst-normal" id="date"></span>
            </div>
            <div class="col-6 col-md-4">
                <lebel class="fw-bold">ลำดับคิว:</lebel>&nbsp;<span class="fst-normal" id="id"></span>
            </div>
            <div class="col-12 col-md-6">
                <lebel class="text-head_web " style="font-size:14px">ชื่อลูกค้า(User name) </label><span
                        class="fst-normal" id="firstname"></span>&nbsp; &nbsp;<span id="lastname"></span>
            </div>
            <div class="col-12 col-md-6">
                <lebel class="text-head_web " style="font-size:14px">เบอร์โทรศัพท์(Tel.) </label><span
                        class="fst-normal" id="tel-phone"></span>
            </div>
            <div class="col-12 col-md-">
                <lebel class="text-head_web " style="font-size:14px">ที่อยู่(Address): ตำบล.</label><span
                        class="fst-normal" id="district"></span>&nbsp; &nbsp;<lebel class="text-head_web "
                        style="font-size:14px">อำเภอ.</label><span class="fst-normal" id="amphoe"></span>&nbsp; &nbsp;
                        <lebel class="text-head_web " style="font-size:14px">จังหวัด </label><span class="fst-normal"
                                id="province"></span>&nbsp; &nbsp;<label class="text-head_web "
                                style="font-size:14px">รหัสไปรษณีย์ </label> &nbsp;<span class="fst-normal"
                                id="zipcode"></span>
            </div>
            <hr>
            <div class="col-12 col-md-12 ">
                <h1 class="text-head_web fw-bold fs-5">อาการเสีย</h1>
            </div>
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

                        <div class="col-4 col-md-3">
                            <p type="text" value="" id="other1" class="mb-1 "></p>
                            <p class="my-3 w-75" style="border-bottom: 2px dotted rgb(0, 0, 0); "></p>

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
                            <p type="text" value="" id="product_condition" class="mb-1 "></p>
                            <p class="my-3 w-75" style="border-bottom: 2px dotted rgb(0, 0, 0); "></p>

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
                        <div class="col-4 col-md-3">
                            <p type="text" value="" id="detail" class="mb-1 "></p>
                            <p class="my-3 w-75" style="border-bottom: 2px dotted rgb(0, 0, 0); "></p>

                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row g-0">
                        <div class="col-4 col-md-2">
                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" value="1" id="es15">
                                <label class="form-check-label text-label" for="es15">
                                    ข้อมูลสำคัญ
                                </label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <p type="text" value="" id="Important" class="mb-1 "></p>
                            <p class="my-3 w-75" style="border-bottom: 2px dotted rgb(0, 0, 0); "></p>

                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col-12 col-md-12 ">
                <h1 class="text-head_web fw-bold fs-5">สรุปอาการเสีย</h1>
            </div>
            <div class="col-12 col-md-12 ">
                <p class="text-label fs-6 mx-5" id="mainternace_detail"></p>
            </div>
            <hr>
            <div class="row g-0">
                <div class="col-6 col-md-6 text-start">
                    <label for="" class="text-label fw-bold">ผู้ส่งซ่อม:</label>&nbsp;<span class="text-label"
                        id='firstname1'></span><br>
                    <label class="text-label fw-bold">วันที่</label>&nbsp;<span class="text-label"
                        id="date-main"></span>
                </div>
                <div class="col-6 col-md-6 text-end">
                    <label for="" class="text-label fw-bold">ผู้รับซ่อม:</label>&nbsp;<span class="text-label"
                        id='technician'></span><br>
                    <label class="text-label fw-bold">วันที่</label>&nbsp;<span class="text-label"
                        id="dates"></span>
                </div>

            </div>

        </div>


        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <!-- ajax -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
        $(document).ready(function() {
            var id = new URLSearchParams(window.location.search).get('id');

            $.ajax({
                url: '../api/print_data.php?id=' + id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    if (res) {
                        if (Array.isArray(res) && res.length > 0) {
                            var data = res[
                                0]; // Assuming you want the first object in the array
                            date = new Date(data.date);
                            var options = {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                            };
                            var formattedDate = date.toLocaleDateString('th-TH', options)
                                .replace(/\//g, '-');
                            $('#firstname').text(data.firstname);
                            $('#firstname1').text(data.firstname);
                            $('#lastname').text(data.lastname);
                            $('#tel-phone').text(data.telephone);
                            $('#district').text(data.district);
                            $('#amphoe').text(data.amphoe);
                            $('#province').text(data.province);
                            $('#zipcode').text(data.zip_code);
                            $('#date').text(formattedDate);
                            $('#date-main').text(formattedDate);
                            $('#id').text(data.id_broken);
                            $('#technician').text(data.technician);
                            $('#dates').text(formattedDate);




                            for (var i = 1; i <= 15; i++) {
                                var field = 'es' + i;
                                var value = data[field];

                                if (value == 1) {
                                    $('#' + field).prop('checked', true);

                                } else {
                                    $('#' + field).prop('checked', false);
                                }


                            }

                            $('#Important').text(data.Important);
                            $('#detail').text(data.detail);
                            $('#product_condition').text(data.product_condition);
                            $('#other1').text(data.other1);
                            $('#mainternace_detail').text(data.mainternace_detail);




                        } else {
                            console.error('Invalid data format:', res);
                            $('#firstname').text("ไม่พบข้อมูล");
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    $('#firstname').text("เกิดข้อผิดพลาดในการดึงข้อมูล");
                }
            });
        });
        </script>
</body>

</html>