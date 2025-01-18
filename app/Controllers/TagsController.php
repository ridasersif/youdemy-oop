<?php
require_once realpath(__DIR__ . '/../../') . '\config\Database.php';
require_once realpath(__DIR__ . '/../../') . '\app\Models\managTags';

class TagsController {
    private $manager;

    public function __construct() {
        $this->manager = new ManagerTags();
    }

    public function getAllTags() {
        return $this->manager->getAllTags();
    }

    public function addTags($nom) {
        $Tags = new Tags(null, $nom);
        $this->manager->insertTags($Tags);
    }

    public function updateTags($id, $nom) {
        $Tags = new Tags($id, $nom);
        $this->manager->updateTags($Tags);
    }

    public function deleteTags($id) {
        $this->manager->delete($id);
    }
}


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






<style>
    .form-add-tag {
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        margin: 2%;
    }

    .label-add-tag {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        margin: 10px;
    }

    .input-add-tag {
        margin-top: 4px;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        flex: 1;
    }

    .button-add-tag {
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        width: 100%;
    }

    .button-add-tag:hover {
        background-color: #0056b3;
    }


    .tags-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
    }

    .table-head {
        background-color: #f4f4f4;
    }

    .table-row:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table-header,
    .table-cell {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .input-update-tag {
        padding: 6px 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 13px;
        width: 80%;
    }

    .hidden-input {
        display: none;
    }


    .button-update-tag {
        padding: 6px 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 13px;
        cursor: pointer;
        margin-left: 5px;
        margin-bottom: 18px;
    }

    .button-update-tag:hover {
        background-color: #218838;
    }

    .button-delete-tag {
        padding: 6px 10px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 13px;
        cursor: pointer;
        margin-bottom: 18px;
    }

    .button-delete-tag:hover {
        background-color: #c82333;
    }


    .form-update-tag {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-delete-tag {
        text-align: center;
    }

</style>








