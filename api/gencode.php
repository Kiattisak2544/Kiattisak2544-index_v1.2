<?php
header("Content-Type: application/json");

// ดึงข้อมูล JSON ที่ส่งเข้ามา
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// include class ที่ใช้
include_once('../config/class.php');

if($_SERVER['REQUEST_METHOD'] === "GET"){
    $web = new websystem();
    $gencode = $web->gencode();
    if($gencode){
        echo json_encode([
            'message' => 'สร้างรหัสสมาชิกสำเร็จ',
            'status' => 200,
            'success' => true,
            'data' => $gencode
        ], JSON_UNESCAPED_UNICODE);
    }else{
        echo json_encode([
            'message' => 'ไม่สามารถสร้างรหัสสมาชิกได้',
            'status' => 500,
            'success' => false
        ], JSON_UNESCAPED_UNICODE);
    }
}
?>
