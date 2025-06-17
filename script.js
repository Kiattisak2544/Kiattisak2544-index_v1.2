$(document).ready(function () {


    function check_data() {
        const firstname = $("#firstname").val();
        const lastname = $("#lastname").val();
        const telnumber = $("#telnumber").val();
        const district = $("#district").val();
        const amphoe = $("#amphoe").val();
        const province = $("#province").val();
        const zipcode = $("#zipcode").val();

       if (firstname == "" || lastname == "" || brand == "" || telnumber == "" || district == "" || amphoe == "" || province == "" || zipcode == "") {
            $("#response")
                .removeClass("alert-success")
                .addClass("alert-danger")
                .text("กรุณากรอกข้อมูลให้ครบถ้วน")
                .show();
        }else{
            $("#response")
                .removeClass("alert-danger")
                .addClass("alert-success")
                .text("กรอกข้อมูลสำเร็จ")
                .show();
        }
    }
     
   
    // check charactoers
    function hasSpecialCharacters(str) {
        const regex = /['[!@#$%^&*()=+-,.?":{}|<>_/']/g; // Removed unnecessary `/` and fixed the dash placement
        return regex.test(str);
    }

    // check firstname
    $("#firstname").keyup(function () {
        const firstname = $(this).val();
        // check value
        if (hasSpecialCharacters(firstname)) {
            $("#fname-alert")
                .removeClass("text-success")
                .addClass("text-danger")
                .text("มีอักขระพิเศษกรุณากรอกใหม่!!")
                .show();
            $("#firstname").addClass("border border-3 border-danger");
            $("#firstname").removeClass("border border-3 border-suuccess");
        } else if (firstname == "") {
            $("#fname-alert")
                .removeClass("text-success")
                .addClass("text-danger")
                .text("ไม่มีข้อมูลกรุณากรอกข้อมูล!!")
                .show();
            $("#firstname").addClass("border border-3 border-danger");
            $("#firstname").removeClass("border border-3 border-suuccess");
        } else {
            $.ajax({
                url: "/index_v1.2/api/checkform_firstname.php",
                type: "POST",
                dataType: "JSON",
                data: JSON.stringify({ firstname: firstname }),
                contentType: "application/json",
                success: function (res) {
                    // check value res.success == true
                    // console.log(res)
                    if (res.success == true) {
                        $("#fname-alert")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text(res.message)
                            .show();

                        $("#firstname").addClass("border border-3 border-success");
                        $("#firstname").removeClass("border border-3 border-danger");
                    } else {
                        $("#fname-alert")
                            .removeClass("text-success")
                            .addClass("text-danger")
                            .text(res.message)
                            .show();
                        $("#firstname").addClass("border border-3 border-danger");
                        $("#firstname").removeClass("border border-3 border-success");
                    }
                },
            });
        }
    });
    // end
    $("#lastname").keyup(function () {
        const lastname = $(this).val();

        if (hasSpecialCharacters(lastname)) {
            $("#lname-alert")
                .removeClass("text-success")
                .addClass("text-danger")
                .text("มีอักขระพิเศษกรุณากรอกใหม่!!")
                .show();
            $("#lastname").addClass("border border-3 border-danger");
            $("#lastname").removeClass("border border-3 border-suuccess");
        } else if (lastname == "") {
            $("#lname-alert")
                .removeClass("text-success")
                .addClass("text-danger")
                .text("ไม่มีข้อมูลกรุณากรอกข้อมูล!!")
                .show();
            $("#lastname").addClass("border border-3 border-danger");
            $("#lastname").removeClass("border border-3 border-suuccess");
        } else {
            $("#lname-alert")
                .removeClass("text-danger")
                .addClass("text-success")
                .text("กรอกข้อมูลสำเร็จ")
                .show();
            $("#lastname").addClass("border border-3 border-success");
            $("#lastname").removeClass("border border-3 border-danger");
        }
    });

    $("#user_number").keyup(function () {
        let user_number = $(this).val();

        if (hasSpecialCharacters(user_number)) {
            $("#user_alert")
                .removeClass("text-success")
                .addClass("text-danger")
                .text("มีอักขระพิเศษกรุณากรอกใหม่!!");
            $("#user_number").addClass("borderr border-3 border-danger");
            $("user_number").removeClass("border border-3 border-success");
        } else if (user_number == "") {
            $("#user_alert")
                .removeClass("text-success")
                .addClass("text-danger")
                .text("ไม่มีข้อมูลกรุณากรอกใหม่!!");
            $("#user_number").addClass("border border-3 border-danger");
            $("#user_number").removeClass("border border-3 border-success");
        } else {
            $.ajax({
                url: "/index_v1.2/api/check_usernumber.php",
                type: "POST",
                dataType: "JSON",
                data: JSON.stringify({ user_number: user_number }),
                contentType: "application/json",
                success: function (res) {
                    // console.log(res);
                    if (res.success == true) {
                        $("#user_alert")
                            .removeClass("text-danger")
                            .addClass("text-success")
                            .text(res.message)
                            .show();
                        $("#user_number").addClass("border border-3 border-success");
                        $("#user_number").removeClass("border border-3 border-danger");
                    } else {
                        $("#user_alert")
                            .removeClass("text-success")
                            .addClass("text-danger")
                            .text(res.message)
                            .show();
                        $("#user_number").addClass("border border-3 border-danger");
                        $("#user_number").removeClass("border border-3 border-success");
                    }
                },
            });
        }
    });
    $("#email-alert").keyup(function () {
        const email = $(this).val();

        if (hasSpecialCharacters(email)) {
            $("#email_alert")
                .removeClass("text-success")
                .addClass("text-danger")
                .text("มีอักขระพิเศษกรุณากรอกใหม่");
        }
    });

    function check_password(password) {
        const strongPassword =
            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        const mediumPassword =
            /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{6,}$/;

        if (strongPassword.test(password)) {
            return {
                message: "Stong ",
                class: "text-success",
            };
        } else {
            return {
                message: "medium",
                class: "text-danger",
            };
        }
    }

    $('#username').keyup(function () {
        const username = $(this).val();

        if (username == "") {
            console.log('ไม่มีข้อมูล')
        } else {
            $.ajax({
                url: "/index_v1.2/api/check_username.php",
                type: "POST",
                data: JSON.stringify({ username: username }),
                contentType: "application/json",
                success: function (res) {
                    if (res.success == true) {
                        $('#username_alert')
                            .removeClass('text-danger')
                            .addClass('text-success')
                            .text(res.message).show();
                        $("#username").addClass("border border-3 border-success");
                        $("#username").removeClass("border border-3 border-danger");
                    } else {
                        $('#username_alert')
                            .removeClass('text-success')
                            .addClass('text-danger')
                            .text(res.message).show();
                           
                        $("#username").addClass("border border-3 border-danger");
                        $("#username").removeClass("border border-3 border-success");
                    }
                }

            });
        }
    });

    $("#confirm_password").on("keyup", function () {
        const password = $("#password").val();
        const confirm_password = $(this).val();
        const Message_passwords = check_password(password);

        if (password === confirm_password) {
            $("#alert-password")
                .addClass("text-success")
                .removeClass("text-danger")
                .html(
                    "<div><i class='fa-solid fa-check'></i><span class='mx-2'>Password Match</span></div>"
                )
                .show();
        } else {
            $("#alert-password")
                .addClass("text-danger")
                .addClass("text-success")
                .text("Passwors do not match")
                .show();
        }
    });

    // $('#myform').on('submit',function(e){
    //     const password = $('#password').val();
    //     const confirm_password = $('#confirm-password').val();
    //     const stengmessage = check_password(password);

    //     if(stengmessage.class == 'text-danger' || password != confirm_password){
    //         e.preventDefault();
    //         console.log('Please fix the errors before submitting.');
    //     }
    // });

    // register on submit
    $("#myform").on("submit", function (e) {
        const password = $("#password").val();
        const confirm_password = $("#confirm_password").val();
        const message_password = check_password(password);

        if (message_password.class === "text-danger" && password !== confirm_password) 
        {
            e.preventDefault();
            $("#alert-password")
                .addClass("text-danger")
                .removeClass("text-success")
                .html(
                    "<div><i class='fa-solid fa-x'></i><span class='mx-2'>มีบางอย่างผิดพลาดกรุณากรอกรหัสผ่านใหม่.</span></div>"
                )
                .show();
        } else {
            $("#alert-password")
                .addClass("text-success")
                .removeClass("text-danger")
                .html(
                    "<div><i class='fa-solid fa-check'></i><span class='mx-2'>รหัสผ่านใหม่ถูกต้อง.</span></div>"
                )
                .show();
        }

        const formData = {
            firstname: $("#firstname").val(),
            lastname: $("#lastname").val(),
            brand: $("#brand").val(),
            user_number: $("#user_number").val(),
            email: $("#email").val(),
            username: $("#username").val(),
            password: $("#password").val(),
        };
        // console.log(formData);
        $.ajax({
            url: "/index_v1.2/api/regis.php",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function (res) {
                if (res.success === true) {
                    $("#response")
                        .removeClass("alert-danger")
                        .addClass("alert-success")
                        .text(res.message)
                        .show();
                } else {
                    $("#response")
                        .removeClass("alert-success")
                        .addClass("alert-danger")
                        .text(res.message)
                        .show();
                }
            },
        });
    });

    // end register
});
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
                repairText = 'success';
            } else {
                repairClass = 'text-warning';
                repairText = 'waiting';
            }
            html += ` <tr>
            <td class='text-center' style = 'font-size:14px'>${i + 1}</td>
            <td class='text-center' style = 'font-size:14px'>${data[i].firstname}   ${data[i].lastname}</td>
            <td class='text-center' style = 'font-size:14px'>${data[i].telephone}</td>
            <td class='' style = 'font-size:14px'>${data[i].detail}</td>  
            <td class='' style = 'font-size:14px'>${data[i].date}</td>   
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
        url: "/index_v1.2/api/fecth_table.php",
        type: "post",
        dataType: "JSON",
        success: function (res) {
            data = res.map(function (item) {
                return {
                    id: item.id_broken,
                    firstname: item.firstname,
                    lastname: item.lastname,
                    detail: item.mainternace_detail,
                    status: item.status,
                    telephone: item.telephone,
                    date: item.date.split(" ")[0] 
                };
            });
            render_data();
        },
    });
}





