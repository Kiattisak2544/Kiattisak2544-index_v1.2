<?php
        include_once('connect.php');
        
        class websystem {

                private $db;
                
                public function __construct()
                {
                        $this->db = connectDB();
                }

                public function login($username,$password){
                     try{
                        $stmt = $this->db->prepare("SELECT id_user,Username,Password_repair,Firstname_repair,Lastname_repair,User_status,brand_id FROM `login_user`  WHERE Username = :username ");
                        $stmt->execute(['username'=>$username]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($user) {
                                if(password_verify($password, $user['Password_repair'])){
                                        $_SESSION['id_user'] = $user['id_user'];
                                        $_SESSION['Username'] = $user['Username'];
                                        $_SESSION['Firstname_repair'] = $user['Firstname_repair'];
                                        $_SESSION['Lastname_repair'] = $user['Lastname_repair'];
                                        $_SESSION['User_status'] = $user['User_status'];
                                        $_SESSION['brand_id']    = $user['brand_id'];

                                       echo json_encode([
                                                'message' => 'เข้าสู่ระบบสำเร็จ',
                                                'status'  => 200,
                                                'success' => true
                                       ]);
                                }else{
                                        echo json_encode([
                                                'message' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
                                                'status'  => 400,
                                                'success' => false
                                        ]);
                                }
                        }else{
                                echo json_encode([
                                        'message' => 'กรุณากรอกข้อมูลใหม่อีกครั้ง',
                                        'status'  => 400,
                                        'success' => false
                                ]);
                        }

                     }catch (PDOException $e){
                        echo json_encode([
                                'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                'status'  => 500,
                                'success' => false
                            ]);

                     }
                }
                public function Display_user(){
                        try{
                                $stmt = $this->db->prepare("SELECT * FROM login_user WHERE id_user = :id_user");
                                $stmt->execute(['id_user' => $_SESSION['id_user']]);
                                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                return $user;
                        }catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }

                public function register($username, $password, $brand, $email, $firstname, $lastname, $user_number) {
                        try {
                            // Check if the username already exists เช็คมีข้อมูลซ้ำไหม
                            $stmt = $this->db->prepare("SELECT * FROM login_user WHERE Username = :username");
                            $stmt->execute(['username' => $username]);
                            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                           
                        //     
                            if ($user) {
                                echo json_encode([
                                    'message' => 'ชื่อผู้ใช้มีอยู่แล้ว',
                                    'status'  => 400,
                                    'success' => false
                                ]);
                                return;
                            }
                    
                            // Hash the password
                            $hash_password = password_hash($password, PASSWORD_DEFAULT);
                    
                            // Insert the new user into the database
                            $stmt = $this->db->prepare("INSERT INTO login_user (Username, Password_repair, User_number, Firstname_repair, Lastname_repair, email_repair, brand_id) VALUES(:username, :password, :user_number, :firstname, :lastname, :email, :brand)");
                            $stmt->execute([
                                'username' => $username,
                                'password' => $hash_password,
                                'user_number' => $user_number,
                                'firstname' => $firstname,
                                'lastname' => $lastname,
                                'email' => $email,
                                'brand' => $brand
                            ]);
                    
                            echo json_encode([
                                'message' => 'สมัครสมาชิก สำเร็จ',
                                'status'  => 200,
                                'success' => true
                            ]);
                        } catch (PDOException $e) {
                            echo json_encode([
                                'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                'status'  => 500,
                                'success' => false
                            ]);
                        }
                    }
                public function brand(){
                        try{
                                $data = $this->db->prepare("SELECT * FROM brand_grounds");
                                $data->execute();
                                return $data = $data->fetchAll(PDO::FETCH_ASSOC);

                        }catch(PDOException $e) {
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function check_firstname($firstname){
                        try{
                                $stmt = $this->db->prepare('SELECT * FROM login_user WHERE Firstname_repair = :firstname');
                                $result = $stmt->execute(['firstname'=>$firstname]);
                                $chk_firstname = $stmt->fetch(PDO::FETCH_ASSOC);

                                if($chk_firstname > 0){
                                        $json_encode = ([
                                                'message' => 'ชื่อนี้ใช้งานแล้ว!!!',
                                                'status'  => 400,
                                                'success' => false
                                        ]);
                                        echo json_encode($json_encode);
                                }else{
                                        $json_encode = ([
                                                'message' => 'ชื่อนี้ใช้งานได้ ',
                                                'status'  => 200,
                                                'success' => true
                                        ]);
                                        echo json_encode($json_encode);
                                }
                        }catch(PDOException $e){
                                $json_encode = ([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                                echo json_encode($json_encode);
                        }
                }
                public function check_lastname($lastname){
                        try{
                               $stmt = $this->db->prepare('SELECT * FROM login_user WHERE Lastname_repair = :lastname');
                               $result = $stmt->execute(['lastname' => $lastname]);
                               $chk_lastname  = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              
                              if($chk_lastname){
                                        $json_encode = ([
                                                'message' => 'เพิ่มข้อมูลสำเร็จ',
                                                'status' => 200,
                                                'success'=> true
                                        ]);

                                        echo json_encode($json_encode, JSON_UNESCAPED_UNICODE);         
                              }
                        }catch(PDOException $e){
                                $json_encode = ([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);

                                echo json_encode($json_encode, JSON_UNESCAPED_UNICODE);
                        }
                }
                public function check_usernumber($usernumber){
                        try{
                                $stmt = $this->db->prepare('SELECT * FROM `login_user` WHERE `User_number` = :user_number');
                                $stmt->execute(['user_number' => $usernumber]);
                                $chk_usernum = $stmt->fetch(PDO::FETCH_ASSOC);

                               
                                
                                if($chk_usernum > 0){
                                        $json_encode = ([
                                                'message' => 'รหัสพนักงานนี้ถูกใช้แล้ว',
                                                'status'  => 400,
                                                'success' => false
                                        ]);
                                        echo json_encode($json_encode);
                                }else{
                                        $json_encode = ([
                                                'message' => 'กรอกข้อมูลสำเร็จ',
                                                'status' => 200,
                                                'success' => true
                                        ]);
                                        echo json_encode($json_encode);
                                }
                        }catch(PDOException $e){
                                $json_encode = ([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                                echo json_encode($json_encode, JSON_UNESCAPED_UNICODE);
                        }
                }

                public function check_username($username){
                       try{
                                $stmt = $this->db->prepare('SELECT * FROM `login_user` WHERE `Username` =:username');
                                $stmt->execute(['username' => $username]);
                                $check_username = $stmt->fetch(PDO::FETCH_ASSOC);

                                if($check_username > 0){
                                        echo json_encode([
                                                'message' => 'ชื่อผู้ใช้นี้ถูกใช้งานแล้วค่ะ!!',
                                                'status'  => 400,
                                                'success' => false
                                        ]);
                                }else{
                                        echo json_encode([
                                                'message' => 'ชื่อผู้ใช้นี้ใช้งานได้',
                                                'status'  => 200,
                                                'success' => true
                                        ]);
                                }
                       }catch(PDOException $e){
                        echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                        ]);
                       }
                }
                public function data_repair(){
                        try{
                                $stmt = $this->db->prepare("SELECT broken_symptoms.id_broken,broken_symptoms.firstname,broken_symptoms.lastname,broken_symptoms.telephone,broken_symptoms.status,broken_symptoms.mainternace_detail,broken_symptoms1.date
                                                                FROM broken_symptoms INNER JOIN broken_symptoms1 on broken_symptoms.id_broken = broken_symptoms1.id_es ORDER BY broken_symptoms.id_broken DESC ");
                                $stmt->execute();
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                        
                        }catch (PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function data_repair_pass($status){
                        try{
                                //  Select ข้อมูลทั้งหมด
                                 $stmt = $this->db->prepare("SELECT broken_symptoms.id_broken,broken_symptoms.firstname,broken_symptoms.lastname,broken_symptoms.telephone,broken_symptoms.status,broken_symptoms.mainternace_detail,broken_symptoms1.date,broken_symptoms1.technician
                                                         FROM broken_symptoms 
                                                         INNER JOIN broken_symptoms1 
                                                         on broken_symptoms.id_broken = broken_symptoms1.id_es
                                                         WHERE broken_symptoms.status = :status  
                                                         ORDER BY broken_symptoms.id_broken DESC ");
                                // แสดงเฉพาะ เดือน ปัจจุบัน
                                // $stmt = $this->db->prepare("SELECT broken_symptoms.id_broken, broken_symptoms.firstname, broken_symptoms.lastname, 
                                //                                 broken_symptoms.telephone, broken_symptoms.status, 
                                //                                 broken_symptoms.mainternace_detail, broken_symptoms1.date
                                //                                 FROM broken_symptoms 
                                //                                 INNER JOIN broken_symptoms1  ON broken_symptoms.id_broken = broken_symptoms1.id_es
                                //                                 WHERE broken_symptoms.status = :status
                                //                                 AND MONTH(broken_symptoms1.date) = MONTH(CURDATE()) 
                                //                                 AND YEAR(broken_symptoms1.date) = YEAR(CURDATE())
                                //                                 ORDER BY broken_symptoms.id_broken DESC;
                                //                           ");

                                $stmt->execute(['status' => $status] );
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                        
                        }catch (PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function data_repair_nopass($status){
                        try{
                                $stmt = $this->db->prepare("SELECT broken_symptoms.id_broken,broken_symptoms.firstname,broken_symptoms.lastname,broken_symptoms.telephone,broken_symptoms.status,broken_symptoms.mainternace_detail,broken_symptoms1.date
                                                        FROM broken_symptoms 
                                                        INNER JOIN broken_symptoms1 
                                                        on broken_symptoms.id_broken = broken_symptoms1.id_es
                                                        WHERE broken_symptoms.status = :status  
                                                        ORDER BY broken_symptoms.id_broken DESC ");

                                $stmt->execute(['status' => $status] );
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                echo json_encode($data,JSON_UNESCAPED_UNICODE);
                        
                        }catch (PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function update_status($id,$status){
                        try{
                                $stmt = $this->db->prepare("UPDATE broken_symptoms SET status = :status WHERE id_broken  = :id");
                                $result = $stmt->execute([
                                        'id' => $id,
                                        'status' => $status
                                ]);
                                // ตรวจเช็ค ค่า ที่ส่งมาว่า มีค่ามากกว่า 0 แล้วทำตามเงื่อนไข
                                if($stmt->rowCount() > 0){
                                        $select = $this->db->prepare("SELECT * FROM broken_symptoms WHERE id_broken = :id_broken");
                                        $select->execute(['id_broken' => $id]);
                                        $row = $select->fetch(PDO::FETCH_ASSOC);
                                        // $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                             if($row == true){
                                                $token = 'aomvtgA4Fzu9iz3ZinSO9HaoZ7CExG0yFn8BQE5vj1Bg2Kz6dC48ltnm4pSPTY/4qov6TjQvrik+tf3tYtFW5bJ8c+i2CmFoIL/v1W8to/a5VIsCIk4PIpj3uqq9eFV16e9eEXHVi+cs30SuOzhq4wdB04t89/1O/w1cDnyilFU='; // เอาไปเก็บในไฟล์ config หรือ ENV
                                                $user_id = 'C6bb051f7dac5ce77c6fba8dc53091be0';
                                                $message = 'หมายเลข : '.$id.' คุณ : '.$row['firstname'].' '.$row['lastname'].' ได้ทำการซ่อมเสร็จเรียบร้อยแล้วครับ!!';

                                                $lineData = [
                                                                 'to' => $user_id,
                                                                 'messages' => [
                                                                     [
                                                                         'type' => 'text',
                                                                         'text' => $message
                                                                     ]
                                                                 ]
                                                             ];
                                                $headers = [
                                                                 'Content-Type: application/json',
                                                                 'Authorization: Bearer ' .$token
                                                ];
                                                $ch = curl_init('https://api.line.me/v2/bot/message/push');
                                                curl_setopt($ch, CURLOPT_POST, true);
                                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($lineData));
                                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                $response = curl_exec($ch);
                                                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

                                                if ($httpCode !== 200) {
                                                                 echo json_encode([
                                                                     'message' => 'ส่งข้อความไปยัง LINE Notify ไม่สำเร็จ',
                                                                     'status' => $httpCode,
                                                                     'success' => false
                                                                 ], JSON_UNESCAPED_UNICODE);
                                                                 exit;
                                                             }
                                                                 else {
                                                                        echo json_encode([
                                                                            'message' => 'ส่งข้อความไปยัง LINE Notify สำเร็จ',
                                                                            'status' => 200,
                                                                            'success' => true
                                                                        ], JSON_UNESCAPED_UNICODE);
                                                                        exit;
                                                                 }

                                               
                                             }
                                      
                                }
                                // ตรวจเช็ค ค่า ที่ส่งมาว่า มีค่าน้อยกว่า 0 แล้วทำตามเงื่อนไข
                                else{
                                        echo json_encode([
                                                'message' => 'ไม่พบข้อมูลที่ต้องการอัปเดต',
                                                'status'  => 401,
                                                'success' => false,
                                                'id'   => $id
                                            ],JSON_UNESCAPED_UNICODE);
                                }
                        }catch (PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ],JSON_UNESCAPED_UNICODE);
                        }
                }
                //  public function GetuserInfo($id){
                //          try{
                //                  $stmt = $this->db->prepare("SELECT * FROM broken_symptoms WHERE id_broken  = :id");
                //                  $stmt->execute(['id' => $id]);
                //                  $data = $stmt->fetch(PDO::FETCH_ASSOC);

                //                   return $data ? $data: null;

                //                  echo json_encode($data,JSON_UNESCAPED_UNICODE);

                        

                //          }catch(PDOException $e){
                //                  echo json_encode([
                //                          'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                //                          'status'  => 500,
                //                          'success' => false
                //                  ],JSON_UNESCAPED_UNICODE);
                //          }
                //  }
                public function data_repair_id($id){
                        try{
                                $stmt = $this->db->prepare("SELECT * FROM broken_symptoms WHERE id_broken = :id_broken");
                                $stmt->execute(['id_broken' => $id]);
                                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                                return json_encode($data,JSON_UNESCAPED_UNICODE);
                        }catch (PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function num_rows(){
                        try{
                                $stmt = $this->db->prepare("SELECT COUNT(*) FROM `broken_symptoms` WHERE id_broken");
                                $stmt->execute();
                                $row = $stmt->fetchColumn();

                                return $row;
                        }catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function pass_repair(){
                        try{
                                $stmt = $this->db->prepare("SELECT COUNT(*) FROM `broken_symptoms` WHERE status = 1");
                                $stmt->execute();
                                $row = $stmt->fetchColumn();

                                return $row;
                        }catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function notpass_repair(){
                        try{
                                $stmt = $this->db->prepare("SELECT COUNT(*) FROM `broken_symptoms` WHERE status = 0");
                                $stmt->execute();
                                $row = $stmt->fetchColumn();

                                return $row;
                        }catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function submit_repair($firstname,$lastname,$telnumber,$district,$amphoe,$province,$zipcode,$mainternace_detail,$status){
                        try{
                                $stmt=$this->db->prepare("INSERT INTO `broken_symptoms`(`firstname`, `lastname`, `telephone`, `zip_code`, `district`, `amphoe`, `province`, `mainternace_detail`, `status`) VALUES (:firstname, :lastname, :telephone, :zip_code,
                                                                :district, :amphoe, :province, :mainternace_detail, :status )");
                                
                                $stmt->execute([
                                        'firstname' => $firstname,
                                        'lastname' => $lastname,
                                        'telephone' => $telnumber,
                                        'zip_code' => $zipcode,
                                        'district' => $district,
                                        'amphoe' => $amphoe,
                                        'province' => $province,
                                        'mainternace_detail' => $mainternace_detail,
                                        'status' => $status
                                ]);
                                // ตรวจสอบว่ามีการเพิ่มข้อมูลจริงหรือไม่
                                // if($stmt->rowCount() > 0){
                                //         echo json_encode([
                                //                 'message' => 'กรอกข้อมูลสำเร็จ',
                                //                 'status'  => 200,
                                //                 'success' => true
                                //         ],JSON_UNESCAPED_UNICODE);
                                // }else{
                                //         echo json_encode([
                                //                 'message' => 'กรอกข้อมูลไม่สำเร็จ!!',
                                //                 'status'  => 400,
                                //                 'success' => false
                                //         ]);
                                // }

                        }catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ],JSON_UNESCAPED_UNICODE);
                        }
                }
                public function system_repair2($es1, $es2, $es3, $es4, $es5, $es6, $es7, $es8, $es9, $es10, 
                $es11, $es12, $es13, $es14, $es15, $other1, $product_condition, $detail, $Important, $Computer_type, $maintenance_type, $service, $technician){ 
                        try {
                            $stmt = $this->db->prepare("INSERT INTO `broken_symptoms1`
                                (`es1`, `es2`, `es3`, `es4`, `es5`, `es6`, `es7`, `es8`, `es9`, `es10`, `es11`, `es12`, `es13`, `es14`, `es15`, `other1`, `product_condition`, `detail`, `Important`, `Computer_type`, `maintenance_type`, `Service_rate` , `technician`)         
                                VALUES 
                                (:es1, :es2, :es3, :es4, :es5, :es6, :es7, :es8, :es9, :es10, :es11, :es12, :es13, :es14, :es15, :other1, :product_condition, :detail, :Important, :Computer_type, :maintenance_type, :Service_rate, :technician)");
                    
                            $stmt->execute([
                                'es1' => $es1, 'es2' => $es2, 'es3' => $es3, 'es4' => $es4, 'es5' => $es5, 'es6' => $es6, 'es7' => $es7,
                                'es8' => $es8, 'es9' => $es9, 'es10' => $es10, 'es11' => $es11, 'es12' => $es12, 'es13' => $es13, 'es14' => $es14, 'es15' => $es15,
                                'other1' => $other1, 'product_condition' => $product_condition, 'detail' => $detail, 'Important' => $Important,
                                'Computer_type' => $Computer_type, 'maintenance_type' => $maintenance_type, 'Service_rate' => $service, 'technician' => $technician
                            ]);
                    
                        //     retur json_encode([
                        //         'message' => 'บันทึกข้อมูลสำเร็จ',
                        //         'status'  => 200,
                        //         'success' => true
                        //     ], JSON_UNESCAPED_UNICODE);
                    
                        } catch (PDOException $e) {
                            return json_encode([
                                'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                'status'  => 500,
                                'success' => false,
                                'error'   => $e->getMessage() // Debugging (ควรเอาออกตอนใช้งานจริง)
                            ], JSON_UNESCAPED_UNICODE);
                        }
                    }
                public function Chart_js(){
                        try{
                                $stmt = $this->db->prepare("SELECT
                                                YEAR(broken_symptoms1.date) AS repair_year,
                                                MONTH(broken_symptoms1.date) AS repair_month,
                                                COUNT(*) AS total_repairs
                                                FROM broken_symptoms
                                                INNER JOIN
                                                        broken_symptoms1 ON broken_symptoms.id_broken = broken_symptoms1.id_es
                                                WHERE broken_symptoms.status = 1
                                                GROUP BY
                                                        repair_year,
                                                        repair_month
                                                ORDER BY
                                                        repair_year,
                                                        repair_month
                                                                ");
                                $stmt->execute();
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                return json_encode($data,JSON_UNESCAPED_UNICODE);
                        } catch (PDOException $e) {
                                return json_encode([
                                    'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                    'status'  => 500,
                                    'success' => false,
                                    'error'   => $e->getMessage() // Debugging (ควรเอาออกตอนใช้งานจริง)
                                ], JSON_UNESCAPED_UNICODE);
                            }
                }
                public function Chart_circle(){
                        try{
                                // แสดงข้อมูลกราฟทั้งหมด
                                // $stmt = $this->db->prepare("SELECT 
                                //         broken_symptoms1.Computer_type,COUNT(*) AS total_count
                                //         FROM  broken_symptoms 
                                //         INNER JOIN broken_symptoms1 ON broken_symptoms.id_broken = broken_symptoms1.id_es WHERE broken_symptoms1.Computer_type IN ('computer_out','computer_in-jib')
                                //         GROUP BY broken_symptoms1.Computer_type");

                                // แสดงข้อมูลกราฟเดือน ปัจจุบัน
                               /** 
                                $stmt = $this->db->prepare("SELECT
                                                                broken_symptoms1.Computer_type,
                                                                COUNT(*) AS total_count
                                                                FROM broken_symptoms
                                                                INNER JOIN broken_symptoms1 ON broken_symptoms.id_broken = broken_symptoms1.id_es
                                                                WHERE broken_symptoms.status = '1' AND 
                                                                broken_symptoms1.Computer_type IN ('computer_out', 'computer_in-jib')
                                                                AND MONTH(broken_symptoms1.date) = MONTH(CURDATE())
                                                                AND YEAR(broken_symptoms1.date) = YEAR(CURDATE())
                                                                GROUP BY broken_symptoms1.Computer_type  ;");*/
                                               
                                 /** แสดงข้อมูล เวลาปัจจุบัน โดยมีการ กำหนดค่า total_cout ถ้้าไม่มีข้อมูลให้เป็น 0 */
                                 
                                $stmt = $this->db->prepare("SELECT 
                                                                ct.Computer_type, COALESCE(subquery.total_count, 0) AS total_count
                                                             FROM
                                                                (SELECT 'computer_out' AS Computer_type UNION SELECT 'computer_in-jib') AS ct LEFT JOIN
                                                                        (
                                                                                SELECT
                                                                                        broken_symptoms1.Computer_type,
                                                                                        COUNT(*) AS total_count
                                                                                        FROM broken_symptoms
                                                                                        INNER JOIN broken_symptoms1 ON broken_symptoms.id_broken = broken_symptoms1.id_es
                                                                                        WHERE broken_symptoms.status = '1' AND 
                                                                                        broken_symptoms1.Computer_type IN ('computer_out', 'computer_in-jib')
                                                                                        AND MONTH(broken_symptoms1.date) = MONTH(CURDATE())
                                                                                AND YEAR(broken_symptoms1.date) = YEAR(CURDATE())
                                                                GROUP BY broken_symptoms1.Computer_type) AS subquery ON ct.Computer_type = subquery.Computer_type ;
                                                          "); 
                                $stmt->execute();
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                return json_encode($data,JSON_UNESCAPED_UNICODE);
                        } catch (PDOException $e) {
                                return json_encode([
                                    'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                    'status'  => 500,
                                    'success' => false,
                                    'error'   => $e->getMessage() // Debugging (ควรเอาออกตอนใช้งานจริง)
                                ], JSON_UNESCAPED_UNICODE);
                            }
                }
                public function Chart_year(){
                        try{
                                $stmt = $this->db->prepare("SELECT 
                                         broken_symptoms1.Computer_type,COUNT(*) AS com_count
                                         FROM  broken_symptoms 
                                         INNER JOIN broken_symptoms1 ON broken_symptoms.id_broken = broken_symptoms1.id_es WHERE broken_symptoms.status = '1' AND  broken_symptoms1.Computer_type IN ('computer_out','computer_in-jib')
                                         GROUP BY broken_symptoms1.Computer_type");
                                $stmt->execute();
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                return json_encode($data,JSON_UNESCAPED_UNICODE);
                        } catch (PDOException $e) {
                                return json_encode([
                                    'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                    'status'  => 500,
                                    'success' => false,
                                    'error'   => $e->getMessage() // Debugging (ควรเอาออกตอนใช้งานจริง)
                                ], JSON_UNESCAPED_UNICODE);
                            }
                }
                public function service_rates(){
                        try{
                                $data = $this->db->prepare("SELECT * FROM service_rates");
                                $data->execute();
                                return $data = $data->fetchAll(PDO::FETCH_ASSOC);

                        }catch(PDOException $e) {
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                } 
                // ค้นหาข้อมูลการซ่อม
               public function search_repair($search) {
                     try{
                           $searchTeam = '%'.$search.'%'; // กำหนดรูปแบบการค้นหา
                        // ตรวจสอบว่ามีการส่งค่า search มาหรือไม่
                           $stmt = $this->db->prepare("SELECT 
                                broken_symptoms.id_broken,
                                broken_symptoms.firstname, 
                                broken_symptoms.lastname,
                                broken_symptoms.telephone,
                                broken_symptoms.status,
                                broken_symptoms.mainternace_detail,
                                broken_symptoms1.date,
                                broken_symptoms1.technician
                                FROM broken_symptoms
                                INNER JOIN broken_symptoms1 
                                ON broken_symptoms.id_broken = broken_symptoms1.id_es
                                WHERE broken_symptoms.firstname LIKE :search1
                                OR broken_symptoms.lastname LIKE :search2
                                OR broken_symptoms.telephone LIKE :search3
                               
                                
                        ");
                        // กำหนดค่าพารามิเตอร์สำหรับการค้นหา
                        $stmt->execute([
                                'search1' => $searchTeam,
                                'search2' => $searchTeam,
                                'search3' => $searchTeam
                        ]);
                        // ดึงข้อมูลทั้งหมดที่ค้นหาได้
                        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        

                        if($stmt->rowCount() > 0){
                           json_encode([
                                'message' => 'ค้นหาข้อมูลสำเร็จ',
                                'status'  => 200,
                                'success' => true,
                                'data'    => $data
                            ], JSON_UNESCAPED_UNICODE);
                            echo json_encode($data, JSON_UNESCAPED_UNICODE);
                        }
                        exit;
                        
                     }catch (PDOException $e) {
                        echo json_encode([
                            'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์' . $e->getMessage(),
                            'status'  => 500,
                            'success' => false
                        ], JSON_UNESCAPED_UNICODE);
                     }
                        exit;

               }
                // ลบข้อมูลการซ่อม
                public function delete_repair($id){
                        try{
                                $stmt = $this->db->prepare("DELETE broken_symptoms1, broken_symptoms FROM broken_symptoms1 INNER JOIN broken_symptoms ON broken_symptoms.id_broken = broken_symptoms1.id_es WHERE broken_symptoms.id_broken = :id_broken");
                                $stmt->execute(['id_broken' => $id]);
                                
                                // ตรวจสอบว่ามีการลบข้อมูลจริงหรือไม่
                                if($stmt->rowCount() > 0){
                                        return json_encode([
                                                'message' => 'ลบข้อมูลสำเร็จ',
                                                'status'  => 200,
                                                'success' => true,JSON_UNESCAPED_UNICODE
                                        ]);
                                }else{
                                        return json_encode([
                                                'message' => 'ไม่พบข้อมูลที่ต้องการลบ',
                                                'status'  => 400,
                                                'success' => false,JSON_UNESCAPED_UNICODE
                                        ]);
                                }
                        }catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function view_repair($id){
                        try{
                                $stmt = $this->db->prepare("SELECT * FROM broken_symptoms 
                                                        INNER JOIN broken_symptoms1 ON broken_symptoms.id_broken = broken_symptoms1.id_es
                                                        WHERE broken_symptoms.id_broken = :id_broken");
                                $stmt->execute(['id_broken' => $id] );
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                               if($stmt->rowCount() > 0){
                                        return json_encode($data,JSON_UNESCAPED_UNICODE);
                                        
                                }else{
                                        return json_encode([
                                                'message' => 'ไม่พบข้อมูลที่ต้องการ',
                                                'status'  => 400,
                                                'success' => false,JSON_UNESCAPED_UNICODE
                                        ]);
                                }
                        
                        }catch (PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                    
        }
?>