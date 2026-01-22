<?php
        header("Content-Type:application/json");

        $input = file_get_contents("php://input");

        $data = json_decode($input, true);

        include_once('../config/class.php');

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $status = 0;


            
            if($status == 0){
                $fetch_data = new websystem();
                $reult = $fetch_data-> data_repair_nopass($status);
                echo $reult;


            }else{
               echo json_encode([
                    'message' => 'ข้อมูลไม่ถูกต้อง',
                    'status' => 400,
                    'success' => false
                ]);
            }
        }


?>