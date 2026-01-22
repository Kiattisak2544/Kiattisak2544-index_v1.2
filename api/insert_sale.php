<?php
header("Content-Type: application/json");

// ดึงข้อมูล JSON ที่ถูกส่งมาใน body ของ request
$input = file_get_contents("php://input");
$data = json_decode($input, true);



include_once('../config/class.php');

// ตรวจสอบว่า request method เป็น POST เท่านั้น
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // ตรวจสอบว่า $data เป็น array ที่ถูกต้องและไม่เป็น null
    if ($data === null || !is_array($data)) {
        echo json_encode([
            'status' => 400,
            'message' => 'ข้อมูลที่ส่งมาไม่ใช่ JSON ที่ถูกต้องหรือไม่พบข้อมูล',
            'success' => false
        ], JSON_UNESCAPED_UNICODE);
        exit();
    }

    // ดึงข้อมูลจาก $data
    $name = trim($data['name'] ?? '');
    $tel = trim($data['tel'] ?? '');
    $house_number = trim($data['house_number'] ?? '');
    $district = trim($data['district'] ?? '');
    $province = trim($data['province'] ?? '');
    $amphoe = trim($data['amphoe'] ?? '');
    $zipcode = trim($data['zipcode'] ?? '');
    $price = trim($data['price'] ?? '');
    $type_credit = isset($data['type_credit']) ? trim($data['type_credit']) : 0;
    $type_cash = isset($data['type_cash']) ? trim($data['type_cash']) : 0;
    $type_down = isset($data['type_down']) ? trim($data['type_down']) : 0;
    $deposit = trim($data['deposit'] ?? '');
    $sum = trim($data['sum'] ?? '');
    $date = trim($data['date'] ?? '');
    $time = trim($data['time'] ?? '');
    $name_sale = trim($data['name_sale']?? '');
    $comment = trim($data['comment'] ?? '');

    // ตรวจสอบข้อมูลที่ต้องมี
    if (empty($name) || empty($tel) || empty($house_number) || empty($district) || empty($amphoe) || empty($province) || empty($zipcode) || empty($price) || empty($deposit) || empty($date) || empty($time) && empty($sum) != '' ) {
        echo json_encode([
            'status' => 400,
            'message' => 'ข้อมูลไม่ครบถ้วน',
            'success' => false
        ], JSON_UNESCAPED_UNICODE);
    } else {
        $web = new websystem();
        $result = $web->insert_sale($name, $tel, $house_number, $district, $province, $amphoe, $zipcode, $price, $type_credit, $type_cash, $type_down, $deposit, $sum, $date, $time, $name_sale, $comment);
        
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode([
        'status' => 405,
        'message' => 'ไม่ได้รับอนุญาตให้ใช้ method นี้',
        'success' => false
    ], JSON_UNESCAPED_UNICODE);
}
?>