<?php
session_start();
if ($_SESSION['user_role'] != 1 && $_SESSION['user_role'] != 2 ){
    header('location: ../../index.php');
}
$id=$_GET['id'];
$type=$_GET['type'];
if($type!='video'){
    require_once realpath(__DIR__ . '/../Models/PdfCourse.php');
    $Pdf = new PdfCourse();
    $Pdf->setId($id);
    $Pdf->showContone();
}else{
    require_once realpath(__DIR__ . '/../Models/VideoCourse.php');
    $video = new VideoCourse();
    $video->setId($id);
    $video->showContone();
    
}

?>        
   

<style>
   .iframePdf {
       width: 100%;
       height: 100%;
       border: none;
   }

   .dise {
       width: 30%;
       height: 91vh;
       background-color: #2c3e50;
       display: flex;
       flex-direction: column;
       align-items: flex-start;
       justify-content: space-between;
       padding: 10px;
       color: #ecf0f1;
       font-family: Arial, sans-serif;
   }

   .dise .info {
       display: flex;
       flex-direction: column;
       gap: 4px;
   }

   .dise .title {
       font-size: 1rem;
       font-weight: bold;
       color: #f39c12;
   }

   .dise .field {
       font-size: 1rem;
       color: #ecf0f1;
   }

   .dise .field span {
       font-weight: bold;
       color: #f1c40f;
   }

   .back-button {
       margin-top: 20px;
       text-decoration: none;
       color: #2c3e50;
       background-color: #f39c12;
       padding: 10px 15px;
       border-radius: 5px;
       font-weight: bold;
       text-align: center;
       display: inline-block;
       transition: 0.3s;
   }

   .back-button:hover {
       background-color: #d35400;
       color: #fff;
   }

   .video {
       width: 70%;
       height: 95vh;
       background-color: #16a085;
       display: flex;
       align-items: center;
       justify-content: center;
   }

   .videoContante {
       display: flex;
       height: 95vh;
       border: 1px solid #ccc;
   }
</style>

