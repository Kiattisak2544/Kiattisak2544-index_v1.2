// $(document).on("click", ".btn-update", function() {
//     // ดึง ID จาก data-id ของปุ่มที่คลิก
//     const id = $(this).data("id");
//     // ส่งคำขอ AJAX เพื่ออัปเดตสถานะ
//     $.ajax({
//         url: "/index_v1.2/api/update_status.php", // URL สำหรับอัปเดต
//         type: "POST",
//         dataType: "JSON",
//         data: JSON.stringify({
//             id: id
//         }), // ส่ง ID ไปที่เซิร์ฟเวอร์
//         contentType: "application/json",
//         success: function(res) {
//             console.log(res);
//             var html ='';
//             var repairText = '';
//             var repairClass = '';
            
//             if (res.success == true) {
                
//                 // แสดงข้อความแจ้งเตือน หรืออัปเดต UI
//                 repairText = "ซ่อมแล้ว";
//                 repairClass = 'text-success';
//                 html = `<td class='text-center ${repairClass}' style='font-size:14px' data-id='${res.id}' id='status'>${repairText}</td>`;

//                 // location.reload(); 
//                 alert("อัปเดตสถานะเรียบร้อยแล้ว!");
//                 // console.log("อัปเดตสถานะเรียบร้อยแล้ว!");
//                 // window.location.reload();
               
//             }else {
//                 //    location.reload(); 
//                 //    alert( res.message);
//                  console.log(res.message);
//             }
//         },
//         error: function() {
//               alert(res.message);
//              console.error("เกิดข้อผิดพลาดขณะส่งคำขอ!");
//         },
//     });
// });

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
                repairText = 'ซ่อมแล้ว';
            } else {
                repairClass = 'text-danger';
                repairText = 'ไม่ซ่อม';
            }
            html += ` <tr>
            <td class='text-center' style = 'font-size:14px!important'>${i + 1}</td>
                <td class='text-center' style = 'font-size:14px!important'>${data[i].first_customer}   ${data[i].last_customer}</td>
                <td class='text-center' style = 'font-size:14px!important'>${data[i].tel_customer.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3")}</td>
                <td class='text-center' style = 'font-size:14px!important'>${data[i].detail}</td>
                <td class='text-center' style = 'font-size:14px!important'>${data[i].date}</td>
                 <td class='text-center' style = 'font-size:14px!important'>${data[i].technician}</td>        
                <td class='text-center ${repairClass}' style='font-size:14px' id='status' data-id = '${data[i].id}'>${repairText}</td>
                <td class='text-center' style = 'font-size:14px'><button class='btn btn-sm btn-success btn-update' data-id = '${data[i].id}'><i class="fa-solid fa-check"></i></button></td> 
                <td class='text-center' style = 'font-size:14px'><buttom class='btn btn-sm btn-danger'><i class="fa-solid fa-x"></i></buttom></td> 
                <td class='text-center text-content-table' style = 'font-size:14px'><buttom class='btn btn-sm btn-primary btn-view' id = 'btn-view'  data-id = '${data[i].id
                }'><i class="fa-regular fa-eye"></i></buttom></td> 
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
        url: "/index_v1.2/api/fecth_table.php",
        type: "post",
        dataType: "JSON",
        success: function (res) {
            data = res.map(function (item) {
                return {
                    id: item.id_es,
                     member: item.member_code,
                     firstname: item.first_customer,
                     lastname: item.last_customer,
                     detail: item.mainternace_detail,
                     date: item.date ? item.date.split(" ")[0] : "",
                     technician:item.technician,
                     status: item.status,
                     tel_customer: item.tel_customer,
                };
            });
            render_data();
        },
    });
}





