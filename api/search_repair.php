<?php
header("Content-Type: application/json");
$input = file_get_contents("php://input");
$data = json_decode($input, true);
include_once('../config/class.php');

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $search = trim($data['searchValue']);


    
       
       if (empty($search)){
              echo json_encode([
                'message' => 'กรุณากรอกข้อมูลที่ต้องการค้นหา',
                'status'  => 400,
                'success' => false
            ], JSON_UNESCAPED_UNICODE);
       } else {
            $fetch_data = new websystem();
            $result = $fetch_data->search_repair($search);

       }
             
}
?>
