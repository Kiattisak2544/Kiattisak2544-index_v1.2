<?php
header('Content-Type: application/json');
$input = file_get_contents("php://input");
$data = json_decode($input, true);
include_once('../config/class.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($data['id']) && is_numeric($data['id'])) {
        $id = trim($data['id']);
        $web = new websystem();
        $result = $web->delete_repair($id);

        if ($result) {
            http_response_code(200); // OK
            echo json_encode([
                'message' => 'ลบข้อมูลเรียบร้อย',
                'status' => 200,
                'success' => true,
            ], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500); // Internal Server Error
            echo json_encode([
                'message' => 'ไม่สามารถลบข้อมูลได้',
                'status' => 500,
                'success' => false,
            ], JSON_UNESCAPED_UNICODE);
        }
    } else {
        http_response_code(400); // Bad Request
        echo json_encode([
            'message' => 'ID ไม่ถูกต้อง',
            'status' => 400,
            'success' => false,
        ], JSON_UNESCAPED_UNICODE);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode([
        'message' => 'Method ไม่ถูกต้อง',
        'status' => 405,
        'success' => false,
    ], JSON_UNESCAPED_UNICODE);
}
?>