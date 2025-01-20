<?php
session_start();
if ($_SESSION['user_role'] != 2) {
    header('location: ../../../../index.php');
}
require_once '../../../Controllers/CoursController.php';
require_once '../../../Controllers/TagsController.php';
require_once '../../../Controllers/CategorieController.php';

if (isset($_GET['id'])) {
   
    $id = $_GET['id']; 
    $CoursController = new CourseController();
    $course = $CoursController->getCoursById($id); 

    if (!$course) {
        die("Cours introuvable !");
    } 
    $CoursController-> updateCourse();
}

$TagsController = new TagsController();
$tags = $TagsController->getAllTags();

$CategorieController = new CategorieController();
$categories = $CategorieController->getAllCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Cours</title>
</head>
<body>
    <form action="" method="POST">
        <a href="http://localhost/youdemy-oop/app/Views/teacher/coures.php" style="text-decoration: none; color: red;">X</a>
        <h2>Modifier un Cours</h2>

        <input type="hidden" name="id" value="<?php echo $course['id']; ?>">

        <div class="form-group">
            <label for="titre">Titre du Cours</label>
            <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($course['titre']); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($course['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select id="categorie" name="categorie_id" required>
                <option value="" disabled>Choisissez une catégorie</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id']; ?>" <?= $category['id'] == $course['categorie_id'] ? 'selected' : ''; ?>>
                        <?= $category['nom']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image de l'Interface</label>
            <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($course['phto_interface']); ?>" required>
        </div>

        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($course['price']); ?>" required>
        </div>

        <div id="url-group" class="form-group hidden">
            <label id="url-label" for="url">URL</label>
            <input type="url" id="url" name="url" value="<?php echo htmlspecialchars($course['url']); ?>">
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <select id="tags" onchange="handleTagSelection(event)">
                <option value="" disabled selected>Choisissez un tag</option>
                <?php foreach ($tags as $tag): ?>
                    <option value="<?= $tag['id']; ?>"><?= $tag['nom']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="tag-container" id="selected-tags">
                <?php if (!empty($course['tags'])): ?>
                    <?php foreach (explode(',', $course['tags']) as $tag): ?>
                        <?php $tagParts = explode(':', $tag); ?>
                        <div class="tag" id="tag-<?= $tagParts[0]; ?>">
                            <?= $tagParts[1]; ?> <span onclick="removeTag('<?= $tagParts[0]; ?>')">X</span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <input type="hidden" id="selected-tags-input" name="selected_tags" value="<?= isset($course['tag_ids']) ? htmlspecialchars($course['tag_ids']) : ''; ?>">

        </div>

        <button type="submit" name="update_cours">Modifier</button>
    </form>
    
    <script>
        function handleTagSelection(event) {
            const tagsContainer = document.getElementById('selected-tags');
            const selectedTagsInput = document.getElementById('selected-tags-input');
            const selectedTagId = event.target.value;
            const selectedTagText = event.target.options[event.target.selectedIndex].text;

            if (document.getElementById(`tag-${selectedTagId}`)) return;

            const tag = document.createElement('div');
            tag.className = 'tag';
            tag.id = `tag-${selectedTagId}`;
            tag.innerHTML = `${selectedTagText} <span onclick="removeTag('${selectedTagId}')">X</span>`;

            tagsContainer.appendChild(tag);

            let selectedTags = selectedTagsInput.value ? selectedTagsInput.value.split(',') : [];
            selectedTags.push(selectedTagId);
            selectedTagsInput.value = selectedTags.join(',');
        }

        function removeTag(tagId) {
            const tagElement = document.getElementById(`tag-${tagId}`);
            if (tagElement) {
                tagElement.remove();
            }

            const selectedTagsInput = document.getElementById('selected-tags-input');
            let selectedTags = selectedTagsInput.value ? selectedTagsInput.value.split(',') : [];
            selectedTags = selectedTags.filter(id => id !== tagId);
            selectedTagsInput.value = selectedTags.join(',');
        }
    </script>
</body>
</html>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
          
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        select[multiple] {
            height: 100px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .tag-container {
            margin-top: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .tag {
            display: flex;
            align-items: center;
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }
        .tag span {
            margin-left: 10px;
            cursor: pointer;
            background-color: #ff5e57;
            border-radius: 50%;
            padding: 0 5px;
        }
        .hidden {
            display: none;
        }
    </style>
   
</body>
</html>
