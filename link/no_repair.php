<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <div class="d-flex justify-content-end p-1">
                            <div class="mb-3 row">
                                <button class="btn btn-md btn-success btn-modal" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-id="modal.php"><i class="fa-solid fa-plus"></i>
                                    เพิ่มข้อมูล</button>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal-dialog" id="modal">
                            <?php include_once('modal.php') ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
    // Page ปัจจุบัน
    var page = 1;
    // Page ทั้งหมด
    var totalpage = 0;
    var data = data_table();
    var html = "";
    var text = "";

    function render_data() {
        var html = "";
        for (var i = (page - 1) * 10; i < page * 10; i++) {
            if (i < data.length) {
                if (data[i].status === "1") {
                    repairClass = 'text-success';
                    repairText = 'Success';
                } else {
                    repairClass = 'text-warning';
                    repairText = 'Waiting';
                }
                html += ` <tr>
               <th class='text-center text-content-table' style = 'font-size:14px!important'>${i + 1
                }</th>
             <td class='text-center text-content-table' style = 'font-size:14px!important'>${data[i].firstname
                }   ${data[i].lastname}</td>
             <td class='text-center text-content-table' style = 'font-size:14px!important'>${data[i].tel_customer.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3")
                }</td>
             <td class='text-center text-content-table' style = 'font-size:14px!important'>${data[i].detail
                }</td>   
             <td class='text-center text-content-table' style = 'font-size:14px!important'>${data[i].date
                }</td>   
             <td class='text-center text-content-table ${repairClass}' style='font-size:14px!important' id='status' data-id = '${data[i].id
                }'>${repairText}</td>
             <td class='text-center text-content-table' style = 'font-size:14px'>${data[i].technician
                }</td> 
             <td class='text-center text-content-table' style = 'font-size:14px'><button class='btn btn-sm btn-success btn-update' data-id = '${data[i].id
                }'><i class="fa-solid fa-check"></i></button></td> 
             <td class='text-center text-content-table' style = 'font-size:14px'><buttom class='btn btn-sm btn-danger btn-remove' data-id = '${data[i].id
                }'><i class="fa-solid fa-trash"></i></buttom></td> 
             <td class='text-center text-content-table' style = 'font-size:14px'><buttom class='btn btn-sm btn-primary btn-view' id = 'btn-view'  data-id = '${data[i].id
                }'><i class="fa-regular fa-eye"></i></buttom></td> 
                </tr>
        `;
            }
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

    function next_page() {
        if (page != totalpage) {
            page++;
            render_data();
        }
    }

    function back_page() {
        if (page != 1) {
            page--;
            render_data();
        }
    }

    function current_page(cupage) {
        page = cupage;

        render_data();
    }

    function data_table() {
        $.ajax({
            url: "/index_v1.2/api/fecth_table_nopass.php",
            type: "post",
            dataType: "JSON",
            success: function(res) {
                data = res.map(function(item) {
                    return {
                        id: item.id_es,
                        member: item.member_code,
                        firstname: item.first_customer,
                        lastname: item.last_customer,
                        detail: item.mainternace_detail,
                        date: item.date.split(" ")[0],
                        technician: item.technician,
                        status: item.status,
                        tel_customer: item.tel_customer,
                    };
                });
                render_data();
            },
        });
    }

    function update_status(id, status) {
        $.ajax({
            url: "/index_v1.2/api/update_status.php",
            type: "POST",
            dataType: "json",
            data: JSON.stringify({
                id: id,
                status: status // ✅ เพิ่มสถานะที่จะอัปเดต
            }),
            contentType: "application/json",
            success: function(res) {
                if (res.success === true) {

                    Swal.fire({
                        title: "สำเร็จ!",
                        text: res.message,
                        icon: "success",
                        confirmButtonText: "ตกลง",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });


                } else {
                    Swal.fire({
                        title: "ไม่สำเร็จ!",
                        text: res.message,
                        icon: "error",
                        confirmButtonText: "ตกลง",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });

                }
            },
            error: function() {
                Swal.fire("เกิดข้อผิดพลาด!", "ไม่สามารถอัปเดตสถานะได้", "error", timeout = 2000);

            },
        });
    }


    $(document).on("click", ".btn-update", function() {
        const id = $(this).data("id");
        update_status(id, status);

    });
    $(document).on("click", ".btn-remove", function() {
        const id = $(this).data("id");
        const row = $(this).closest("tr");
        Swal.fire({
            title: "คุณแน่ใจหรือไม่?",
            text: "คุณต้องการลบข้อมูลนี้!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ลบเลย!",
        }).then((result) => {
            // เช็คว่าผู้ใช้กดยืนยันการลบหรือไม่
            if (result.isConfirmed) {
                $.ajax({
                    url: "/index_v1.2/api/delete_repair.php",
                    type: "POST",
                    dataType: "json",
                    data: JSON.stringify({
                        id: id,
                    }),
                    contentType: "application/json",
                    success: function(res) {
                        if (res.success) {
                            Swal.fire("ลบแล้ว!", "ข้อมูลถูกลบแล้ว", "success");
                            row.remove(); // ลบแถวออกจากตาราง
                        } else {
                            Swal.fire("เกิดข้อผิดพลาด!", res.message, "error");
                        }
                    },
                    error: function() {
                        Swal.fire("เกิดข้อผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
                    },
                });
            }
        });
    });

    $(document).on("click", ".btn-view", function() {
        let id = $(this).data("id");
        $.ajax({
            url: "/index_v1.2/api/view_repair.php?id=" + id,
            type: "GET",
            dataType: "json",
            data: JSON.stringify({
                id: id,
            }),
            contentType: "application/json",
            success: function(res) {
                if (res.success) {
                    window.location.href = "../link/view_data.php?id=" + id;
                } else {
                    Swal.fire("เกิดข้อผิดพลาด!", res.message, "error");
                }
            },
            error: function() {
                Swal.fire("เกิดข้อผิดพลาด!", "ไม่สามารถดึงข้อมูลได้", "error");
            },
        });
    });
    </script>
</body>

</html>