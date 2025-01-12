<?php
header("Content-Type:application/json");
// ดึงข้อมูลดิบ
$input = file_get_contents("php://input");
// แปลงข้อมูล json เป็น array
$data = json_decode($input, true);

include_once('../config/class.php');
// เช็คค่า POST
if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
    $firstname= trim($data['firstname']);
    $lastname = trim($data['lastname']);
    $username = trim($data['username']);
    $password = trim($data['password']);
    $brand    = trim($data['brand']);
    $user_number = trim($data['user_number']);
    $email    = trim($data['email']);

    if(empty($username) || empty($password)){
        echo json_encode([
            'message' => "กรุณากรอกข้อมูลให้ครบค่ะ!!!.",
            'status' => 400,
            'success'=> false
        ]);
    }else{
        $web = new websystem();
        $web->register($username,$password,$brand,$email,$firstname,$lastname,$user_number);
    }
}


?>