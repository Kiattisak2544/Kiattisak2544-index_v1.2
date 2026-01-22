<?php
header('Content-Type: application/json');
$input = file_get_contents("php://input");
$data  = json_decode($input, true);

include_once('../config/class.php');

if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    $id_user = trim($data['id_user']);
    $User_status = trim($data['User_status']);

    if (empty($id_user)) {
        echo json_encode([
            'message' => 'ไม่มีค่าส่ง',
            'status' => 400,
            'success' => false
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    
    $web = new websystem();
    $result = $web->update_user($id_user,$User_status);
   
    

   
    
}
?>
