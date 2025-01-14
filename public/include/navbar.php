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

        <?php if (isset($_SESSION['user_id'])): ?>
            <?php
            if ($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2) {
                echo '<li><a href="';
                echo ($_SESSION['user_role'] == 1) ? 'app/Views/admin/dashboard.php' : 'app/Views/teacher/dashboard.php';
                echo '">Dashboard</a></li>';
            }
            ?>
        <?php endif; ?>

    </ul>
    <div class="menu-btn">
        <span></span>
    </div>
    <div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <span class="welcome-message">
                <button class="profile-icon" onclick="toggleProfilePopup()">
                    <i class="fa fa-user"></i>
                </button>
                <div id="profile-popup" class="profile-popup">
                    <!-- Close button for the popup -->
                    <button class="close-btn" onclick="toggleProfilePopup()">×</button>
                    <p><strong>Nom:</strong> <?php echo $_SESSION['user_nom']; ?></p>
                    <p><strong>Email:</strong> <?php echo $_SESSION['user_email']; ?></p>
                    <p><strong>Role:</strong> 
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
                    </p>
                    <a href="app/Views/profile/update.php" class="update-profile-btn">Update Profile</a>
                    <a href="./app/Controllers/AuthController.php?logou=logou" class="logout-btn">Logout</a>
                </div>
            </span>
        <?php else: ?>
            <a href="app/Views/auth/register.php">
                <button class="get-started-btn btn">Sign Up</button>
            </a>
            <a href="app/Views/auth/login.php">
                <button class="get-started-btn btn">Sign In</button>
            </a>
        <?php endif; ?>
    </div>
</nav>