<?php
        
        header("Content-Type:application/json");

        $input = file_get_contents("php://input");

        $data =  json_decode($input,true);

        include_once('../config/class.php');

        if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
            $username = trim($data['username']);

            if(empty($username)){
                json_encode([
                    "message" => "ไม่พบข้อมูล",
                    "status"  => 400,
                    "success" => false
                ]);
                echo json_encode($json_encode,JSON_UNESCAPED_UNICODE);
            }else{
                $web = new websystem();
                $web->check_username($username);
            }
        }


?>