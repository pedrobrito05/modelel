<?php
    session_start();

    if(isset($_SESSION['unique_id'])){

        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        print_r( $_SESSION['unique_id']);
        echo $logout_id;
        if(isset($logout_id)){

            $status = "Offline";

            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id={$_GET['logout_id']}");

            if($sql){
                
                session_unset();
                session_destroy();
                header("location: https://esa.ib6.pt");
            }
        }else{
            header("location: index.php");
        }
    }else{  
        header("location: https://esa.ib6.pt");
    }
?>