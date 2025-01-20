<?php
session_start();
if ($_SESSION['user_role'] != 3){
    header('location: ../../../index.php');
}
echo "my cours ";
