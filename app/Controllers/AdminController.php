<?php
require_once '../../config/database.php';
require_once '../Models/Administrateur.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = new Administrateur();

    $userId = intval($_POST['userId']);
    $action = $_POST['action'];
    $table = $_POST['table'];

        if ($action === 'activate') {
            $admin->updateUserStatus($userId, true);
        } elseif ($action === 'deactivate') {
            $admin->updateUserStatus($userId, false);
        } elseif ($action === 'delete') {
            $admin->deleteUser($userId);
        }
    if($table === 'etudiants'){
        header('Location: ../Views/admin/Etudiants.php'); 
        exit();
    }else{
        header('Location: ../Views/admin/Ensignants.php');
    }
   
}
?>
