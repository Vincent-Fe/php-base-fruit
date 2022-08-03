<?php
namespace controllers\user;

use models\user\UserManager;
// require_once './models/user/UserManager.php';

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


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $input = filter_input_array(INPUT_POST, [
                'username' => FILTER_SANITIZE_SPECIAL_CHARS,
                'email' => FILTER_SANITIZE_EMAIL,
            ]);

            $username = $input['username'] ?? '';
            $email = $input['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!$username) {
                $errors['username'] = 'Veuillez renseigner ce champ';
            } elseif (mb_strlen($username) < 2) {
                $errors['username'] = 'Ce champ est trop court';
            }

            if (!$email) {
                $errors['email'] = 'Veuillez renseigner ce champ';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'email n'est pas valide";
            }

            if (!$password) {
                $errors['password'] = 'Veuillez renseigner ce champ';
            } elseif (mb_strlen($password) < 6) {
                $errors['password'] = "Le mot de passe doit faire au moins 4 caratères";
            }

            if (!count(array_filter($errors, fn ($e) => $e !== ''))) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->userManager->register($username, $email, $hashedPassword);
                header('Location: home');
            }
        }

        require_once './views/user/form-user.php';
    }


    public function login()
    {

        $errors = [
            'username' => '',
            'email' => '',
            'password' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $input = filter_input_array(INPUT_POST, [
                'email' => FILTER_SANITIZE_EMAIL,
            ]);
            $email = $input['email'] ?? '';
            $password = $_POST['password'] ?? '';



            if (!$email) {
                $errors['email'] = 'Veuillez renseigner ce champ';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "L'email n'est pas valide";
            }

            if (!$password) {
                $errors['password'] = 'Veuillez renseigner ce champ';
            } elseif (mb_strlen($password) < 4) {
                $errors['password'] = "Le mot de passe doit faire au moins 6 caratères";
            }

            if (!count(array_filter($errors, fn ($e) => $e !== ''))) {

                $user = $this->userManager->login($email);

                if ($email !== $user->email) {
                    $errors['email'] = "L'email n'est pas enregistré";
                } else {
                    if ($this->userManager->isConnexionValid($email, $password)) {
                        $_SESSION['access'] = 'user';
                        header('Location: home');
                    } else {
                        $errors['password'] = "Le mot n'est pas valide";
                    }
                }

                print_r($user);
                die();


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