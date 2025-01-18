<?php
require_once '../../Controllers/CategorieController.php';
if (!isset($_GET['id'])) {
    die("La catégorie n'est pas spécifiée !");
}

$id = $_GET['id']; 
$categorieController = new CategorieController();

$categories = $categorieController->getAllCategories();
$currentCategory = null;

foreach ($categories as $category) {
    if ($category['id'] == $id) {
        $currentCategory = $category;
        break;
    }
}

if (!$currentCategory) {
    die("La catégorie demandée n'existe pas !");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la catégorie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 24px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 120px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Modifier la catégorie</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($currentCategory['id']); ?>">
            
            <div>
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($currentCategory['nom']); ?>" required>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" required><?= htmlspecialchars($currentCategory['description']); ?></textarea>
            </div>

            <div>
                <label for="logo">Logo (lien)</label>
                <input type="text" id="logo" name="logo" value="<?= htmlspecialchars($currentCategory['logo']); ?>" required>
            </div>

            <button type="submit" name="update">Sauvegarder les modifications</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
            $nom = $_POST['nom'];
            $description = $_POST['description'];
            $logo = $_POST['logo'];

            $categorie = new Categorie($id, $nom, $description, $logo);
            $categorieController->updateCategorie($id, $nom, $description, $logo);
            header('location: ./Categorie.php');
            exit;
        }
        ?>
    </div>
</body>
</html>
