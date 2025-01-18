

<div class="details Ctegorie">
<div class="form-containe">
    <h2>hhhhhhhhhhhh</h2>
    <form action="" method="POST">
        <input name="nom" type="text" placeholder="Nom de catégorie" required>
        <textarea name="desc" placeholder="Description" required></textarea>
        
        <input name="logo" type="text" placeholder="URL du logo" required>
        <button class="addCategorie" type="submit" name="add">Ajouter</button>
    </form>
</div>
<div style="display: flex; flex-wrap: wrap; margin-top: 20px; justify-content: center; ">
    <?php foreach ($categories as $category): ?>
        <div class="recentOrders" style="margin: 10px; border: 1px solid #ccc; padding: 15px; width: 95%; background:#edfaf1">
            <div>
                <div class="category-icon">
                    <i class="fa-brands fa-facebook"></i>
                    </div>
                    <h4><?php echo htmlspecialchars($category['nom']); ?></h2>
                    <p><?php echo htmlspecialchars($category['description']); ?></p>
                    <form action="" method="POST" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                        <a href="./updateCategorie.php?id=<?= $category['id']; ?>">Modifie</a>
                        <button type="submit" name="delete" class="btn">Supprimer</button>
                    </form>

                 </div>
             </div>
    <?php endforeach; ?>
</div>
</div>