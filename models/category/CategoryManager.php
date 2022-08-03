<?php
namespace models\category;

use models\Database;
require_once './models/Database.php';

class CategoryManager extends Database
{
    private $table = 'category';


    public function getCategories()
    {
        $req = "SELECT * FROM {$this->table}";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        $stmt->closeCursor();
        return $categories;
    }
}
