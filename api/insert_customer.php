<?php
header("Content-Type: application/json");

// ดึงข้อมูล JSON ที่ส่งเข้ามา
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// include class ที่ใช้
include_once('../config/class.php');

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === "POST"){ // เพิ่ม isset($_SERVER['REQUEST_METHOD']) เพื่อความปลอดภัย
    $member_code = trim($data['member_code'] ?? ''); // ใช้ null coalescing operator เพื่อป้องกัน undefined index
    $first_customer = trim($data['firstname'] ?? '');
    $last_customer = trim($data['lastname'] ?? '');
    $tel_customer = trim($data['telnumber'] ?? '');
    $email_customer = trim($data['email']   ?? '');
    $district = trim($data['district']  ?? '');
    $amphoe = trim($data['amphoe']  ?? '');
    $province = trim($data['province']  ?? '');
    $zipcode = trim($data['zipcode']    ?? '');

    if(empty($member_code) || empty($first_customer) || empty($last_customer) || empty($tel_customer) || empty($email_customer) || empty($district) || empty($amphoe) || empty($province) || empty($zipcode)){
        echo json_encode([
            'message' => 'กรุณากรอกข้อมูลให้ครบถ้วน',
            'status' => 400,
            'success' => false
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }else{
        $web = new websystem();
        // เรียกใช้ฟังก์ชัน insert_customer และรับค่า JSON string กลับมา
        $result = $web->insert_customer($member_code, $first_customer, $last_customer, $tel_customer, $email_customer, $district, $amphoe, $province, $zipcode);
        
        // ส่งค่า JSON string ที่ได้กลับไปทันที แค่ครั้งเดียว
        echo ($result);
    }
} 

?>