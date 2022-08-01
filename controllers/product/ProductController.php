<?php


require_once './models/product/ProductManager.php';
require_once './models/category/CategoryManager.php';

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
        $categories = $this->categoryManager->getCategories();
        $filteredByCategory = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $filteredByCategory = array_filter($products, function ($product) {
                $catId = $_POST['category_id'];
                return $catId == $product->category_id;
            });
        }





        require_once './views/home.php';
    }


    public function getProduct()
    {
        $id = $_GET['id'] ?? '';
        $product = $this->productManager->getProduct($id);
        // print_r($product);

        require_once './views/product/product.php';
    }


    public function setProduct()
    {

        $error = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];

            if (!$name) {
                $error = 'Champ à renseigner';
            }

            if (!$description) {
                $error = 'Champ à renseigner';
            }

            if (!$error) {
                $this->productManager->setProduct($name, $description);

                header('Location: home');
            }
        }
        require_once './views/product/form-product.php';
    }

    public function updateProduct()
    {
        $error = "";
        $id = $_GET['id'] ?? '';

        if ($id) {
            $product = $this->productManager->getProduct($id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $description = $_POST['description'];
            $this->productManager->updateProduct($name, $id, $description);
            header('Location: home');
        }

        require_once './views/product/form-product.php';
    }


    public function deleteProduct()
    {
        $id = $_GET['id'] ?? '';

        if ($id) {
            $this->productManager->deleteProduct($id);
            header('Location: home');
        }
    }
}
