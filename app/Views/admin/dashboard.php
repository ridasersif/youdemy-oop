<?php 
session_start();
if ($_SESSION['user_role'] == 1){
    echo "admin";
}else{
    header('location: ../../../index.php');
}




?>