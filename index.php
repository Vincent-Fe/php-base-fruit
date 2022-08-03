<?php
session_start();

use controllers\Security;
use controllers\user\UserController;
use controllers\product\ProductController;
// $pdo = require_once './data/database.php';
// require_once './controllers/product/ProductController.php';
// require_once './controllers/user/UserController.php';
// require_once './controllers/Security.php';

function autoload($class)
{
    require_once "$class.php";
}

spl_autoload_register('autoload');

$productController = new ProductController();
$userController = new UserController();

$isLoggedIn = Security::accessSession() ?? false;

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
