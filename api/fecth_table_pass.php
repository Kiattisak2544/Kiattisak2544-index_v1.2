<?php
        header("Content-Type:application/json");

        $input = file_get_contents("php://input");

        $data = json_decode($input, true);

        include_once('../config/class.php');

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $status = true;
            
            if($status == true){
                $fetch_data = new websystem();
                $reult = $fetch_data-> data_repair_pass($status);

            }else{
               echo json_encode([
                    'message' => 'ข้อมูลไม่ถูกต้อง',
                    'status' => 400,
                    'success' => false
                ]);
            }
        }


?>