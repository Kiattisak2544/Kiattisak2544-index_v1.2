<?php
header("Content-Type:application/json");
// ดึงข้อมูลดิบ
$input = file_get_contents("php://input");
// แปลงข้อมูล json เป็น array
$data = json_decode($input, true);

include_once('../config/class.php');
// เช็คค่า POST
if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
    $username = trim($data['username']);
    $password = trim($data['password']);

    if(empty($username) || empty($password)){
        echo json_encode([
            'message' => "ไม่พบข้อมูล",
            'status' => 400,
            'success'=> false
        ]);
    }else{
         $web = new websystem();
         $web->login($username,$password);
    }
}


?>