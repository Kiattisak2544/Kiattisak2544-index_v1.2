<?php
// fect_data_customer.php

// กำหนด Content-Type ของ Response เป็น JSON
header('Content-Type: application/json');
include_once('../config/class.php');

// ตรวจสอบว่า Request Method เป็น GET หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // ตรวจสอบว่ามีพารามิเตอร์ 'data' ส่งมาใน URL Query String หรือไม่
    if (isset($_GET['data'])) { // <--- เปลี่ยนมาใช้ $_GET ตรงนี้
        $data = $_GET['data'];

        // ตัวอย่างการตอบกลับง่ายๆ สำหรับทดสอบ
      

        $web = new websystem();
        $result = $web->fect_data_customer($data);

        echo ($result);

    } else {
        // กรณีที่ไม่มีพารามิเตอร์ 'data' ส่งมา
        echo json_encode([
            'message' => 'ไม่มีข้อมูลส่งมา', // <--- ข้อความนี้จะแสดงเมื่อไม่มี 'data' ใน URL
            'status' => 400,
            'success' => false
        ]);
    }
} else {
    // กรณีที่ Request Method ไม่ใช่ GET
    echo json_encode([
        'message' => 'Invalid request method. Only GET is allowed.',
        'status' => 405, // HTTP 405 Method Not Allowed
        'success' => false
    ]);
}
?>
