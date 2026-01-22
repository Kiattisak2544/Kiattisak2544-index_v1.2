// Page ปัจจุบัน
var page = 1;
// Page ทั้งหมด
var totalpage = 0;
var data = fechAllrender();
var html = "";
var text = "";

function render_data() {
    var html = "";
    for (var i = (page - 1) * 10; i < page * 10; i++) {
        if (i < data.length) {
            if (data[i].status === 1) {
                repairClass = "text-success";
                repairText = "Success";
            } else {
                repairClass = "text-warning";
                repairText = "Waiting";
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

function fechAllrender() {
    $.ajax({
        url: "/index_v1.2/api/fecth_table_pass.php",
        type: "post",
        dataType: "JSON",
        success: function (res) {
            data = res.map(function (item) {
                //   console.log(item);
                return {
                    id: item.id_es,
                     firstname: item.first_customer,
                     lastname: item.last_customer,
                     detail: item.mainternace_detail,
                     date : item.date.split(" ")[0],
                     technician:item.technician,
                     status: item.status,
                     tel_customer: item.tel_customer,
                };
            });
            render_data();
        },
    });
}
function Thailand() {
    $.Thailand({
        database: "../jquery.Thailand.js/database/db.json", // path หรือ url ไปยัง database
        $district: $("#district"), // input ของตำบล
        $amphoe: $("#amphoe"), // input ของอำเภอ
        $province: $("#province"), // input ของจังหวัด
        $zipcode: $("#zipcode"), // input ของรหัสไปรษณีย์
    });
}
// เรียกใช้ฟังก์ชัน Thailand
Thailand();
// เรียกใช้ฟังก์ชัน fechAllrender
fechAllrender();

//  สร้าง function data_table
function data_table() {
    $.ajax({
        url: "/index_v1.2/api/search_repair.php",
        type: "post",
        dataType: "JSON",
        success: function (res) {
            data = res.map(function (item) {
                console.log(item);
                return {
                    id: item.id_broken,
                    firstname: item.firstname,
                    lastname: item.lastname,
                    detail: item.mainternace_detail,
                    status: item.status,
                    telephone: item.telephone,
                    technician: item.technician,
                    date: item.date.split(" ")[0],
                };
            });
            render_data();
        },
    });
}


$(document).ready(function () {
    function seach() {
        const searchValue = $("#search").val().trim();

        if (searchValue !== "") {
            $.ajax({
                url: "/index_v1.2/api/search_repair.php",
                type: "POST",
                dataType: "JSON",
                data: JSON.stringify({ searchValue: searchValue }),
                contentType: "application/json",
                success: function (res) {
                    if (Array.isArray(res) && res.length > 0) {
                        data = res.map(function (item) {
                            return {
                                id: item.id_broken,
                                firstname: item.firstname,
                                lastname: item.lastname,
                                detail: item.mainternace_detail,
                                status: item.status,
                                telephone: item.telephone,
                                technician: item.technician,
                                date: item.date.split("")[0],
                            };
                        });
                        render_data(data);
                    } else {
                        console.warn("ไม่พบข้อมูลที่ตรงกับการค้นหา");
                    }
                },
                error: function (err) {
                    console.error("เกิดข้อผิดพลาดในการค้นหา:", err);
                },
            });
        } else {
            render_data([]); // ถ้าไม่มีการค้นหา ให้แสดงข้อมูลทั้งหมด
        }
    }
    $("#search").keyup(function (e) {
        const searchValue = $(this).val().trim();
        if (searchValue !== "" && searchValue.length > 0) {
            e.preventDefault();
            seach();
        }
        {
            fechAllrender(); // ถ้าไม่มีการค้นหา ให้แสดงข้อมูลทั้งหมด
        }
    });

    function gencode() {
        $.ajax({
            url: "/index_v1.2/api/gencode.php",
            method: "GET",
            dataType: "json",
            success: function (res) {
                // console.log(res);
                if (res.success === true) {
                    $("#member_code").val(res.data);

                    // console.log("รหัสสมาชิกที่สร้างขึ้น:", res.data);
                } else {
                    console.error("ไม่สามารถสร้างรหัสสมาชิกได้:", res.message);
                }
            },
        });
    }

    gencode(); // เรียกใช้ฟังก์ชันเพื่อสร้างรหัสสมาชิกใหม่

    function insertData(formData){
        $.ajax({
            url: "/index_v1.2/api/insert_customer.php",
            type: "POST",
            dataType: "JSON",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function (res) {
                if (res.success) {
                    Swal.fire({
                        title: "บันทึกข้อมูลสำเร็จ",
                        text: "ข้อมูลลูกค้าได้ถูกบันทึกเรียบร้อยแล้ว",
                        icon: "success",
                        draggable: true,
                    });
                    setTimeout(() => {
                        window.location.href = "../link/home.php";
                    }, 2000);
                } else {
                    Swal.fire({
                        title: "บันทึกข้อมูลไม่สำเร็จ",
                        text: "กรุณาลองใหม่อีกครั้งภายหลัง",
                        icon: "error",
                        draggable: false,
                    });
                    setTimeout(() => {}, 2000);
                }
            }
        }); 
    }

    $("#btn-customer").click(function(e){
        e.preventDefault();
        const FormData = {
            member_code: $("#member_code").val(),
            firstname: $("#first_customer").val(),
            lastname: $("#last_customer").val(),
            telnumber: $("#tel_customer").val().replace(/\D/g, ''),
            email: $("#email_customer").val(),
            district: $("#district").val(),
            amphoe: $("#amphoe").val(),
            province: $("#province").val(),
            zipcode: $("#zipcode").val(),
       }
       if(FormData.firstname && FormData.lastname && FormData.telnumber && FormData.district && FormData.amphoe && FormData.province && FormData.zipcode ){
            insertData(FormData)
       }else{
            Swal.fire({
                title: "กรุณากรอกข้อมูลให้ครบถ้วน",
                text: "กรุณากรอกข้อมูลให้ครบถ้วนก่อนบันทึก",
                icon: "warning",
                draggable: true,
            });
       }
        
       
    });

    function checkData(data){
        $.ajax({
                url: "/index_v1.2/api/fect_data_customer.php",
                type : "GET",
                data : {data:data},
                dataType : "JSON",
                success: function(res){
                       if(res.success){
                        //    console.log(res);
                           $(this).addClass("border-success border").removeClass("border-danger border");
                           $("#first_error").addClass("text-success").removeClass("text-danger").text(res.message);
                       }else{
                            $(this).addClass("border-danger border").removeClass("border-success border");
                           $("#first_error").addClass("text-danger").removeClass("text-success").text(res.message);
                       }
                }
        });
    }

    

    $("#first_customer").keyup(function(){
            const first_Value =  $(this).val().trim();

            if(first_Value !== 0){
                checkData(first_Value);
            }
    });


    function fecth_option() {
        $.ajax({
            url: "/index_v1.2/api/rate_option.php",
            type: "POST",
            dataType: "JSON",
            success: function (res) {
                let option =
                    '<option value="0" class="m-2">กรุณาเลือกรายการ...</option>';
                // ตรวจสอบว่า res เป็น array และมีข้อมูลหรือไม่
                if (Array.isArray(res) && res.length > 0) {
                    res.forEach(function (item) {
                        option += `<option class='p-1' style='font-size:12px!important' value='${item.Service_name}'>${item.Service_name} ${item.service_price} บาท</option>`;
                    });
                    // ถ้าไม่ใช่ให้แสดง ว่าไม่มี
                } else {
                    option += `<option value='0'>ไม่มีข้อมูล</option>`;
                }
                $("#service").html(option);
            },
        });
    }

    function tel_number(InputElement){
        const phone = $("#tel_customer").val().replace(/\D/g, ""); // ลบตัวอักษรที่ไม่ใช่ตัวเลข
        let formatted  = phone;

        if(formatted.length >= 7){
            formatted = formatted.substring(0,10).replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
        }else if(formatted.length >= 4){
            formatted = formatted.replace(/(\d{3})(\d{3})/, "$1-$2");
        }

        $(InputElement).val(formatted); // เซ็ตค่าที่ format กลับเข้าไป

        if(formatted.length !== 10){
            $(InputElement).removeClass("border-success").addClass("border-danger border-2");
            $("#tel_notify").addClass("text-danger").text("กรุณาระบุเบอร์โทรศัพท์มือถือให้ถูกต้อง");
        }
    }

    

    function check_email(){
        const email = $("#email_customer").val().trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // รูปแบบอีเมลล์ที่ถูกต้อง
        if(emailPattern.test(email)){
            $("#email_customer").removeClass("border-danger").addClass("border-success border-2");
            $("#email_notify").removeClass("text-danger").addClass("text-success").text("อีเมล์ถูกต้อง");
        }else{
            $("#email_customer").removeClass("border-success").addClass("border-danger border-2");
            $("#email_notify").removeClass("text-success").addClass("text-danger").text("กรุณาระบุอีเมล์ให้ถูกต้อง");
        }
    }

    function auto_customer(telnumber) {
             $.ajax({
                        url: "/index_v1.2/api/autocomplete_customer.php",
                        type: "GET",
                        data: {telnumber: telnumber},
                        contentType: "application/json",
                        dataType: "JSON",
                        success: function (res) {
                                // console.log(res);
                            if (res.success && res.data) {
                                const data = res.data;

                // สมมติคุณอยากเติมข้อมูลใส่ฟอร์ม
                $('#members_code').val(data.member_code);
                $('#firstname').val(data.first_customer);
                $('#lastname').val(data.last_customer);
                $('#district').val(data.district_customer);
                $('#amphoe').val(data.amphoe_customer);
                $('#province').val(data.province_customer);
                $('#zipcode').val(data.zipcode_customer);
            } else {
                console.warn("ไม่พบข้อมูล", res.message);
            }
                        }

                        

             });
    }

    $("#telnumber").on("input", function (){
        const phone = $(this).val().trim().replace(/\D/g, '');
                
                         if(phone.length !== "" ){
                                auto_customer(phone); // เรียกใช้ฟังก์ชันเพื่อดึงข้อมูลลูกค้า
                         }else{
                              console.warn("กรุณากรอกรหัสสมาชิก");
                              
                         }
    });

    function comtype() {
        $.ajax({
            url: "/index_v1.2/api/computer_type.php",
            type: "POST",
            dataType: "JSON",
            success: function (res) {
                const data = res.map(function (item) {
                    return {
                        computer_name_th: item.computer_name_th,
                        computer_name_eng: item.computer_name_eng,
                    };
                });

                let option = "<option value='0'>กรุณาเลือกประเภทเครื่อง...</option>";

                if (Array.isArray(res) && res.length > 0) {
                    res.forEach(function (item) {
                        option += `<option class='p-1' style='font-size:12px!important' value='${item.computer_name_eng}'>${item.computer_name_th}</option>`;
                    });
                } else {
                    option += `<option>ไม่มีข้อมูล</option>`;
                }
                $("#com_type").html(option);
            },
        });
    }
    $("#tel_customer").on("input", function () {
        tel_number(this); // เรียกใช้ฟังก์ชันเพื่อจัดการเบอร์โทรศัพท์
              
        const phone = $(this).val().replace(/\D/g, ""); // เอาแค่ตัวเลขมานับ
                  
                  if(phone.length === 10){
                         $(this).addClass("");
                         $("#tel_notify").text("");
                        
                         $.ajax({
                                url: "/index_v1.2/api/tel_customer.php",
                                type : "GET",
                                data : {telnumber:phone},
                                dataType : "JSON",
                                success : function (res){
                                    if(res.success == true){
                                        $('#tel_customer').removeClass("border-danger").addClass("border-success border-2");
                                        $("#tel_notify").removeClass("text-danger").addClass("text-success").text(res.message);
                                    }else{
                                        $('#tel_customer').removeClass("border-success").addClass("border-danger border-2");
                                        $("#tel_notify").addClass("text-danger").text(res.message);  
                                    }
                                }
                         });

                  }else{
                        $(this).removeClass("border-success").addClass("border-danger border-2");
                        $("#tel_notify").addClass("text-danger").text("กรุณาระบุเบอร์โทรศัพท์มือถือให้ถูกต้อง");             
                  }
    });

    $("#email_customer").on("input", function () {
        check_email(); // เรียกใช้ฟังก์ชันเพื่อตรวจสอบอีเมล์
    });

     $("#service").one("focus", function () {
        // หรือใช้ 'mousedown' ถ้าอยากให้ทำงานเร็วกว่า
        // console.log("Dropdown '#service' ได้รับการโฟกัสครั้งแรก, กำลังโหลดตัวเลือก...");
        fecth_option(); // เรียกฟังก์ชันโหลดข้อมูล
    });

    $("#service").on("change", function () {
        var selectedValue = $(this).val();
        var selectedText = $(this).find("option:selected").text();

        console.log("คุณเลือกบริการ:", selectedText, "(Value:", selectedValue, ")");

        // คุณสามารถเพิ่ม Logic หรือการเรียก API อื่นๆ ตรงนี้ได้
        // เช่น: หากต้องการแสดงราคา หรือรายละเอียดเพิ่มเติมของบริการที่เลือก
        // ... (โค้ดสำหรับจัดการค่าที่เลือก) ...
    });
    // เรียกใช้ฟังก์ชัน comtype เมื่อหน้าโหลดครั้งแรก
    $("#com_type").one("focus", function () {
        comtype();
    });

    $("#com_type").on("change", function (data) {
        var selectValue = $(this).val();
        var selectText = $(this).find("option:selected").text();

        console.log("ประเภท:", selectText, "(Value:", selectValue, ")");
    });

    $("#repairForm").on("submit", function (e) {
        e.preventDefault();
        // .prop('checked') ตรวจสอบ checkbox ถูกเลือกหรือไม่

        const FormData = {
            member_code :$("#members_code") ?  $("#members_code").val() : "",
            es1: $("#es1").prop("checked") ? $("#es1").val() : "",
            es2: $("#es2").prop("checked") ? $("#es2").val() : "",
            es3: $("#es3").prop("checked") ? $("#es3").val() : "",
            es4: $("#es4").prop("checked") ? $("#es4").val() : "",
            es5: $("#es5").prop("checked") ? $("#es5").val() : "",
            es6: $("#es6").prop("checked") ? $("#es6").val() : "",
            es7: $("#es7").prop("checked") ? $("#es7").val() : "",
            es8: $("#es8").prop("checked") ? $("#es8").val() : "",
            es9: $("#es9").prop("checked") ? $("#es9").val() : "",
            es10: $("#es10").prop("checked") ? $("#es10").val() : "",
            es11: $("#es11").prop("checked") ? $("#es11").val() : "",
            es12: $("#es12").prop("checked") ? $("#es12").val() : "",
            es13: $("#es13").prop("checked") ? $("#es13").val() : "",
            es14: $("#es14").prop("checked") ? $("#es14").val() : "",
            es15: $("#es15").prop("checked") ? $("#es15").val() : "",
            other1: $("#other1").val(),
            product_condition: $("#product_condition").val(),
            mainternace_detail: $("#mainternace_detail").val(),
            detail: $("#detail").val(),
            Important: $("#Important").val(),
            status: 0,
            Computer_type: $("#com_type").val(),
            maintenance_type: $("#maintenance_type").val(),
            service: $("#service").val(),
            technician: $("#technician").val(),
        };

        $.ajax({
            url: "/index_v1.2/api/submit_repair.php",
            type: "POST",
            dataType: "JSON",
            data: JSON.stringify(FormData),
            contentType: "application/json",
            success: function (res) {
                // console.log(res)
                $("#submitBtn").prop("disabled", false).text("ส่งข้อมูล");
                // alert(res.success);
                 console.log(res);
                if (res.success == true) {
                     Swal.fire({
                         title: "บันทักข้อมูลสำเร็จ",
                         text: "บันทึกข้อมูลสำเร็จ",
                         icon: "success",
                         draggable: true,
                     });
                     setTimeout(() => {
                         window.location.href = "../link/home.php";
                     }, 2000);
                } else {
                    Swal.fire({
                        title: "บันทึกข้อมูลไม่สำเร็จ!!",
                        text: "กรุณาลองใหม่อีกครั้งภายหลัง",
                        icon: "error",
                        draggable: false,
                    });
                    setTimeout(() => { }, 2000);
                }
            },
        });
    });
/** */
    $(document).ready(function () {
        
        $("#telnumber").on("input", function () {
            let phone = $(this).val().replace(/\D/g, ""); // ลบตัวอักษรที่ไม่ใช่ตัวเลข
            if (phone.length > 10) phone = phone.substring(0, 10); // จำกัดแค่ 10 ตัว

            // จัดรูปแบบ xxx-xxx-xxxx
            if (phone.length >= 7) {
                phone = phone.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
            } else if (phone.length >= 4) {
                phone = phone.replace(/(\d{3})(\d{3})/, "$1-$2");
            }
            $(this).val(phone);

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
    });
});
$(document).on("click", ".btn-remove", function () {
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
                success: function (res) {
                    if (res.success) {
                        Swal.fire("ลบแล้ว!", "ข้อมูลถูกลบแล้ว", "success");
                        row.remove(); // ลบแถวออกจากตาราง
                    } else {
                        Swal.fire("เกิดข้อผิดพลาด!", res.message, "error");
                    }
                },
                error: function () {
                    Swal.fire("เกิดข้อผิดพลาด!", "ไม่สามารถลบข้อมูลได้", "error");
                },
            });
        }
    });
});

$(document).on("click", ".btn-view", function () {
    let id = $(this).data("id");
    $.ajax({
        url: "/index_v1.2/api/view_repair.php?id=" + id,
        type: "GET",
        dataType: "json",
        data: JSON.stringify({
            id: id,
        }),
        contentType: "application/json",
        success: function (res) {
            if (res.success) {
                window.location.href = "../link/view_data.php?id=" + id;
            } else {
                Swal.fire("เกิดข้อผิดพลาด!", res.message, "error");
            }
        },
        error: function () {
            Swal.fire("เกิดข้อผิดพลาด!", "ไม่สามารถดึงข้อมูลได้", "error");
        },
    });
});
