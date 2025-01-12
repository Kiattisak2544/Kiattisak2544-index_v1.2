<?php

header("Content-Type:application/json");
// ดึงข้อมูลดิบ
$input = file_get_contents("php://input");
// แปลงข้อมูล json เป็น array
$data = json_decode($input, true);

include_once('../config/class.php');
// Check if the request method is POST
if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {
    // Sanitize and validate the input
    $firstname= trim($data['firstname']);

    if(empty($firstname)){
       echo json_encode([
            'message' => 'ไม่มีข้อมูล',
            'status' => 400,
            'success' => false
        ]);
    }else{
        $fetch_data = new websystem();
        $reult = $fetch_data->check_firstname($firstname);

        
    }
}

?>
