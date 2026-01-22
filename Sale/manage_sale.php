<?php
include_once('../config/class.php');
$web = new websystem();
$Data_user = $web->Display_user();
// ตรวจสอบว่า $Data_user เป็น array ก่อนที่จะใช้งาน
$user_name = isset($Data_user['User_number']) ? $Data_user['User_number'] : 'ไม่พบชื่อผู้ใช้งาน';
?>

<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="text-header">ใบมัดจำสินค้า</h1>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_sale">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label for="name" class="form-label text-label">ชื่อลูกค้า</label>
                                <input type="text" class="form-control" id="name">
                                <span id="name-message" id='message'></span>
                            </div>
                            <div class="col-md-6">
                                <label for="tel" class="form-label text-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" id="tel">
                                <span id="tel-alert" class="message"></span>
                            </div>
                            <div class="col-md-2">
                                <label for="house_number" class="form-label text-label">เลขที่</label>
                                <input type="text" class="form-control" id="house_number">
                            </div>
                            <div class="col-md-2">
                                <label for="district" class="form-label text-label">ตำบล</label>
                                <input type="text" class="form-control" id="district">
                            </div>
                            <div class="col-md-2">
                                <label for="amphoe" class="form-label text-label">อำเภอ</label>
                                <input type="text" class="form-control" id="amphoe">
                            </div>
                            <div class="col-md-2">
                                <label for="province" class="form-label text-label">จังหวัด</label>
                                <input type="text" class="form-control" id="province">
                            </div>
                            <div class="col-md-3">
                                <label for="zipcode" class="form-label text-label">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" id="zipcode">
                            </div>
                            <div class="mt-2">
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="text-label">ราคาเครื่อง/รวมอุปกรณ์ทั้งหมด</p>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">จำนวน</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control text-label" id="price">
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">บาท</label>
                                </div>
                                <div class="col-md-2">
                                    <label class="col-form-label text-label">ผู้รับเงิน</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control text-label" value="<?= $user_name; ?>"
                                        id="name_sale" readonly>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <p class="text-label">ชำระมัดจำ</p>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="type_credit">
                                    <label class="form-check-label text-label" for="type_credit">บัตรเครดิต</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="type_cash">
                                    <label class="form-check-label text-label" for="type_cash">เงินสด</label>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-check-input" type="checkbox" value="1" id="type_down">
                                    <label class="form-check-label text-label" for="type_down">QR CODE</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">จำนวน</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control text-label" id="deposit">
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">บาท</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-form-label text-label">ยอดที่คงเหลือที่ต้องชำระ</label>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">จำนวน</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control text-label" id="sum" readonly>
                                </div>
                                <div class="col-md-1">
                                    <label class="col-form-label text-label">บาท</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-label">เวลานัดรับเครื่อง/อุปกรณ์</p>
                            </div>
                            <div class="col-md-1">
                                <p class="text-label">วันที่</p>
                            </div>
                            <div class="col-md-4">
                                <input type="date" class="form-control text-label" id="date">
                            </div>
                            <div class="col-md-1">
                                <p class="text-label">เวลา</p>
                            </div>
                            <div class="col-md-2">
                                <input type="time" class="form-control" id="time" data-mdb-formar24="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="text-label fw-bold">ข้อเสนอแนะเพิ่มเติม</label>
                            <textarea class="form-control" id="comment" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php include('modal_update.php'); ?>

    <div class="mt-4 row">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-md btn-primary text-label" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="fa-solid fa-user-plus"></i>เพิ่มข้อมูล
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped" id="myTable">
            <thead>
                <tr>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="../jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="../jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <link rel="stylesheet" href="../jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript" src="../jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Format phone -->
    <script>
    function formatPhone(phone) {
        if (!phone) return '';

        phone = phone.toString().replace(/\D/g, '').slice(0, 10);

        if (phone.length >= 7) {
            return phone.replace(/(\d{3})(\d{3})(\d{1,4})/, "$1-$2-$3");
        } else if (phone.length >= 4) {
            return phone.replace(/(\d{3})(\d{1,3})/, "$1-$2");
        }

        return phone;
    }
    </script>

    <script>
    $(document).ready(function() {
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });



        $(document).ready(function() {
            // เรียกใช้งาน Flatpickr
            flatpickr("#time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true, // เป็น 24 ชั่วโมงแน่นอน
                minuteIncrement: 30, // ให้เลือกขยับทีละ 30 นาที (เหมือน Option)
                allowInput: true, // พิมพ์เองได้ด้วย
                static: true // สำคัญ! ช่วยให้ตัวเลือกไม่เด้งหลุดไปนอก Modal
            });
            flatpickr("#times", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true, // เป็น 24 ชั่วโมงแน่นอน
                minuteIncrement: 30, // ให้เลือกขยับทีละ 30 นาที (เหมือน Option)
                allowInput: true, // พิมพ์เองได้ด้วย
                static: true // สำคัญ! ช่วยให้ตัวเลือกไม่เด้งหลุดไปนอก Modal
            });
        });

        function formatThaiDate(dateStr) {
            if (!dateStr) return '-';

            const d = new Date(dateStr.replace(' ', 'T'));
            const months = [
                'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.',
                'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'
            ];

            const day = d.getDate();
            const month = months[d.getMonth()];
            const year = d.getFullYear() + 543; // แปลงเป็น พ.ศ.

            return `${day} ${month} ${year}`;
        }

        $('#myTable').DataTable({
            "ajax": {
                // *** แก้ไข URL ให้ชี้ไปยัง API ที่ถูกต้องสำหรับข้อมูลใบมัดจำ ***
                "url": '/index_v1.2/api/fetch_sales_data.php',
                "type": 'GET',
                "dataType": 'json',
                "dataSrc": function(json) {

                    console.log("DataTables response:", json);
                    if (json.success && json.data) {
                        let counter = 0;
                        // ** ปรับปรุงการ mapping ข้อมูลให้ตรงกับคอลัมน์ในตาราง
                        return json.data.map(function(item) {
                            counter++;
                            const print =
                                `<button class="btn btn-sm btn-primary me-1 text-white" data-id='${item.id_deposit}' id='print-cus' data-bs-toggle="tooltip" title="พิมพ์ข้อมูล"><i class="fa-solid fa-print"></i></button>`;
                            const btn_delete =
                                `<button class="btn btn-sm btn-danger text-white" data-id='${item.id_deposit}' id='delete' data-bs-toggle="tooltip" title="ลบข้อมูล"><i class="fa-solid fa-trash"></i></button>`;
                            const edit =
                                `<button class="btn btn-sm btn-warning btn-edit text-white" data-id='${item.id_deposit}' id='edit' data-bs-toggle="tooltip" title="แก้ไขข้อมูล"><i class="fa-solid fa-pen-to-square"></i></button>`;
                            return [
                                counter,
                                'คุณ' + ' ' + item.fullname_cus + ' ' + (item
                                    .lastname_cus ||
                                    ''), // ชื่อลูกค้า
                                item.telphon_cus.replace(/(\d{3})(\d{3})(\d{1,4})/, "$1-$2-$3"),
                                item.house_number + ' ต.' + item.district + ' อ.' + item
                                .amphoe + ' จ.' + item.province + ' ',
                                formatThaiDate(item.date), // วันที่มัดจำ
                                formatThaiDate(item.date_deposit), // วันที่นัดรับ
                                print,
                                btn_delete,
                                edit

                            ];
                        });
                    } else {
                        console.error("API response error:", json.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: json.message || 'ไม่สามารถดึงข้อมูลได้ โปรดลองอีกครั้ง',
                        });
                        return [];
                    }
                },
                "error": function(xhr, error, thrown) {
                    console.error("DataTables AJAX Error:", error, thrown, xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'โหลดข้อมูลล้มเหลว!',
                        text: 'ไม่สามารถดึงข้อมูลจากเซิร์ฟเวอร์ได้ โปรดตรวจสอบการเชื่อมต่อ.',
                    });
                }
            },
            "columns": [{
                "title": "#",
                "orderable": false,
                "width": "5%",
                "className": "text-center text-label"
            }, {
                "title": "ชื่อลูกค้า",
                "className": "text-center text-label"
            }, {
                "title": "เบอร์โทร",
                "className": "text-center text-label"
            }, {
                "title": "ที่อยู่",
                "className": "text-center text-label"
            }, {
                "title": "วัน/เดือน/ปี ที่มัดจำ",
                "orderable": false,
                "className": "text-center text-label",
                "width": "15%"
            }, {
                "title": "วัน/เดือน/ปี ที่นัดรับเครื่อง",
                "className": "text-center text-label",
                "orderable": false
            }, {
                "title": "",

            }, {
                "title": ""
            }, {
                "title": "",
            }],
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "drawCallback": function() {
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });


        // Calculate remaining sum
        $('#price, #deposit').on('keyup', function() {
            const price = parseFloat($('#price').val()) || 0;
            const deposit = parseFloat($('#deposit').val()) || 0;
            const sum = price - deposit;
            $('#sum').val(sum);
        });

        // Initialize Thailand address autocomplete
        $.Thailand({
            database: "../jquery.Thailand.js/database/db.json",
            $district: $("#district"),
            $amphoe: $("#amphoe"),
            $province: $("#province"),
            $zipcode: $("#zipcode"),
        });

        $('#name').on("input", function() {
            const name = $(this).val();

            if (name === "") {
                $(this).addClass('border-2 border-danger').removeClass('border border-success');
                $('#name-message').addClass('text-danger').removeClass('text-success').text(
                    'กรุณากรอกข้อมูล !!');
            } else {
                $(this).addClass('border-2 border-success').removeClass('border border-danger');
                $('#name-message').addClass('text-success').removeClass('text-danger').text(
                    'กรุณากรอกข้อมูล !!');
            }
        });

        $("#tel").on("input", function() {
            let phone = $(this).val().replace(/\D/g, ""); // ลบตัวอักษรที่ไม่ใช่ตัวเลข

            phone = phone.substring(0, 10);

            const formatphone = formatPhone(phone)
            $(this).val(formatphone);
            // ตรวจสอบว่าเบอร์ถูกต้องหรือไม่
            if (phone.replace(/\D/g, "").length !== 10) {
                // เอาแค่ตัวเลขมานับ
                $(this)
                    .removeClass("border-success")
                    .addClass("border-danger border-2");
                $("#tel-alert")
                    .addClass("text-danger")
                    .text("กรุณาระบุเบอร์โทรศัพท์มือถือให้ถูกต้อง");
            } else {
                $(this)
                    .removeClass("border-danger")
                    .addClass("border-success border-2");
                $("#tel-alert").removeClass("text-danger").text(""); // ลบข้อความแจ้งเตือนเมื่อถูกต้อง
                $("#tel-alert")
                    .addClass("text-success")
                    .text("กรอกเบอร์โทรศัพท์มือถือถูกต้อง");
            }
        });


        // Handle Save Button Click
        $('#btn-save').on('click', function(e) {
            e.preventDefault();

            const dataForm = {
                name: $('#name').val(),
                tel: $('#tel').val().replace(/\D/g, ''),
                house_number: $('#house_number').val(),
                district: $('#district').val(),
                amphoe: $('#amphoe').val(),
                province: $('#province').val(),
                zipcode: $('#zipcode').val(),
                price: $('#price').val(),
                type_credit: $('#type_credit').prop('checked') ? $('#type_credit').val() : "",
                type_cash: $('#type_cash').prop('checked') ? $('#type_cash').val() : "",
                type_down: $('#type_down').prop('checked') ? $('#type_down').val() : "",
                deposit: $('#deposit').val(),
                sum: $('#sum').val(),
                date: $('#date').val(),
                time: $('#time').val(),
                name_sale: $('#name_sale').val(),
                comment: $('#comment').val()
            };

            // ตรวจสอบข้อมูลก่อนส่ง
            if (!dataForm.name || !dataForm.tel || !dataForm.price || !dataForm.deposit || !dataForm
                .date || !dataForm.time) {
                Swal.fire({
                    icon: 'warning',
                    title: 'ข้อมูลไม่ครบถ้วน!',
                    text: 'กรุณากรอกข้อมูลที่จำเป็นให้ครบถ้วนก่อนบันทึก'
                });
                return;
            }

            $.ajax({
                url: '/index_v1.2/api/insert_sale.php',
                type: 'POST',
                contentType: 'application/json', // บอก server ว่าข้อมูลที่ส่งเป็น JSON
                data: JSON.stringify(dataForm), // แปลง object เป็น JSON string
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'บันทึกสำเร็จ!',
                            text: res.message ||
                                'ข้อมูลใบมัดจำถูกบันทึกเรียบร้อยแล้ว'
                        }).then(() => {
                            $('#exampleModal').modal('hide');
                            $('#form_sale')[0].reset();
                            $('#myTable').DataTable().ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: res.message ||
                                'ไม่สามารถบันทึกข้อมูลได้ โปรดลองอีกครั้ง'
                        });
                    }
                },
                error: function(xhr) {
                    console.error("AJAX error:", xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'โหลดข้อมูลล้มเหลว!',
                        text: 'ไม่สามารถติดต่อเซิร์ฟเวอร์ได้ โปรดตรวจสอบการเชื่อมต่ออินเทอร์เน็ต.'
                    });
                }
            });
        });

    });
    $(document).on('click', '#print-cus', function() {
        const id = $(this).data('id');
        window.open('/index_v1.2/Print/print_sale.php?id=' + id, '_blank');
    });

    function deleteSale(id) {
        $.ajax({
            url: '/index_v1.2/api/delete_DepositSale.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                id: id
            }),
            dataType: 'json',
            success: function(res) {
                console.log("Delete response:", res);
            }
        });
    }



    $(document).on('click', '#delete', function() {

        const id = $(this).data('id');
        console.log("Delete ID:", id); // Debugging log
        Swal.fire({
            title: 'คุณแน่ใจหรือไม่?',
            text: "คุณต้องการลบข้อมูลนี้หรือไม่!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ลบเลย!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteSale(id);
                Swal.fire(
                    'Deleted!',
                    'ข้อมูลของคุณถูกลบเรียบร้อยแล้ว.',
                    'success'
                ).then(() => {
                    $('#myTable').DataTable().ajax.reload();
                });
            }
        });
    });
    $(document).on('click', '.btn-edit', function() {
        const id = $(this).data('id');

        // console.log(id);


        if ($('#modal_update').length === 0) {
            $('#modal_container').load('modal_update.php', function() {

                $('#edit_id').val(id);
                $('#modal_update').modal('show');


            });
        } else {
            $('#edit_id').val(id);
            $('#modal_update').modal('show');

            $.ajax({
                url: '/index_v1.2/api/fecth_sale.php',
                method: 'GET',
                data: ({
                    data: id
                }), // ส่งเป็น object
                dataType: 'json',
                success: function(res) {

                    if (res.success && res.data) {
                        const item = res.data;
                        $('#fullname').val(item.fullname_cus);


                        let phone = item.telphon_cus ?? '';
                        phone = phone.substring(0, 10);

                        $('#telphone').val(formatPhone(phone));
                        
                        $('#house_numbers').val(item.house_number);
                        $('#districts').val(item.district);
                        $('#amphoes').val(item.amphoe);
                        $('#provinces').val(item.province);
                        $('#zipcodes').val(item.zipcode);
                        $('#prices').val(item.price_total);
                        $('#prices').prop('disabled',true);
                        $('#name_sales').prop('disabled',true);

                        $('#type_downs, #type_cashs, #type_credits').prop('checked', false);

                        const map = {
                            type_down: '#type_downs',
                            type_cash: '#type_cashs',
                            type_credit: '#type_credits'
                        }

                        for(const key in map){
                            if(item[key] == 1){
                                $(map[key]).prop('checked',true);
                                
                                break;
                            }
                        }
                        $('#deposits').val(item.deposit_price);
                        $('#deposits').prop('disabled',true);
                        $('#sums').val(item.deposit_total);
                        $('#sums').prop('disabled',true);
                        $('#dates').val(item.date_deposit);
                        $('#times').val(item.time_deponsit);
                        $('#times').prop('disabled',true);


                    }
                }
            });


        }
    });
    </script>
</body>