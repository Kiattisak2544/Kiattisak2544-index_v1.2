<?php
        include_once('../config/class.php');
       
        header("Content-Type:application/json");
        $input = file_get_contents("php://input");
        $data = json_decode($input, true);

        if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
            $fetch_data = new websystem();
            $reult = $fetch_data-> data_sale();
            
            echo ($reult);
            
        }


?>