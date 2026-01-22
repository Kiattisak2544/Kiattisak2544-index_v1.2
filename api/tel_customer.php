<?php
header("Content-Type: application/json");

// ดึงข้อมูล JSON ที่ส่งเข้ามา
// $input = file_get_contents("php://input");
// $data = json_decode($input, true);

// include class ที่ใช้
include_once('../config/class.php');

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "GET"){ // เพิ่ม isset($_SERVER['REQUEST_METHOD']) เพื่อความปลอดภัย
    // $telnumber= trim($data['telnumber']);
    $telnumber= $_GET['telnumber'];
    if(empty($telnumber)){
        echo json_encode([
            'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน',
            'status' => 400,
            'success' => false
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }else{
        $web = new websystem();
        // เรียกใช้ฟังก์ชัน insert_customer และรับค่า JSON string กลับมา
        $result = $web->check_Telcustomer($telnumber);
        
        // ส่งค่า JSON string ที่ได้กลับไปทันที แค่ครั้งเดียว
        echo json_encode($result);
    }
} 

?>