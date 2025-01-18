<?php 
session_start();
if ($_SESSION['user_role'] != 2){
    header('location: ../../../index.php');
}
require_once '../../../config/Database.php';
require '../../Controllers/CoursController.php';
$cours=new CourseController();
$cours->addCourse();
$cours=$cours->show();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../../../public/Css/styleDashboardAdmin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
    </div>
    <?php include './include/navigation.php' ?>
        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
           

            <!-- ======================= Cards ================== -->
        
          <?php include './course/tableCours.php' ?>


       
            <!-- ================ Order Details List ================= -->
<!-- CSS to style the buttons -->
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../../../public/Js/dashboarsAdmin.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>