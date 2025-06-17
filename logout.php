<?php
        session_start();

        unset($_SESSION['Username']);
        unset($_SESSION['User_status']);
        unset($_SESSION['id_user']);

        header('location: index');


?>