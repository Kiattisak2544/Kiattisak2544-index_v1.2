<?php

// view_repair.php
header('Content-Type: application/json');
include_once('../config/class.php');
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
        $id = trim($id);
    if(empty($id)) {
                echo json_encode([
                    'message' => 'ไม่มีค่าส่ง',
                    'status'  => 400,
                    'success' => false
                ],JSON_UNESCAPED_UNICODE);
    }else{
                
                $web = new websystem();
                $result = $web->view_repair($id);

                
                if($result){
                    echo json_encode([
                        'message' => 'success',
                        'status'  => 200,
                        'success' => true,
                ],JSON_UNESCAPED_UNICODE);
        }  
    }
  } else {
    echo "ไม่พบค่า ID ที่ส่งมา";
  }
?>