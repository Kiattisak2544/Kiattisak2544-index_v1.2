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
    <!-- Css link -->
    <link rel="stylesheet" href="../responsive.css">
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
            <div class="row g-2 p-1">
                <div class=" col-12 col-lg-6  ">
                    <div class="card  mx-auto">
                        <div class="card-body" style="width: 100%;height: 500px;">
                            <h5 class="card-title text-center text-content">สรุปการซ่อมประจำเดือน</h5>
                            <div id="date-picker">
                                <div class="form-field">
                                    <label class="form-field__label">เลือกวันที่</label>
                                    <input id="datepicker" type="text" class="form-control input-custom">
                                </div>

                            </div>
                            <?php include_once('Chart.php') ?>
                        </div>

                    </div>
                </div>
                <div class=" col-12 col-lg-6  ">
                    <div class="card mx-auto">
                        <div class="card-body" style="width: 100%;">
                            <h5 class="card-title text-center text-content" id="card-title">ประเภทการซ่อม ภายใน(JIB)/
                                ภายนอก (รายเดือน)</h5>
                            <?php include('Chart_circle_type_com.php') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
$(document).ready(function() {

    function DatePicker(data) {
        const datePicker = MCDatepicker?.default || MCDatepicker;


        if (!datePicker) {
            console.error('MCDatepicker not loaded');
            return;
        }

        MCDatepicker.create({
            el: '#datepicker',
            bodyType: 'modal',
            dateFormat: 'yyyy'
        });
        // ✅ ดึงค่าปีทันทีหลังเลือกครั้งแรก
        $('#datepicker').val(new Date().getFullYear());

        // ดัก input
        $(document).on('input', '#datepicker', function() {
            const year = $(this).val();


            if (year !== "") {
                console.log('ปีที่เลือก:', year);
            }
        });

        // ดัก OK
        $(document).on('click', '.mc-btn--success', function() {
            setTimeout(() => {
                const year = $('#datepicker').val();

                console.log('ปีที่เลือก:', year);
            }, 0);
        });
    }

    DatePicker();





});
</script>

</html>
<?php }?>