<?php
session_start();
if (!isset($_GET['id']) || !isset($_GET['type'])) {
    echo "Error: Missing parameters.";
    exit();
}
echo $_GET['type'];
echo $_GET['id'];

require_once '../../../../config/Database.php';
require '../../../Controllers/CoursController.php';
$cours = new CourseController();
$cours->deleteCours();
include '../../admin/course.php'
?>
