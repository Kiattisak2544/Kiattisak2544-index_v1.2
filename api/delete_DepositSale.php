<?php
         include_once('../config/class.php');
          $input = file_get_contents("php://input");
          $data = json_decode($input, true);
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id = trim($data['id'] ?? '');
            $fetch_data = new websystem();
            $result = $fetch_data->Del_Depositsale($id);
        
            echo $result; //✅ ส่ง JSON ออกไปให้ AJAX
            exit;
        }else{
            echo json_encode([
                'message' => 'ส่งข้อมูลล้มเหลว กรุณาลองใหม่',
                'status'  => 400,
                'success' => false
            ],);
            exit;
        }
?>