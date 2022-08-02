<?php

require_once './models/user/UserManager.php';

class UserController 
{
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function register()
    {
        $errors = [
            'username' => '',
            'email' => '',
            'password' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $input = filter_input_array(INPUT_POST,[
                'username' => FILTER_SANITIZE_SPECIAL_CHARS,
                'email' => FILTER_SANITIZE_EMAIL,
            ]);

            $username = $input['username'] ?? '';
            $email = $input['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            if (!$username)
            {
                $errors['username'] = 'Pseudo requis';
            } elseif (mb_strlen($username) < 2){
                $errors['username'] = 'Pseudo trop court';
            }
            if (!$email)
            {
                $errors['email'] = 'Email requis';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email invalide';
            }
            if (!$password)
            {
                $errors['password'] = 'Mot de passe requis';
            } elseif (mb_strlen($password) < 4){
                $errors['password'] = 'Le mot de passe doit faire au moins 4 caractères';
            }
            if (!count(array_filter($errors, fn ($e) => $e !== ''))){
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->userManager->register($username, $email, $hashedPassword);
                header('Location: home');
            }
         
        }

        require_once './views/users/form-user.php';
    }

    public function login()
    {
        $errors = [
            'username' => '',
            'email' => '',
            'password' => '',
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $input = filter_input_array(INPUT_POST,[
                'email' => FILTER_SANITIZE_EMAIL,
            ]);

            $email = $input['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!$email)
            {
                $errors['email'] = 'Email requis';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email invalide';
            }
            if (!$password)
            {
                $errors['password'] = 'Mot de passe requis';
            } elseif (mb_strlen($password) < 4){
                $errors['password'] = 'Le mot de passe doit faire au moins 4 caractères';
            }
            if (!count(array_filter($errors, fn ($e) => $e !== ''))){
                $user = $this->userManager->login($email);
                $userEmail = $user->email ?? '';

                if ($email !== $userEmail){
                    $errors['email'] = 'Email inconnu';
                }else 
                {
                    if ($this->userManager->isConnexionValid($email, $password)){
                    $_SESSION['access'] = $user;
                    header('Location: home');
                } else {
                    $errors['password'] = 'Mot de passe incorrect';
                }
                }
                $this->userManager->register($email, $hashedPassword);
                header('Location: home');
            }
         
        }










        require_once './views/users/form-user.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: home');
    }





}