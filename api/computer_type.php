<?php
    header("Content-Type: application/json");
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);
    include_once('../config/class.php');
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $fetch_data = new websystem();
        $result = $fetch_data->com_option();
        // Missing: echo json_encode($result);
        echo json_encode($result);
    }

    // Missing: exit();
?>
