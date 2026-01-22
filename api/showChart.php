<?php
       header("Content-Type: application/json");


        include_once('../config/class.php');

        if($_SERVER["REQUEST_METHOD"] == "POST"){
           
            $fetch_data = new websystem();
            $result = $fetch_data->Chart_js();
        


            echo $result; //✅ ส่ง JSON ออกไปให้ AJAX
            exit;
        }else{
            echo json_encode([
                'message' => 'ส่งข้อมูลล้มเหลว กรุณาลองใหม่',
                'status'  => 400,
                'success' => false
            ]);
            exit;
        }
?>