<?php
// $pdo = require_once './data/database.php';
require_once './controllers/product/ProductController.php';

$productController = new ProductController();

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
        }
    }
} catch (Exception $e) {
    $msg = $e->getMessage();
    echo $msg;
}






$content = ob_get_clean();


require_once './views/common/template.php';
