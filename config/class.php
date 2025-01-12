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
                        $stmt = $this->db->prepare("SELECT id_user,Username,Password_repair,User_status FROM `login_user`  WHERE Username = :username ");
                        $stmt->execute(['username'=>$username]);
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($user) {
                                if(password_verify($password, $user['Password_repair'])){
                                        $_SESSION['id_user'] = $user['id_user'];
                                        $_SESSION['Username'] = $user['Username'];
                                        $_SESSION['User_status'] = $user['User_status'];

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
                public function data_repair(){
                        try{
                                $stmt = $this->db->prepare("SELECT broken_symptoms.id_broken,broken_symptoms.firstname,broken_symptoms.lastname,broken_symptoms.telephone,broken_symptoms.status,broken_symptoms.mainternace_detail,broken_symptoms1.date
                                                                FROM broken_symptoms INNER JOIN broken_symptoms1 on broken_symptoms.id_broken = broken_symptoms1.id_es ");
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
                
        }
?>