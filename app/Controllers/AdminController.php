<?php
require_once '../../config/database.php';
require_once '../Models/Administrateur.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = new Administrateur();

    $userId = intval($_POST['userId']);
    $action = $_POST['action'];

        if ($action === 'activate') {
            $admin->updateUserStatus($userId, true);
        } elseif ($action === 'deactivate') {
            $admin->updateUserStatus($userId, false);
        } elseif ($action === 'delete') {
            $admin->deleteUser($userId);
        }

    header('Location: ../Views/admin/dashboard.php'); 
    exit();
}
?>
