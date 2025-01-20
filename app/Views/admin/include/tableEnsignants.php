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