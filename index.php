<?php
session_start();
// $pdo = require_once './data/database.php';
require_once './controllers/product/ProductController.php';
require_once './controllers/user/UserController.php';

$productController = new ProductController();
$userController = new UserController();

$page = $_GET['page'] ?? '';

// print_r($page);

ob_start();


try {
    if (empty($page)) {
        header('Location: home');
    } else {
        if ($page === "home") {
            $productController->getProducts();
        } elseif ($page === "create") {
            $productController->setProduct();
        } elseif ($page === "edit") {
            $productController->setProduct();
        } elseif ($page === "delete") {
            $productController->deleteProduct();
        } elseif ($page === "product") {
            $productController->getProduct();
        } elseif ($page === "register") {
            $userController->register();
        } elseif ($page === "login") {
            $userController->login();
        } elseif ($page === "logout") {
            $userController->logout();
        }
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}






$content = ob_get_clean();


require_once './views/common/template.php';
