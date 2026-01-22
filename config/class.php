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
                                                'success' => true,
                                                'User_status' => $user['User_status']
                                       ]);

                                }else {
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
                                // $stmt = $this->db->prepare("SELECT broken_symptoms.id_broken,broken_symptoms.firstname,broken_symptoms.lastname,broken_symptoms.telephone,broken_symptoms.status,broken_symptoms.mainternace_detail,broken_symptoms1.date
                                //                                 FROM broken_symptoms INNER JOIN broken_symptoms1 on broken_symptoms.id_broken = broken_symptoms1.id_es ORDER BY broken_symptoms.id_broken DESC ");
                                $stmt = $this->db->prepare("SELECT tb_customer.id_customer,tb_customer.member_code,tb_customer.first_customer,tb_customer.last_customer,tb_customer.tel_customer,tb_customer.email_customer,
                                                                   tb_customer.amphoe_customer,tb_customer.province_customer,tb_customer.zipcode_customer,tb_customer.date_customer,broken_symptoms1.member_code,broken_symptoms1.detail
                                                            FROM tb_customer INNER JOIN broken_symptoms1 on  broken_symptoms1.member_code = tb_customer.member_code ORDER BY tb_customer.id_customer DESC
                                                        ");
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
                                 $stmt = $this->db->prepare("SELECT 
                                                                tb_customer.id_customer,tb_customer.first_customer,tb_customer.last_customer,tb_customer.tel_customer,broken_symptoms1.id_es,
                                                                broken_symptoms1.status,broken_symptoms1.mainternace_detail,broken_symptoms1.date,broken_symptoms1.technician
                                                        FROM tb_customer 
                                                        INNER JOIN broken_symptoms1 
                                                        on tb_customer.member_code = broken_symptoms1.member_code
                                                        WHERE broken_symptoms1.status = :status
                                                        ORDER BY broken_symptoms1.id_es DESC");
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
                                $stmt = $this->db->prepare("SELECT tb_customer.id_customer,tb_customer.first_customer,tb_customer.last_customer,
                                                                   tb_customer.tel_customer,broken_symptoms1.id_es,broken_symptoms1.status,
                                                                   broken_symptoms1.mainternace_detail,broken_symptoms1.date,broken_symptoms1.technician
                                                        FROM tb_customer INNER JOIN broken_symptoms1 on tb_customer.member_code = broken_symptoms1.member_code
                                                        WHERE broken_symptoms1.status = :status
                                                        ORDER BY broken_symptoms1.id_es DESC");

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
                public function data_option(){
                        try{
                                $stmt = $this->db->prepare("SELECT * FROM service_rates ORDER BY Service_id ASC");
                                $stmt->execute();
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                return $data;

                        }catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function com_option(){
                        try{
                                $stmt = $this->db->prepare("SELECT * FROM computer_type ORDER BY id_type ASC");
                                $stmt->execute();
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                return $data;
                        } catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
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
                                $stmt = $this->db->prepare("SELECT COUNT(*) FROM `broken_symptoms1` WHERE id_es");
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
                                $stmt = $this->db->prepare("SELECT COUNT(*) FROM `broken_symptoms1` WHERE status = 1");
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
                                $stmt = $this->db->prepare("SELECT COUNT(*) FROM `broken_symptoms1` WHERE status = 0");
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
        public function system_repair($member_code, $es1, $es2, $es3, $es4, $es5, $es6, $es7, $es8, $es9,$es10, $es11, $es12, $es13, $es14, $es15, $other1, $product_condition,
                                                $detail, $Important, $Computer_type, $maintenance_type, $service,
                                                $technician, $status, $mainternace_detail){
    try {
        $stmt = $this->db->prepare("
            INSERT INTO `broken_symptoms1`
            (`member_code`, `es1`, `es2`, `es3`, `es4`, `es5`, `es6`, `es7`, `es8`, `es9`,
             `es10`, `es11`, `es12`, `es13`, `es14`, `es15`, `other1`, `product_condition`,
             `detail`, `Important`, `Computer_type`, `maintenance_type`, `Service_rate`,
             `technician`, `date`, `status`, `mainternace_detail`)
            VALUES 
            (:member_code, :es1, :es2, :es3, :es4, :es5, :es6, :es7, :es8, :es9,
             :es10, :es11, :es12, :es13, :es14, :es15, :other1, :product_condition,
             :detail, :Important, :Computer_type, :maintenance_type, :Service_rate,
             :technician, NOW(), :status, :mainternace_detail)
        ");

        $stmt->execute([
            'member_code' => $member_code,
            'es1' => $es1, 'es2' => $es2, 'es3' => $es3, 'es4' => $es4,
            'es5' => $es5, 'es6' => $es6, 'es7' => $es7, 'es8' => $es8,
            'es9' => $es9, 'es10' => $es10, 'es11' => $es11, 'es12' => $es12,
            'es13' => $es13, 'es14' => $es14, 'es15' => $es15,
            'other1' => $other1, 'product_condition' => $product_condition,
            'detail' => $detail, 'Important' => $Important,
            'Computer_type' => $Computer_type, 'maintenance_type' => $maintenance_type,
            'Service_rate' => $service, 'technician' => $technician,
            'status' => $status, 'mainternace_detail' => $mainternace_detail
        ]);

        if($stmt->rowCount() > 0){
                echo json_encode([
                        'message' => 'บันทึกข้อมูลสำเร็จ',
                        'status'  => 200,
                        'success' => true,
                ]);
        }else{
                echo json_encode([
                        'message' => 'มีข้อผิดพลาด',
                        'status' => 400,
                        'success' => false
                ]);
        }

        return [
            'message' => 'บันทึกข้อมูลสำเร็จ',
            'status' => 200,
            'success' => true
        ];

    } catch (PDOException $e) {
        return [
            'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
            'status' => 500,
            'success' => false,
            'error' => $e->getMessage() // แนะนำให้ปิด error นี้บน production
        ];
    }
}

                public function Chart_js(){
                        try{
                                $stmt = $this->db->prepare("SELECT
                                                YEAR(broken_symptoms1.date) AS repair_year,
                                                MONTH(broken_symptoms1.date) AS repair_month,
                                                COUNT(*) AS total_repairs
                                                FROM broken_symptoms1
                                                WHERE broken_symptoms1.status = 1 AND YEAR(broken_symptoms1.date)
                                                GROUP BY
                                                        repair_year,
                                                        repair_month
                                                ORDER BY
                                                        repair_year,
                                                        repair_month
                                                                ");
                                $stmt->execute();
                                
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                if($stmt->rowCount() > 0){
                                        return json_encode([
                                                'message' => 'แสดงข้อมูลกราฟสำเร็จ',
                                                'status'  => 200,
                                                'success' => true,
                                                'data'    => $data
                                            ], JSON_UNESCAPED_UNICODE);
                                }
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
                                 
                               /** */ $stmt = $this->db->prepare("SELECT 
                                                                ct.Computer_type, COALESCE(subquery.total_count, 0) AS total_count
                                                             FROM
                                                                (SELECT 'computer_out' AS Computer_type UNION SELECT 'computer_in-jib') AS ct LEFT JOIN
                                                                        (
                                                                                SELECT
                                                                                        broken_symptoms1.Computer_type,
                                                                                        COUNT(*) AS total_count
                                                                                        FROM broken_symptoms1
                                                                                        WHERE broken_symptoms1.status = '1' AND 
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
                                $stmt = $this->db->prepare("SELECT broken_symptoms1.Computer_type,COUNT(*) AS Com_Count
                                FROM broken_symptoms1 WHERE broken_symptoms1.status = '1' AND broken_symptoms1.Computer_type IN ('computer_out','computer_in-jib') GROUP BY
                                broken_symptoms1.Computer_type ");
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
                                $stmt = $this->db->prepare("DELETE  FROM broken_symptoms1  WHERE id_es = :id_broken");
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
                                $stmt = $this->db->prepare("SELECT 
                                                                broken_symptoms1.*, 
                                                                tb_customer.member_code,
                                                                tb_customer.first_customer,
                                                                tb_customer.last_customer,
                                                                tb_customer.tel_customer,
                                                                tb_customer.district_customer,
                                                                tb_customer.amphoe_customer,
                                                                tb_customer.province_customer,
                                                                tb_customer.zipcode_customer
                                                        FROM broken_symptoms1
                                                        INNER JOIN tb_customer 
                                                        ON tb_customer.member_code = broken_symptoms1.member_code
                                                        WHERE broken_symptoms1.id_es = :id");

                                $stmt->execute(['id' => $id] );
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

                public function insert_sale($name, $tel, $house_number, $district, $province, $amphoe, $zipcode, $price, $type_credit, $type_cash, $type_down, $deposit, $sum, $date, $time, $name_sale, $comment) {
                        try {
                                        // แก้ไข: ลบเครื่องหมายอัญประกาศออกจาก Named Parameters
                                        // แก้ไข: เพิ่ม 'email' และ 'amphoe' ในคิวรีให้ครบถ้วนตามข้อมูลที่รับมา
                                        $stmt = $this->db->prepare("INSERT INTO `tb_deposit`(`fullname_cus`, `telphon_cus`, `house_number`, `district`, `amphoe`, `province`, `zipcode`, `price_total`, `type_credit`, `type_cash`, `type_down`, `deposit_price`, `deposit_total`, `date_deposit`, `time_deponsit` , `name_sale` , `comment_sale`) 
                                                        VALUES (:fname, :tel, :house_number, :district, :amphoe, :province, :zipcode, :price_total, :type_credit, :type_cash, :type_down, :deposit_price, :deposit_total, :date_deposit, :time_deponsit ,:name_sale, :comment)");

                                        // สมมติว่าใน Form มีการส่ง 'amphoe' มาด้วย
                                        // ถ้า Form ไม่มี ให้รับค่า 'amphoe' เป็น string ว่าง
                                       

                                $stmt->execute([
                                        'fname' => $name,
                                        'tel' => $tel,
                                        'house_number' => $house_number,
                                        'district' => $district,
                                        'amphoe' => $amphoe, // แก้ไขให้ใช้ตัวแปร 'amphoe' ที่ถูกต้อง
                                        'province' => $province,
                                        'zipcode' => $zipcode,
                                        'price_total' => $price,
                                        'type_credit' => $type_credit,
                                        'type_cash' => $type_cash,
                                        'type_down' => $type_down,
                                        'deposit_price' => $deposit,
                                        'deposit_total' => $sum,
                                        'date_deposit' => $date,
                                        'time_deponsit' => $time,
                                        'name_sale' => $name_sale,
                                        'comment' => $comment
                                ]);

                                // ตรวจสอบว่ามีการเพิ่มข้อมูลจริงหรือไม่
                                $result = $stmt->rowCount();

                                if($result > 0){
                                                echo json_encode([
                                                        'message' => 'บันทึกข้อมูลสำเร็จ',
                                                        'status'  => 200,
                                                        'success' => true,
                                                ], JSON_UNESCAPED_UNICODE);
                                        exit;
                                }

                                
        
                        } catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function data_sale() {
                        try {
                                $stmt = $this->db->prepare("SELECT * FROM `tb_deposit` ORDER BY id_deposit DESC");
                                $stmt->execute();
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);      
                                if($stmt->rowCount() > 0){
                                        echo json_encode([
                                                'message' => 'ดึงข้อมูลสำเร็จ',
                                                'status'  => 200,
                                                'success' => true,
                                                'data'    => $data,
                                                
                                        ], JSON_UNESCAPED_UNICODE);
                                        exit;
                                        
                                
                                }else{
                                        return json_encode([
                                                'message' => 'ไม่พบข้อมูลที่ต้องการ',
                                                'status'  => 404,
                                                'success' => false
                                        ], JSON_UNESCAPED_UNICODE);
                                }
                        } catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function fetch_saleData($id) {
                        try {
                                $stmt = $this->db->prepare("SELECT * FROM `tb_deposit`  WHERE id_deposit  = :id");
                                $stmt->execute(['id' => $id]);
                                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                                    if($stmt->rowCount() > 0){
                                        echo json_encode([
                                                'message' => 'ดึงข้อมูลสำเร็จ',
                                                'status'  => 200,
                                                'success' => true,
                                                'data'    => $data
                                        ], JSON_UNESCAPED_UNICODE);
                                        exit;
                                    }else{
                                        echo json_encode([
                                                'message' => 'ไม่พบข้อมูลที่ต้องการ',
                                                'status'  => 404,
                                                'success' => false
                                        ], JSON_UNESCAPED_UNICODE);
                                    }
                        }catch(PDOException $e) {
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ], JSON_UNESCAPED_UNICODE);
                        }
                }
                public function Del_Depositsale($id){
                        try{
                                $stmt = $this->db->prepare("DELETE FROM `tb_deposit` WHERE `id_deposit` = :id");
                                $stmt->execute(['id' => $id]);
                                
                                // ตรวจสอบว่ามีการลบข้อมูลจริงหรือไม่
                                if($stmt->rowCount() > 0){
                                        return json_encode([
                                                'message' => 'ลบข้อมูลสำเร็จ',
                                                'status'  => 200,
                                                'success' => true
                                        ], JSON_UNESCAPED_UNICODE);
                                }
                                return json_encode([
                                        'message' => 'ไม่พบข้อมูลที่ต้องการลบ',
                                        'status'  => 404,
                                        'success' => false
                                ], JSON_UNESCAPED_UNICODE);
                        }catch(PDOException $e){
                                echo json_encode ([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }
                public function gencode(){
                       try{
                                $today = date('Ymd'); // วันที่ปัจจุบันในรูปแบบ Ymd
                                 $stmt = $this->db->prepare("SELECT * FROM `tb_customer` ORDER BY id_customer DESC LIMIT 1");
                                 $stmt->execute();
                                 $row = $stmt->fetch(PDO::FETCH_ASSOC);

                                 $member_code = $row['member_code'] ?? null; // ใช้ null coalescing operator เพื่อตรวจสอบว่ามี member_code หรือไม่
                                 

                        if($row && isset($member_code)){
                                $last = explode('-', $member_code);
                                // $last_date = $last[1];
                                $seq = (int)$last[2]; //int แปลงค่าในตำแหน่งที่2 เป็นตัวเลข
                                $seq++; // เพิ่มค่าลำดับเสมอ

                        }else{
                                $seq = 1;
                        }
                                $newCode = "MT-$today-" . str_pad($seq, 3, "0", STR_PAD_LEFT); // สร้างรหัสสมาชิกใหม
                                return $newCode;
                                

                       }catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ]);
                        }
                }

                public function insert_customer($member_code, $first_customer, $last_customer, $tel_customer, $email_customer, $district, $amphoe, $province, $zipcode){
                        try{
                                $stmt = $this->db->prepare("INSERT INTO tb_customer (member_code, first_customer, last_customer, tel_customer, email_customer,
                                                        district_customer, amphoe_customer,province_customer, zipcode_customer) VALUES (:member_code, :first_customer, :last_customer,
                                                        :tel_customer, :email_customer, :district_customer, :amphoe_customer, :province_customer , :zipcode_customer)");

                               

                                $stmt->execute([
                                        'member_code' => $member_code,
                                        'first_customer' => $first_customer,
                                        'last_customer' => $last_customer,
                                        'tel_customer' => $tel_customer,
                                        'email_customer' => $email_customer,
                                        'district_customer' => $district,
                                        'amphoe_customer' => $amphoe,
                                        'province_customer' => $province,
                                        'zipcode_customer' => $zipcode
                                ]);
                                
                                if($stmt->rowCount() > 0){
                                        return json_encode([
                                                'message' => 'บันทึกข้อมูลสำเร็จ',
                                                'status'  => 200,
                                                'success' => true,
                                                'member_code' => $member_code
                                        ], JSON_UNESCAPED_UNICODE);
                                }else{
                                        return json_encode([
                                                'message' => 'บันทึกข้อมูลไม่สำเร็จ',
                                                'status'  => 400,
                                                'success' => false
                                        ], JSON_UNESCAPED_UNICODE);
                                }

                               

                        }catch(PDOException $e){
                                echo json_encode([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false
                                ], JSON_UNESCAPED_UNICODE);
                        }
                }

               public function auto_customer($telnumber){
                                try {
                                        $stmt = $this->db->prepare("SELECT * FROM `tb_customer` WHERE `tel_customer` = :telnumber");
                                        $stmt->execute(['telnumber' => $telnumber]);
                                        $data = $stmt->fetch(PDO::FETCH_ASSOC);

                                                if ($stmt->rowCount() > 0) {
                                                                return [
                                                                        'message' => 'ค้นหาข้อมูลสำเร็จ',
                                                                        'status'  => 200,
                                                                        'success' => true,
                                                                        'data'    => $data
                                                                ];
                                                } else {
                                                                return [
                                                                        'message' => 'ไม่พบข้อมูลที่ต้องการ',
                                                                        'status'  => 404,
                                                                        'success' => false
                                                                ];
                                                        }

                                } catch (PDOException $e) {
                                        return [
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' => false,
                                        'error'   => $e->getMessage() // สำหรับ debug ถ้าจำเป็น
                                        ];
                                }
                }

                // check telphone number for regis_customer
               public function check_Telcustomer($telnumber){
                                try {
                                         $stmt = $this->db->prepare("SELECT `id_customer`,`first_customer`,`tel_customer`
                                                                        FROM `tb_customer` 
                                                                        WHERE `tel_customer` = :telnumber");         

                                        $stmt->execute(['telnumber' => $telnumber]);

                                        

                                if ($stmt->rowCount() > 0) {
                                        return [
                                                'message' => 'มีข้อมูลแล้ว',
                                                'status' => 400,
                                                'success' => false
                                        ];
                                        
                                } else {
                                          return [
                                                'message' => 'เบอร์โทรใช้งานได้ ',
                                                'status' => 200,
                                                'success' => true
                                        ];
                                        }
                                } catch (PDOException $e) {
                                                return [
                                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                                        'status'  => 500,
                                                        'success' => false,
                                                        'error'   => $e->getMessage()
                                                ];
                                }
                }

                

                public function fect_data_customer($data){
                        try{
                               $stmt = $this->db->prepare("SELECT * FROM `tb_customer` WHERE `first_customer` = :datas LIMIT 1");

                                $stmt->execute(["datas" => $data]);

                                // ดึงข้อมูลลูกค้า 1 แถว
                                $customer_data = $stmt->fetch(PDO::FETCH_ASSOC);

                                // ตรวจสอบว่าพบข้อมูลหรือไม่
                                        return json_encode([
                                                'message' => 'ชื่อสมาชิกนี้ใช้งานได้✅',
                                                'status'  => 200, // 404 Not Found
                                                'success' => true,
                                                'data' => $customer_data
                                        ], JSON_UNESCAPED_UNICODE);
                                


                        }catch(PDOException $e){
                                return ([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' =>fasle
                                ]);
                        }
                }

                 public function fecth_dataLogin (){
                               try{
                               $stmt = $this->db->prepare("SELECT * FROM `login_user`  ");
                                $stmt -> execute();

                               $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                               if($stmt->rowCount() > 0){
                                       return json_encode([
                                         'message' => 'พบข้อมูล',
                                        'status'  => 200,
                                        'success' => true,
                                        'data' => $data
                                       ]);
                        
                                        
                                }else{
                                        return json_encode([
                                                'message' => 'ไม่พบข้อมูลที่ต้องการ',
                                                'status'  => 400,
                                                'success' => false,JSON_UNESCAPED_UNICODE
                                        ]);
                                }
                              
                               }catch(PDOException $e){
                                        return ([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' =>fasle
                                ]);
                               }

                }

                public function fecth_Login($id){
                         try{
                               $stmt = $this->db->prepare("SELECT * FROM `login_user` WHERE id_user = :id  ");
                                $stmt -> execute(['id' => $id]);

                               $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                               if($stmt->rowCount() > 0){
                                       return json_encode([
                                         'message' => 'พบข้อมูล',
                                        'status'  => 200,
                                        'success' => true,
                                        'data' => $data
                                       ]);
                        
                                        
                                }else{
                                        return json_encode([
                                                'message' => 'ไม่พบข้อมูลที่ต้องการ',
                                                'status'  => 400,
                                                'success' => false,JSON_UNESCAPED_UNICODE
                                        ]);
                                }
                              
                               }catch(PDOException $e){
                                        return ([
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' =>fasle
                                ]);
                               }
                }

                
              public function update_status($id, $status) {
                                try {
                                        // ✅ อัปเดตสถานะ
                                        $stmt = $this->db->prepare("UPDATE broken_symptoms1 SET status = :status WHERE id_es = :id_es");
                                        $result = $stmt->execute([
                                                                  'id_es' => $id,
                                                                   'status' => $status
                                                                ]);

                                        if ($result && $stmt->rowCount() > 0) {

                                                // ✅ ดึง member_code ของรายการที่อัปเดต
                                                $select_member = $this->db->prepare("SELECT member_code FROM broken_symptoms1 WHERE id_es = :id_es");
                                                $select_member->execute(['id_es' => $id]);
                                                $data_member = $select_member->fetch(PDO::FETCH_ASSOC);

                                                if ($data_member) {
                                                        // ✅ ใช้ member_code ไปค้นหาข้อมูลลูกค้า
                                                        $select = $this->db->prepare("SELECT * FROM tb_customer WHERE member_code = :member_code");
                                                        $select->execute(['member_code' => $data_member['member_code']]);
                                                        $row = $select->fetch(PDO::FETCH_ASSOC);

                                                        if ($row) {
                                                                echo json_encode([
                                                                        'message' => 'อัปเดตสถานะการซ่อมสำเร็จ ✅',
                                                                        'status' => 200,
                                                                        'success' => true,
                                                                        'data' => [
                                                                        'id_es' => $id,
                                                                        'member_code' => $data_member['member_code'],
                                                                        'customer_name' => $row['first_customer'] . ' ' . $row['last_customer']
                                                                ]
                                                        ], JSON_UNESCAPED_UNICODE);
                                                } else {
                                                        echo json_encode([
                                                                        'message' => 'ไม่พบข้อมูลลูกค้าใน tb_customer ❌',
                                                                        'status' => 404,
                                                                        'success' => false
                                                        ], JSON_UNESCAPED_UNICODE);
                                                }
                                        } else {
                                                echo json_encode([
                                                        'message' => 'ไม่พบ member_code สำหรับ id_es ที่ระบุ ❌',
                                                        'status' => 404,
                                                        'success' => false
                                                ], JSON_UNESCAPED_UNICODE);
                                        }

                                } else {
                                        echo json_encode([
                                                'message' => 'อัปเดตสถานะการซ่อมไม่สำเร็จ ❌',
                                                'status' => 400,
                                                'success' => false
                                        ], JSON_UNESCAPED_UNICODE);
                                }

                        } catch (PDOException $e) {
                                        echo json_encode([
                                                'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์ ❌',
                                                'error' => $e->getMessage(),
                                                'status' => 500,
                                                'success' => false
                                        ], JSON_UNESCAPED_UNICODE);
                        }
                }

                public function update_user($id_user,$User_status){
                        try{
                                $stmt = $this->db->prepare("UPDATE login_user SET User_status = :User_status WHERE id_user =:id_user");
                                $stmt->execute(['id_user' => $id_user, 'User_status' => $User_status]);

                                if($stmt->rowCount() > 0){
                                        echo json_encode([
                                                'message' => 'อัปเดตสถานะผู้ใช้สำเร็จ✅',
                                                'status' => 200,
                                                'success' => true 
                                        ],JSON_UNESCAPED_UNICODE);
                                }else{
                                        echo json_encode([
                                                'message' => 'อัปเดตสถานะผู้ใช้ไม่สำเร็จ❌',
                                                'status' => 400,
                                                'success' => false 
                                        ],JSON_UNESCAPED_UNICODE);
                                }

                        }catch(PDOException $e){
                                return [
                                        'message' => 'เกิดข้อผิดพลาดของเซิร์ฟเวอร์',
                                        'status'  => 500,
                                        'success' =>false
                                ];
                        }
                }
    
                    
        }

     

?>