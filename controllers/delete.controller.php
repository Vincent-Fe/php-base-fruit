<?php

$id = $_GET['id'];

if ($id) {


    require_once './models/delete.model.php';
    header('Location: index.php?page=home');
}
