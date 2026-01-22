<?php
      header("Content-Type: application/json");

        $input = file_get_contents("php://input");
        $data = json_decode($input, true);
        include_once('../config/class.php');

        if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {
            // $firstname = trim($data['firstname']);
            // $lastname = trim($data['lastname'] );
            // $telnumber = trim($data['telnumber'] );
            // $district  = trim($data['district']);
            // $amphoe = trim($data['amphoe']);
            // $province = trim($data['province']);
            // $zipcode  = trim($data['zipcode']);
            $member_code = trim($data['member_code']);
            $es1 = trim($data['es1']);
            $es2 = trim($data['es2']);
            $es3 = trim($data ['es3']);
            $es4 = trim($data['es4']);
            $es5 = trim($data['es5']);
            $es6 = trim($data['es6']);
            $es7 = trim($data['es7']);
            $es8 = trim($data['es8']);
            $es9 = trim($data['es9']);
            $es10 = trim($data['es10']);
            $es11 = trim($data['es11']);
            $es12 = trim($data['es12']);
            $es13 = trim($data['es13']);
            $es14 = trim($data['es14']);
            $es15 = trim($data['es15']);
            $other1 = trim($data['other1']);
            $product_condition = trim($data['product_condition']);
            $mainternace_detail = trim($data['mainternace_detail']);
            $detail = trim($data['detail']);
            $Important = trim($data['Important']);
            $status = trim($data['status']);
            $Computer_type = trim($data['Computer_type']);
            $maintenance_type = trim($data['maintenance_type']);
            $service = trim($data['service']);
            $technician = trim($data['technician']);
           
            // print_r($_POST)

           
            if (empty($member_code)) {
                echo json_encode([
                    "message" => "กรุณากรอกข้อมูลให้ครบถ้วน",
                    "status" => 400,
                    "success" => false
                    
                ],JSON_UNESCAPED_UNICODE);
                exit;
            }
            $web = new websystem();
            // $web2 = new websystem();
            

            try{    
                    // เรียกใช้ฟังก์ชัน submit_repair
                   
                    // เรียกใช้ฟังก์ชัน system_repair2
                    $web->system_repair($member_code, $es1, $es2, $es3, $es4, $es5, $es6, $es7, $es8, $es9, $es10, $es11, $es12, $es13, $es14, $es15, $other1, $product_condition, $detail, $Important, $Computer_type, $maintenance_type, $service,$technician,$status, $mainternace_detail);

                    

            }catch (Exception $e){

                     // กรณีเกิดข้อผิดพลาด
                        echo json_encode([
                            "message" => "เกิดข้อผิดพลาด: " . $e->getMessage(),
                            "status" => 500,
                            "success" => false
                        ], JSON_UNESCAPED_UNICODE);
            }
        }else{
            // ถ้าไม่ใช่ POST
            echo json_encode([
                "message" => "ไม่รองรับคำขอนี้",
                "status" => 405,
                "success" => false
    ], JSON_UNESCAPED_UNICODE);
        }

        

?>