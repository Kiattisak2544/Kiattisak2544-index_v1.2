<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="m-4">
        <h1 class="text-head_web" style="font-size:16px !important; font-weight:1000px ">สำหรับสมาชิก</h1>
        <hr>

        <div class="col-md-12 d-flex justify-content-center">
            <div class="card " style="width: 25rem; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <h1 class="card-header text-head_web text-center  text-primary"
                    style=" font-size:25px !important; font-weight:1000 px !important">
                    สมัครสมาชิก
                </h1>
                <div class="card-body">
                    <form action="" class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="label-input">รหัสสมาชิก</label>
                                <input type="text" class="form-control input-custom" value="" id="member_code"  placeholder="MT-20252206-xx" readonly>
                            </div> 
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="label-input">ชื่อสมาชิก</label>
                                <input type="text" class="form-control input-custom" value="" id="first_customer">
                                <span id="first_error" class="label-input" style="font-size:14px!important"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="label-input">นามสกุล</label>
                                <input type="text" class="form-control input-custom" value="" id="last_customer">
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="label-input">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control input-custom" value="" id="tel_customer">
                                <span id="tel_notify" class="label-input"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="label-input">อีเมล์(Email)</label>
                                <input type="email" class="form-control input-custom" value="" id="email_customer">
                                <span id="email_notify" class="label-input"></span>
                            </div>
                            <div class="col-md-12 mb-2">
                                <hr>
                                <label for="" class="label-input">ที่อยู่(Adress)</label>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="district" class="label-input">ตำบล/แขวง</label>
                                <input type="text" class="form-control input-custom" value="" id="district" placeholder="ตำบล/แขวง">
                                
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="amphoe" class="label-input">อำเภอ/เขต</label>
                                <input type="text" class="form-control input-custom" value="" id="amphoe" placeholder="อำเภอ/เขต">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="province" class="label-input">จังหวัด</label>
                                 <input type="text" class="form-control input-custom" value="" id="province" placeholder="จังหวัด">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="zipcode" class="label-input">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control input-custom" value="" id="zipcode" placeholder="รหัสไปรษณีย์">
                            </div>
                        </div>
                       <div class="d-flex justify-content-end">
                         <button type="submit" class="btn btn-md btn-register btn-primary mt-3" id="btn-customer">สมัครสมาชิก</button>
                       </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="../jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <link rel="stylesheet" href="../jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript" src="../jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
    <script src="../fetch_table.js"></script>
</body>

</html>