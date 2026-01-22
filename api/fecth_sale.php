<?php
    include_once('../config/class.php');
    
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // รับค่า 'id' จากพารามิเตอร์ของ URL โดยใช้ $_GET
        $id = isset($_GET['data']) ? trim($_GET['data']) : '';

        if (empty($id)) {
            // ถ้าไม่พบค่า id ใน URL
            echo json_encode([
                "status" => 400,
                "message" => "ไม่พบข้อมูลที่ต้องการ",
                "success" => false
            ], JSON_UNESCAPED_UNICODE);
        } else {
            // ถ้ามีค่า id ให้เรียกใช้งาน class และ method เพื่อดึงข้อมูล
            $fetch_data = new websystem();
            $result = $fetch_data->fetch_saleData($id);

            if ($result) {
                // ถ้าดึงข้อมูลสำเร็จ
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
            } else {
                // ถ้าดึงข้อมูลไม่สำเร็จ หรือไม่พบข้อมูล
                echo json_encode([
                    "status" => 404,
                    "message" => "ไม่พบข้อมูลการขายสำหรับ ID นี้",
                    "success" => false
                ], JSON_UNESCAPED_UNICODE);
            }
        }
    } else {
        // ถ้า method ไม่ใช่ GET
        echo json_encode([
            "status" => 405,
            "message" => "Method ไม่ถูกต้อง",
            "success" => false
        ], JSON_UNESCAPED_UNICODE);
    }
?>