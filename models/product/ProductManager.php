<?php

require_once 'models/Database.php';
class ProductManager extends Database
{

    private $table = 'product';


    public function getProducts()
    {
        $req = "SELECT p.*, c.name as category_name  FROM {$this->table} p
                INNER JOIN category c ON p.category_id = c.id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->execute();
        $fruits = $stmt->fetchAll();
        $stmt->closeCursor();
        return $fruits;
    }

    public function getProduct($id)
    {
        $req = "SELECT p.*, c.name as category_name FROM {$this->table} p
                INNER JOIN category c ON p.category_id = c.id
                WHERE p.id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $product = $stmt->fetch();
        return $product;
    }

    public function setProduct($name, $description, $categoryId, $file)
    {
        $req = "INSERT INTO product VALUES (DEFAULT, :name, :iduser, :description, :category_id, :image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":iduser", 1);
        $stmt->bindValue(":category_id", $categoryId);
        $stmt->bindValue(":image", $file);
        $stmt->execute();
    }


    public function updateProduct($name, $id, $description, $categoryId, $file)
    {
        $req = "UPDATE product SET name = :name, description = :description, category_id = :category_id, image = :image WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":category_id", $categoryId);
        $stmt->bindValue(":image", $file);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $req = "DELETE FROM product WHERE id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }
}
