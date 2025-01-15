<?php 
session_start();
if ($_SESSION['user_role'] != 1){
    header('location: ../../../index.php');
}

require_once '../../../config/Database.php';
require_once '../../Models/Administrateur.php';

$admin = new Administrateur();
$users = $admin->getAllUsers();
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
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                           <img src="" alt=",,,,">
                        </span>
                        <span class="title">SERSIF</span>
                       
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Etudiants</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Ensignants</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li> 
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>

                <li>
                    <a href="../../../index.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

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
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Daily Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">80</div>
                        <div class="cardName">Sales</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">284</div>
                        <div class="cardName">Comments</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">$7,842</div>
                        <div class="cardName">Earning</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>
            <!-- ================ Order Details List ================= -->
            <div class="details Ensignants">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Ensignants</h2>
            <a href="#" class="btn">View All</a>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <?php if ($user['role_id'] == 1): ?> 
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['nom']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['role_id'] == 1 ? 'Enseignant' : 'Etudiant') ?></td>
                        <td><?= $user['estActif'] ? 'Actif' : 'Inactif' ?></td>
                        <td>
                            <form action="../../Controllers/AdminController.php" method="POST" style="display: inline;">
                                <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                <input type="hidden" name="action" value="<?= $user['estActif'] ? 'deactivate' : 'activate' ?>">
                                <button type="submit" class="action-btn <?= $user['estActif'] ? 'deactivate' : 'activate' ?>">
                                    <?= $user['estActif'] ? 'Désactiver' : 'Activer' ?>
                                </button>
                            </form>
                            <form action="../../Controllers/AdminController.php" method="POST" style="display: inline;">
                                <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="details Etudiants">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Etudiants</h2>
            <a href="#" class="btn">View All</a>
        </div>
        <table>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Role</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <?php if ($user['role_id'] == 2): ?> 
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['nom']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['role_id'] == 2 ? 'Etudiant' : 'Enseignant') ?></td>
                        <td><?= $user['estActif'] ? 'Actif' : 'Inactif' ?></td>
                        <td>
                            <form action="../../Controllers/AdminController.php" method="POST" style="display: inline;">
                                <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                <input type="hidden" name="action" value="<?= $user['estActif'] ? 'deactivate' : 'activate' ?>">
                                <button type="submit" class="action-btn <?= $user['estActif'] ? 'deactivate' : 'activate' ?>">
                                    <?= $user['estActif'] ? 'Désactiver' : 'Activer' ?>
                                </button>
                            </form>
                            <form action="../../Controllers/AdminController.php" method="POST" style="display: inline;">
                                <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- CSS to style the buttons -->
<style>
   
</style>

        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../../../public/Js/dashboarsAdmin.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>