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

    <?php if (isset($_SESSION['user_id'])): ?>
    <span class="welcome-message">
        Welcome, 
        <?php
        if ($_SESSION['user_role'] == 1) {
            echo 'Admin';
        } elseif ($_SESSION['user_role'] == 2) {
            echo 'Teacher';
        } elseif ($_SESSION['user_role'] == 3) {
            echo 'Student';
        } else {
            echo 'User';
        }
        ?>
    </span>
    <a href="app/Views/profile.php" class="profile-icon">
        <i class="fa fa-user"></i>
    </a>
<?php else: ?>
    <a href="app/Views/auth/register.php" class="">
        <button class="get-started-btn btn">Sign Up</button>
    </a>
    <a href="app/Views/auth/login.php" class="">
        <button class="get-started-btn btn">Sign In</button>
    </a>
<?php endif; ?>
    </div>
    <div class="menu-btn">
        <span></span>
    </div>
</nav>
