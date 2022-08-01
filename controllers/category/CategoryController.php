<?php

require_once './models/category/CategoryManager.php';
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
