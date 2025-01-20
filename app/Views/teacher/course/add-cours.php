<?php
session_start();
if ($_SESSION['user_role'] != 2){
    header('location: ../../../../index.php');
}

require_once '../../../Controllers/TagsController.php';
require_once '../../../Controllers/CategorieController.php';
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
    <title>Créer un Cours</title>




</head>
<body>
<!-- ../../../Controllers/CoursController.php -->
    <form action="http://localhost/youdemy-oop/app/Views/teacher/coures.php" method="POST">
        <a href="http://localhost/youdemy-oop/app/Views/teacher/coures.php" style="  text-decoration: none;
            color: red;">X</a>
        <h2>Créer un Cours</h2>

        <div class="form-group">
            <label for="titre">Titre du Cours</label>
            <input type="text" id="titre" name="titre" placeholder="Entrez le titre du cours" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Description du cours" required></textarea>
        </div>

        <div class="form-group">
            <label for="categorie">Catégorie</label>
            <select id="categorie" name="categorie_id" required>
                <option value="" disabled selected>Choisissez une catégorie</option>
                <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id']; ?>"><?= $category['nom']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="titre">image de l'nterface</label>
            <input type="text" id="image" name="image" placeholder="Entrez image de l'nterface" required>
        </div>
        <div class="form-group">
            <label for="price">Prix</label>
            <input type="number" id="price" name="price" placeholder="Entrez le prix" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select id="type" name="type" onchange="handleTypeChange()" required>
                <option value="" disabled selected>Choisissez un type</option>
                <option value="video">Vidéo</option>
                <option value="pdf">PDF</option>
            </select>
        </div>

        <div id="url-group" class="form-group hidden">
            <label id="url-label" for="url">URL</label>
            <input type="url" id="url" name="url" placeholder="Entrez l'URL">
        </div>

        <div class="form-group">
            <label for="tags">Tags</label>
            <select id="tags" onchange="handleTagSelection(event)">
                <option value="" disabled selected>Choisissez un tag</option>
                <?php foreach ($tags as $tag): ?>
                <option value="<?= $tag['id']; ?>"><?= $tag['nom']; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="tag-container" id="selected-tags"></div>
            <input type="hidden" id="selected-tags-input" name="selected_tags" value="">
        </div>

        <button type="submit" name="add_cours">Créer le Cours</button>
    </form>

    
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

    <script>
        function handleTypeChange() {
            const type = document.getElementById('type').value;
            const urlGroup = document.getElementById('url-group');
            const urlInput = document.getElementById('url');
            const urlLabel = document.getElementById('url-label');

            if (type === 'video' || type === 'pdf') {
                urlGroup.classList.remove('hidden');
                urlLabel.textContent = type === 'video' 
                    ? "Lien vers la vidéo (ex : YouTube, Vimeo)" 
                    : "Lien vers le document PDF";
                urlInput.placeholder = type === 'video' 
                    ? "Entrez le lien de la vidéo" 
                    : "Entrez le lien du PDF";
            } else {
                urlGroup.classList.add('hidden');
                urlInput.value = "";
            }
        }

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
