
<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">จัดการ ข้อมูลผู้ใช้</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="myForm">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="form-label text-label">ชื่อ</label>
                                <input type="text" class="form-control text-label" value="" readonly id="Firstname">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="form-label text-label">นามสกุล</label>
                                <input type="text" class="form-control text-label" value="" readonly id="Lastname">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="form-label text-label">ชื่อผู้ใช้งาน</label>
                                <input type="text" class="form-control text-label" value="" readonly id="Username">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="form-label text-label"
                                    i>สถานะผู้ใช้งาน</label>
                                <select class="form-select text-label" id="User_status" value="">
                                    <option value="">เลือกสถานะ</option>
                                    <option value="Admin">ผู้ดูแลระบบ</option>
                                    <option value="Technician">ช่างเทคนิค</option>
                                    <option value="Sale">พนักงานขาย</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="form-label text-label">รหัสพนักงาน</label>
                                <input type="text" class="form-control text-label" id="User_number" value="" readonly>
                                <input type="text" id='id_user' hidden>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped " id="myTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อผู้ใช้งาน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>User_status</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>




    <script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "ajax": {
                "url": '/index_v1.2/api/fecth_login.php', // URL ของ API endpoint PHP ของคุณ
                "type": 'GET',
                "dataType": 'json',
                dataSrc: function(json) {
                    if (json.success && json.data) {
                        let counter = 0;
                        return json.data.map(function(item) {
                            counter++;
                            return [
                                counter,
                                item.Username,
                                item.Firstname_repair,
                                item.Lastname_repair,
                                item.User_status,
                                `<button class="btn btn-info btn-sm edit-btn text-label text-white " style='font-size:14px' data-bs-toggle="modal" data-bs-target="#exampleModal"  value = "${item.id_user}"><i class="fa-solid fa-pen-to-square"></i>แก้ไข</button>`,
                                `<button class="btn btn-danger btn-sm text-label text-white" id=""style='font-size:14px'  value = "${item.id_user}"><i class="fa-solid fa-trash"></i>ลบ</button>`
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
                    "width": "5%"
                },
                {
                    "title": "ชื่อผู้ใช้งาน"
                },
                {
                    "title": "ชื่อ"
                },
                {
                    "title": "นามสกุล"
                },
                {
                    "title": "User_status",
                    "orderable": false,
                    "width": "15%"
                },
                {
                    "title": "",
                    "orderable": false
                },
                {
                    "title": "",
                    "orderable": false
                }
            ],
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true
        });




    });

    function fecth_data(userId) {
        $.ajax({
            url: '/index_v1.2/api/fecth_datalogin.php',
            type: 'GET',
            data: {
                id_user: userId
            },
            dataType: "json",
            success: function(res) {
                if (res.success && res.data) {
                    const user = res.data[0];
                    $('#id_user').val(user.id_user);
                    $('#Firstname').val(user.Firstname_repair);
                    $('#Lastname').val(user.Lastname_repair);
                    $('#Username').val(user.Username);
                    $('#User_status').val(user.User_status);
                    $("#User_number").val(user.User_number);
                    
                    


                    console.log("ข้อมูลที่ได้:", user);
                } else {
                    Swal.fire("ไม่พบข้อมูล", "ไม่มีข้อมูลของผู้ใช้งานนี้", "warning");
                }
            },
            error: function(xhr, status, error) {
                console.error("เกิดข้อผิดพลาด:", error);
                Swal.fire("ข้อผิดพลาด", "โหลดข้อมูลไม่สำเร็จ", "error");
            }
        });
    }

    function update_user(id_user,User_status){
        $.ajax({
                url: '/index_v1.2/api/update_login.php',
                type: 'PUT',
                data : JSON.stringify({id_user:id_user,User_status:User_status}),
                contentType: "application/json",
                dataType: "json", 
                success:function(res){
                    if(res.success){
                        Swal.fire({
                         title: "บันทักข้อมูลสำเร็จ",
                         text: "บันทึกข้อมูลสำเร็จ",
                         icon: "success",
                         draggable: true,
                     });
                     setTimeout(() => {
                         window.location.href = "home.php";
                     }, 2000);
                    }
                }
        });
    }

   


    $(document).on('click', '.edit-btn', function() {
        const userId = $(this).val();
        console.log("กดแก้ไข ID:", userId);
        fecth_data(userId); // ส่ง id ไปยังฟังก์ชัน


    });
    $('#btn-save').on('click', function(e){
         e.preventDefault();
         e.preventDefault();

         
           const id_user = $('#id_user').val();
           const User_status = $('#User_status').val();
         

         console.log(id_user)
         if(id_user.length > 0 && User_status !== 0){
             update_user(id_user,User_status);
         }
         
        
        });
    </script>
</body>