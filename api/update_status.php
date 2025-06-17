<?php
header('Content-Type: application/json');
$input = file_get_contents("php://input");
$data  = json_decode($input, true);

include_once('../config/class.php');

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = trim($data['id']);

    if (empty($id)) {
        echo json_encode([
            'message' => 'ไม่มีค่าส่ง',
            'status' => 400,
            'success' => false
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $status = true;
    $web = new websystem();
    $result = $web->update_status($id, $status);
    // $fetch_data = $web->GetuserInfo($id);

    
    //     $token = 'aomvtgA4Fzu9iz3ZinSO9HaoZ7CExG0yFn8BQE5vj1Bg2Kz6dC48ltnm4pSPTY/4qov6TjQvrik+tf3tYtFW5bJ8c+i2CmFoIL/v1W8to/a5VIsCIk4PIpj3uqq9eFV16e9eEXHVi+cs30SuOzhq4wdB04t89/1O/w1cDnyilFU='; // เอาไปเก็บในไฟล์ config หรือ ENV
    //     $user_id = 'C6bb051f7dac5ce77c6fba8dc53091be0';
    //     $message = 'หมายเลข : '.$id.' ชื่อ : '.$fetch_data['firstname'].' '.$fetch_data['lastname'].' ได้ทำการซ่อมเสร็จเรียบร้อยแล้วครับ!!';

    //     $lineData = [
    //         'to' => $user_id,
    //         'messages' => [
    //             [
    //                 'type' => 'text',
    //                 'text' => $message
    //             ]
    //         ]
    //     ];

    //     $headers = [
    //         'Content-Type: application/json',
    //         'Authorization: Bearer ' .$token
    //     ];

    //     $ch = curl_init('https://api.line.me/v2/bot/message/push');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($lineData));
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     $response = curl_exec($ch);
    //     $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     if ($httpCode !== 200) {
    //         echo json_encode([
    //             'message' => 'ส่งข้อความไปยัง LINE Notify ไม่สำเร็จ',
    //             'status' => $httpCode,
    //             'success' => false
    //         ], JSON_UNESCAPED_UNICODE);
    //         exit;
    //     }
    //    else {
    //         echo json_encode([
    //             'message' => 'ส่งข้อความไปยัง LINE Notify สำเร็จ',
    //             'status' => 200,
    //             'success' => true
    //         ], JSON_UNESCAPED_UNICODE);
    //         exit;
    //     }
       
    
}
?>
