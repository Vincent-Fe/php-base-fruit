<?php
namespace controllers\product;

use controllers\Security;
use models\product\ProductManager;
use models\category\CategoryManager;

// require_once './models/product/ProductManager.php';
// require_once './models/category/CategoryManager.php';
// require_once './controllers/Security.php';

class ProductController
{

    private $productManager;
    private $categoryManager;


    public function __construct()
    {
        $this->productManager = new ProductManager();
        $this->categoryManager = new CategoryManager();
    }


    public function getProducts()
    {
        $products = $this->productManager->getProducts();
        // echo '<pre>';
        // print_r($products);
        // echo '</pre>';
        // die();


        $categories = $this->categoryManager->getCategories();
        $filteredByCategory = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $filteredByCategory = array_filter($products, function ($product) {
                $catId = $_POST['category_id'];
                // print_r($catId == $product->category_id);
                return $catId == $product->category_id;
            });
            // echo "<pre>";
            // print_r($filteredByCategory);
            // echo "</pre>";
        }
        require_once './views/home.php';
    }


    public function getProduct()
    {
        $isLoggedIn = Security::accessSession() ?? false;
        $id = $_GET['id'] ?? '';
        $product = $this->productManager->getProduct($id);
        // print_r($product);

        require_once './views/product/product.php';
    }


    public function setProduct()
    {

        $error = "";
        $productCatId = "";
        $file = "";
        $id = $_GET['id'] ?? '';

        $categories = $this->categoryManager->getCategories();

        if ($id) {
            $product = $this->productManager->getProduct($id);
            $file = $product->image;
            $productCatId = $product->category_id;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $categoryId = $_POST['category'];



            if (isset($_FILES['file'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $file = $_REQUEST['image'] ?? $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
            }

            $tabExtension = explode('.', $file);
            $extension = strtolower(end($tabExtension));
            $maxSize = 400000;


            if (!$name) {
                $error = 'Champ à renseigner';
            }

            if (!$description) {
                $error = 'Champ à renseigner';
            }

            if (!$error) {

                $uniqName = uniqid('', true);



                if ($_REQUEST['image']) {
                    $file = $file;
                } else {
                    $file = $uniqName . '.' . $extension;
                }

                move_uploaded_file($tmpName, './public/images/' . $file);

                if ($id) {
                    $this->productManager->updateProduct($name, $id, $description, $categoryId, $file);
                } else {
                    $this->productManager->setProduct($name, $description, $categoryId, $file);
                }



                header('Location: home');
            }
        }
        require_once './views/product/form-product.php';
    }

    // public function updateProduct()
    // {
    //     $error = "";
    //     $id = $_GET['id'] ?? '';

    //     if ($id) {
    //         $product = $this->productManager->getProduct($id);
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         $name = $_POST['name'];
    //         $description = $_POST['description'];
    //         $this->productManager->updateProduct($name, $id, $description);
    //         header('Location: home');
    //     }

    //     require_once './views/product/form-product.php';
    // }


    public function deleteProduct()
    {
        $id = $_GET['id'] ?? '';

        if ($id) {
            $product = $this->productManager->getProduct($id);
            unlink('public/images/' . $product->image);
            $this->productManager->deleteProduct($id);
            header('Location: home');
        }
    }
}
