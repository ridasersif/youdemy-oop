<?php 
session_start();
// if ($_SESSION['user_role'] != 2){
//     header('location: ../../../index.php');
// }
require_once './config/Database.php';
require './app/Controllers/CoursController.php';
$cours=new CourseController();
$cours->addCourse();
$cours=$cours->show();
?>
<!DOCTYPE html>

<html>
	<?php include 'public/include/header.php' ?>
	<body>
		<!--   *** Website Container Starts ***   -->
		<div class="website-container">

			<!--   *** Home Section Starts ***   -->
			<section class="home" id="home">
				<!--   === Main Navbar Starts ===   -->
				<?php include 'public/include/navbar.php' ?>
				<!--   === Main Navbar Ends ===   -->
				<!--   === Banner Starts ===   -->
				<?php include 'public/include/banner.php' ?>
				<!--   === Banner Ends ===   -->
			</section>
			<!--   *** Home Section Ends ***   -->

			<!--   *** Partners Section Starts ***   -->
			<?php include 'public/include/partners.php' ?>
			<!--   *** Partners Section Ends ***   -->

			<!--   *** Services Section Starts ***   -->
			<?php include 'public/include/services.php' ?>
			<!--   *** Services Section Ends ***   -->

			<!--   *** Courses Section Starts ***   -->
			<?php include 'public/include/courses.php'  ?>
		
			<!--   *** Courses Section Ends ***   -->

			<!--   *** Courses Categories Section Starts ***   -->
			<?php include 'public/include/categories.php' ?>
			<!--   *** Courses Categories Section Ends ***   -->

			<!--   *** Teacher Section Starts ***   -->
			<?php include 'public/include/instructor.php' ?>
			<!--   *** Teacher Section Ends ***   -->

			<!--   *** Testimonials Section Starts ***   -->
			<?php include 'public/include/testimonials.php' ?>
			<!--   *** Testimonials Section Ends ***   -->
			<!--   *** Footer Section Starts ***   -->
			   <?php  include 'public/include/footer.php'   ?>
			<!--   *** Footer Section Ends ***   -->
        </div>
			
