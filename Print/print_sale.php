<?php

include_once('../config/class.php');
if(!isset($_SESSION['id_user'])){
$web = new websystem();
$Data_user = $web->Display_user();
// ตรวจสอบว่า $Data_user เป็น array ก่อนที่จะใช้งาน
$user_name = isset($Data_user['Firstname_repair']) ? $Data_user['Firstname_repair'] : 'ไม่พบชื่อผู้ใช้งาน';
    header("location: ../index");
    exit(); // Always exit after a header redirect
}else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../responsive.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.css"
        integrity="sha512-fjO3Vy3QodX9c6G9AUmr6WuIaEPdGRxBjD7gjatG5gGylzYyrEq3U0q+smkG6CwIY0L8XALRFHh4KPHig0Q1ug=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- sweetalert2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.css"
        integrity="sha512-fjO3Vy3QodX9c6G9AUmr6WuIaEPdGRxBjD7gjatG5gGylzYyrEq3U0q+smkG6CwIY0L8XALRFHh4KPHig0Q1ug=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.js"
        integrity="sha512-LGHBR+kJ5jZSIzhhdfytPoEHzgaYuTRifq9g5l6ja6/k9NAOsAi5dQh4zQF6JIRB8cAYxTRedERUF+97/KuivQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>

    <div class="container my-5">
        <div class="card mx-auto ">
            <div class="card-body  border border-1 rounded p-3">
                <div class="d-flex gap-3">
                    <div class="col-md-3">
                        <h1 class=" text-label fs-5">ใบมัดจำสินค้า </h1>
                    </div>
                    <div class="col-md-3">
                        <p class="text-label">วันที่ <span id="date_now"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-md-6">
                        <p class="text-label">[ ] J.I.B COMPUTER CHAINAT</p>
                    </div>
                    <div class="col-6 col-md-6">
                        <p class="text-label">TEL: 065-223-2308</p>
                    </div>
                </div>
                <hr>
                <form id="form_sale" class="form_sale">
                    <div class="row g-2">
                        <div class="col-md-6 col-sm-6">
                            <label for="name" class="form-label text-label fw-bold">ชื่อลูกค้า</label>
                            <p class="text-label mx-3" id="name"></p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="tel" class="form-label text-label fw-bold">เบอร์โทรศัพท์</label>
                            <p class="text-label mx-3" id="tel">t</p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="house_number" class="form-label text-label fw-bold">ที่อยู่</label>
                            <p type="text" class="text-label mx-3" id="house_number"></p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="house_number" class="form-label text-label fw-bold">ข้อเสนอแนะเพิ่มเติม</label>
                            <p type="text" class="text-label mx-3" id="comment"></p>
                        </div>
                        <div class="mt-2">
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <p class="text-label fw-bold m-0">ราคาเครื่อง/รวมอุปกรณ์ทั้งหมด</p>
                            </div>
                            <div class="col-md-1 col-2">
                                <label class=" text-label fw-bold">จำนวน</label>
                            </div>
                            <div class="col-md-2 col-3 text-center">
                                <span class=" text-label m-0" id="price"></span>
                            </div>
                            <div class="col-md-1 col-1">
                                <label class="text-label fw-bold">บาท</label>
                            </div>
                            <div class="col-md-2 col-3">
                                <label class=" text-label fw-bold">ผู้รับเงิน</label>
                            </div>
                            <div class="col-md-2 col-3">
                                <span type="text" class=" text-label" id="name_sale" readonly><?php $user_name?></span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2 col-3">
                                <p class="text-label fw-bold">ชำระมัดจำ</p>
                            </div>
                            <div class="col-md-2 col-3">
                                <span id="type_credit"></span>
                                <label class=" text-label" for="type_credit">บัตรเครดิต</label>
                            </div>
                            <div class="col-md-2 col-3">
                                <span id="type_cash"></span>
                                <label class=" text-label" for="type_cash">เงินสด</label>
                            </div>
                            <div class="col-md-2 col-3">
                                <span id="type_down"></span>
                                <label class=" text-label" for="type_down"> QR CODE</label>
                            </div>
                            <div class="col-md-1 col-3">
                                <label class="col-form-label text-label fw-bold">จำนวน</label>
                            </div>
                            <div class="col-md-2 mt-1 text-center col-3">
                                <span class=" text-label " id="deposit"></span>
                            </div>
                            <div class="col-md-1 col-3">
                                <label class="col-form-label text-label fw-bold">บาท</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <label class="col-form-label text-label fw-bold">ยอดที่คงเหลือที่ต้องชำระ</label>
                            </div>
                            <div class="col-md-1 col-3">
                                <label class="col-form-label text-label fw-bold">จำนวน</label>
                            </div>
                            <div class="col-md-2 mt-1 text-center col-3">
                                <span class="text-label" id="sum" readonly></span>
                            </div>
                            <div class="col-md-1 col-3">
                                <label class="col-form-label text-label fw-bold">บาท</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <p class="text-label fw-bold">เวลานัดรับเครื่อง/อุปกรณ์</p>
                        </div>
                        <div class="col-md-1 col-2">
                            <p class="text-label">วันที่</p>
                        </div>
                        <div class="col-md-4 text-center col-3">
                            <span class=" text-label" id="date"></span>
                        </div>
                        <div class="col-md-1 col-3 text-center">
                            <p class="text-label">เวลา</p>
                        </div>
                        <div class="col-md-2 text-center col-3">
                            <span class="text-label" id="time"></span>
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-end m-3">
                    <button type="button" class="btn btn-primary text-label" id="print-cus"><i
                            class="fa-solid fa-print"></i><span class="mx-1">พิมพ์ข้อมูล</span></button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        function fecth_data(data) {
            $.ajax({
                url: '/index_v1.2/api/fecth_sale.php',
                method: 'GET',
                data: ({
                    data: data
                }), // ส่งเป็น object
                dataType: 'json',
                success: function(res) {
                    // โค้ดที่ถูกต้อง: ตรวจสอบว่ามี property 'data' และข้อมูลนั้นไม่ใช่ค่าว่าง
                    if (res.data) {
                        // เนื่องจาก res.data เป็น Object ที่มีข้อมูลเพียงรายการเดียว
                        // เราจึงเข้าถึงข้อมูลได้โดยตรงเลย
                        const item = res.data;
                        // ดึงค่าเบอร์โทรศัพท์จาก item
                        let telphon = item.telphon_cus;

                        // ตรวจสอบความยาว
                        if (telphon && telphon.length === 10) {
                            // จัดรูปแบบเบอร์โทรศัพท์และเก็บในตัวแปรเดิม
                            telphon = telphon.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
                        }

                        // นำค่าที่จัดรูปแบบแล้ว (หรือค่าเดิม) ไปแสดงผล
                        $('#tel').text(telphon);

                        // แสดงข้อมูลในหน้าเว็บ
                        $('#name').text(item.fullname_cus);

                        if (item.type_credit == 1) {
                            $('#type_credit').text('✅');
                        }
                        if (item.type_cash == 1) {
                            $('#type_cash').text('✅');
                        }
                        if (item.type_down == 1) {
                            $('#type_down').text('✅');
                        }
                        // ...โค้ดส่วนที่เหลือสำหรับแสดงผลข้อมูล
                        const fullAddress = 'บ้านเลขที่' + '  ' + item.house_number + ' ต.' + item
                            .district + ' อ.' + item.amphoe + ' จ.' + item.province;
                        // แปลงวันที่จาก 'YYYY-MM-DD HH:MM:SS' เป็น 'DD-MM-YYYY HH:MM:SS'
                        const day = parseInt(item.date.split('-')[2]) + '-' + item.date
                            .split('-')[1] + '-' + item.date.split('-')[0] + '  ' + 'เวลา' + ' ' +
                            item.date.split(' ')[1];

                        $('#house_number').text(fullAddress);
                        $('#price').text(item.price_total);
                        $('#name_sale').text(item.name_sale);



                        $('#deposit').text(item.deposit_price);
                        $('#sum').text(item.deposit_total);
                        $('#date').text(item.date_deposit);
                        $('#date_now').text(day);
                        $('#time').text(item.time_deponsit);
                        $('#name_sale').text(item.name_sale);
                        $('#comment').text(item.comment_sale);

                        console.log(item.deposit_price);

                    } else {
                        // กรณีที่ res.data ไม่มีอยู่จริง หรือเป็นค่าว่าง
                        console.log("ไม่พบข้อมูลที่ต้องการ หรือโครงสร้างข้อมูลไม่ถูกต้อง");
                    }
                }
            });
        }

        function getQueryParams() {
            const urlParams = new URLSearchParams(window.location.search);
            const data = urlParams.get('id');

            if (data) {
                fecth_data(data);
            } else {
                console.error('No ID parameter found in the URL.');
            }
        }
        getQueryParams();




    });
    </script>
    <script>
    $.fn.printArea = function(options) {
        var settings = $.extend({
            title: '',
            copyStyles: true,
            removeSelectors: []
        }, options);

        var element = this.clone();

        if (settings.removeSelectors.length > 0) {
            settings.removeSelectors.forEach(function(sel) {
                element.find(sel).remove();
            });
        }

        var styles = '';
        if (settings.copyStyles) {
            $('link[rel=stylesheet], style').each(function() {
                styles += this.outerHTML;
            });
        }

        var printWindow = window.open('', '', 'width=1200,height=1200');
        printWindow.document.open();
        printWindow.document.write(`
        <html>
            <head>
                <meta charset="utf-8">
                <title>${settings.title}</title>
                ${styles}
                <style>
                    @media print {
                        @page { margin: 0; }
                        body { -webkit-print-color-adjust: exact; }
                    }
                </style>
            </head>
            <body>
                ${element.prop('outerHTML')}
                <hr>
                ${element.prop('outerHTML')}
               
            </body>
        </html>
    `);
        $('#print-cus').on('click', function() {
            $('.card-body').printArea({
                title: '', // ว่าง
                removeSelectors: ['#print-cus'] // ลบปุ่มออก
            });
        });
        printWindow.document.close();

        printWindow.onload = function() {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };

        return this;
    };

    $(document).ready(function() {
        $('#print-cus').on('click', function() {
            $('.card-body').printArea({
                title: 'ใบสั่งจอง ',
                removeSelectors: ['#print-cus']
            });
        });
    });
    </script>

</body>

</html>

<?php }?>