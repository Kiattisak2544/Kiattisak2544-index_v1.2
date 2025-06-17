<?php
        header("Content-Type:application/json");

        $input = file_get_contents("php://input");

        $data = json_decode($input, true);

        include_once('../config/class.php');

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            $seachdata = trim($data['search']);

            $fetch_data = new websystem();
            $reult = $fetch_data-> seachData($seachdata);
            
            
        }


?>