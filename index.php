<!DOCTYPE html>

<html>
	<head>
		<!--  *****   Link To Custom CSS Style Sheet   *****  -->
		<link rel="stylesheet" type="text/css" href="public/Css/style.css?v=1.23">

		<!--  *****   Link To Font Awsome Icons   *****  -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

		<!--  *****   Link To Owl Carousel   *****  -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Bright Future</title>
	</head>
	<body>
		<!--   *** Website Container Starts ***   -->
		<div class="website-container">

			<!--   *** Home Section Starts ***   -->
			<section class="home" id="home">
				<!--   === Main Navbar Starts ===   -->
				<nav class="main-navbar">
					<a href="#logo" class="logo">
						<img alt="" src="public/images/logo.png">
					</a>
					<ul class="nav-list">
						<li><a href="#home">Home</a></li>
						<li><a href="#services">Services</a></li>
						<li><a href="#courses">Courses</a></li>
						<li><a href="#categories">Categories</a></li>
						<li><a href="#testimonials">Testimonials</a></li>
					</ul>
					<div>

						 <a href="app/Views/auth/register.php" class="">
							<button class="get-started-btn btn">Sign Up</button>
						</a> 

						<a href="app/Views/auth/login.php" class="">
							<button class="get-started-btn btn">Sign In</button>
						</a>

					</div>
					<div class="menu-btn">
						<span></span>
					</div>
				</nav>
				<!--   === Main Navbar Ends ===   -->
				<!--   === Banner Starts ===   -->
				<?php include 'banner.php' ?>
				<!--   === Banner Ends ===   -->
			</section>
			<!--   *** Home Section Ends ***   -->

			<!--   *** Partners Section Starts ***   -->
			<?php include 'partners.php' ?>
			<!--   *** Partners Section Ends ***   -->

			<!--   *** Services Section Starts ***   -->
			<section class="services" id="services">
				<!--   *** Services Header Starts ***   -->
				<header class="section-header">
					<h1>Why Choose Us</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				</header>
				<!--   *** Services Header Ends ***   -->
				<!--   *** Services Contents Starts ***   -->
				<div class="services-contents">

					<div class="service-box">
						<div class="service-icon">
							<i class="fa-solid fa-calendar"></i>
						</div>
						<div class="service-desc">
							<h2>Flexible Timing</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>

					<div class="service-box">
						<div class="service-icon">
							<i class="fa-solid fa-users"></i>
						</div>
						<div class="service-desc">
							<h2>Expert Teachers</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>

					<div class="service-box">
						<div class="service-icon">
							<i class="fa-solid fa-clock"></i>
						</div>
						<div class="service-desc">
							<h2>24/7 Live Support</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>

				</div>
				<!--   *** Services Contents Ends ***   -->
			</section>
			<!--   *** Services Section Ends ***   -->

			<!--   *** Courses Section Starts ***   -->
			<?php include 'courses.php'  ?>

			<!--   *** Courses Section Ends ***   -->

			<!--   *** Courses Categories Section Starts ***   -->
			<?php include 'categories.php' ?>
			<!--   *** Courses Categories Section Ends ***   -->

			<!--   *** Teacher Section Starts ***   -->
			<?php include 'instructor.php' ?>
			<!--   *** Teacher Section Ends ***   -->

			<!--   *** Testimonials Section Starts ***   -->
			<?php include 'testimonials.php' ?>
			<!--   *** Testimonials Section Ends ***   -->
			<!--   *** Footer Section Starts ***   -->
			   <?php  include 'footer.php'   ?>
			<!--   *** Footer Section Ends ***   -->

			
