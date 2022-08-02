<?php

require_once './models/Database.php';

class UserManager extends Database
{
    public function register($username, $email, $hashedPassword)
    {
        $req = "INSERT INTO user VALUES (DEFAULT, :username, :email, :password)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $hashedPassword);
        $stmt->execute();
    }
    public function login($email){
        $req = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch();
        return $user;
    }

    public function isConnexionValid($email, $password)
    {
        $user = $this->login($email);
        return password_verify($password, $user->password);
    }
}