<?php
namespace controllers\category;

use models\category\CategoryManager;
// require_once './models/category/CategoryManager.php';
class CategoryController
{

    private $categoryManager;


    public function __construct()
    {
        $this->categoryManager = new CategoryManager();
    }

    public function getCategories()
    {
        $categories = $this->categoryManager->getCategories();
        print_r($categories);

        require_once './views/home.php';
    }
}
