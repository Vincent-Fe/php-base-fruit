<?php
// $pdo = require_once './data/database.php';

$id = $_GET['id'] ?? '';

if ($id) {
    require_once './models/showOne.model.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fruit = $_POST['name'];
    require_once './models/edit.model.php';
    header('Location: index.php?page=home');
}

require_once './views/edit-fruit.php';
