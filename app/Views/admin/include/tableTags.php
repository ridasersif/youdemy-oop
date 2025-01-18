<?php
require_once '../../Controllers/TagsController.php';

$TagsController = new TagsController();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['add'])) {
        $TagsController->addTags($_POST['nom']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

 
    if (isset($_POST['update'])) {
        $TagsController->updateTags($_POST['id'], $_POST['nom']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

 
    if (isset($_POST['delete'])) {
        $TagsController->deleteTags($_POST['id']);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
$tags = $TagsController->getAllTags();
?>
    <form action="" method="POST" class="form-add-tag"  ">
        <label for="nom" class="label-add-tag">Ajouter un Tag:</label>
        <input name="nom" type="text" placeholder="Nom du Tag" class="input-add-tag" required>
        <button name="add" type="submit" class="button-add-tag">Ajouter</button>
    </form>
    <div class="div-table" style="margin:2%; ">
        <table class="tags-table">
            <thead class="table-head">
                <tr class="table-row">
                    <th class="table-header">ID</th>
                    <th class="table-header">Nom</th>
                    <th class="table-header">Action</th>
                </tr>
            </thead>
            <tbody class="table-body">
                <?php foreach ($tags as $tag): ?>
                    <tr class="table-row">
                        <td class="table-cell"><?php echo htmlspecialchars($tag['id']); ?></td>
                        <td class="table-cell">
                            <form action="" method="POST" class="form-update-tag">
                                <input type="hidden" name="id" value="<?php echo $tag['id']; ?>" class="hidden-input">
                                <input type="text" name="nom" value="<?php echo htmlspecialchars($tag['nom']); ?>" class="input-update-tag" required>
                                <button type="submit" name="update" class="button-update-tag">Modifie</button>
                            </form>
                        </td>
                        <td class="table-cell">
                            <form action="" method="POST" class="form-delete-tag">
                                <input type="hidden" name="id" value="<?php echo $tag['id']; ?>" class="hidden-input">
                                <button type="submit" name="delete" class="button-delete-tag">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>