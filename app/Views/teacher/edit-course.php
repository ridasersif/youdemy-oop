<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Cours</title>
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
        .hidden {
            display: none;
        }
        option[selected] {
            background-color: #007bff;
            color: white;
        }
    </style>
    <script>
        // Fonction pour gérer l'affichage de l'input URL
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
    </script>
</head>
<body>
    <form action="/path/to/server-side-script.php" method="POST">
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
                <option value="1">Mathématiques</option>
                <option value="2">Informatique</option>
                <option value="3">Physique</option>
            </select>
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
            <select id="tags" name="tags[]" multiple>
                <option value="1">Tag 1</option>
                <option value="2">Tag 2</option>
                <option value="3">Tag 3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ordre">Ordre</label>
            <input type="number" id="ordre" name="ordre" placeholder="Ordre d'affichage" min="0" required>
        </div>

        <button type="submit" name="add_cours">Créer le Cours</button>
    </form>
</body>
</html>
