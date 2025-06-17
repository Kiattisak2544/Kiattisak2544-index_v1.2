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
                                        <th scope="col" class=" text-center" style="font-size: 14px;">#</th>
                                        <th scope="col" class=" text-center" style="font-size: 14px;">ชื่อ-นามสกุล</th>
                                        <th scope="col" class=" text-centerr" style="font-size: 14px;">เบอร์โทร</th>
                                        <th scope="col" class=" text-center" style="font-size: 14px;">อาการเสีย</th>
                                        <th scope="col" class=" text-center" style="font-size: 14px;">สถานะการซ่อม</th>
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

    <script >
        
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
                <td class='text-center' style = 'font-size:14px'>${i + 1}</td>
                <td class='text-center' style = 'font-size:14px'>${data[i].firstname}   ${data[i].lastname}</td>
                <td class='text-center' style = 'font-size:14px'>${data[i].telephone}</td>
                <td class='' style = 'font-size:14px'>${data[i].detail}</td>   
                <td class='text-center ${repairClass}' style='font-size:14px' id='status' data-id = '${data[i].id}'>${repairText}</td>
                <td class='text-center' style = 'font-size:14px'><button class='btn btn-sm btn-success btn-update' data-id = '${data[i].id}'><i class="fa-solid fa-check"></i></button></td> 
                <td class='text-center' style = 'font-size:14px'><buttom class='btn btn-sm btn-danger'><i class="fa-solid fa-x"></i></buttom></td> 
                </tr>
        `;
        }
        $("#response").html(html);
        // ceil ปัดเศษ ในกรณีหารกันแล้วมีเลขทศนิยม
        totalpage = Math.ceil(data.length / 10);
        var pagination_html = "";
        pagination_html = `<div onclick="back_page()" class="btn btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> </div>`;
        for (let i = 1; i <= totalpage; i++) {
            pagination_html += `<div id="page${i}" onclick="current_page(${i})" class="btn btn btn-outline-secondary ${page === i ? "active" : ""
                }  " aria-current='page'>${i}</div>`;
        }
        pagination_html += `<div onclick="next_page()" class="number-pagination btn btn btn-secondary"><i class="fa-solid fa-arrow-right"></i> </div>`;

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
        success: function (res) {
            console.log(res)
            data = res.map(function(item) {
                 return {
                     id: item.id_broken,
                     firstname: item.firstname,
                     lastname: item.lastname,
                     detail: item.mainternace_detail,
                     status: item.status,
                     telephone: item.telephone,
                 };
             });
             render_data();
        },
    });
}
    </script>
</body>
</html>