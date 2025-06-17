$(document).on("click", ".btn-print", function() {
    // ดึง ID จาก data-id ของปุ่มที่คลิก
    const id = $(this).data("id");

   

    // ส่งคำขอ AJAX เพื่ออัปเดตสถานะ
    $.ajax({
        url: "", // URL สำหรับอัปเดต
        type: "POST",
        dataType: "JSON",
        data: JSON.stringify({
            id: id
        }), // ส่ง ID ไปที่เซิร์ฟเวอร์
        contentType: "application/json",
        success: function(res) {
            var html ='';
            var text ='';
            var repairClass = '';
            console.log(res);
            if (res.success) {
                
                // แสดงข้อความแจ้งเตือน หรืออัปเดต UI
                repairText = "ซ่อมแล้ว";
                repairClass = 'text-success';
                location.reload(); 
                html = `<td class='text-center ${repairClass}' style='font-size:14px' data-id='${res.id}' id='status'>${repairText}</td>`;


                $('#status').html(html);
                alert(res.message);
               

               
            } else {
                location.reload(); 
                 alert( res.message);
            }
        },
        error: function() {
             alert("เกิดข้อผิดพลาดขณะส่งคำขอ!");
        },
    });
});