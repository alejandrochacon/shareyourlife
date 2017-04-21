<?php

require_once '../repository/UserRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        $userRepository = new UserRepository();

        $view = new View('user_index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->users = $userRepository->readAll();
        $view->display();
    }

    public function create()
    {
        $view = new View('user_create');
        $view->title = 'Benutzer erstellen';
        $view->heading = 'Benutzer erstellen';
        $view->display();
    }

    public function doCreate()
    {
        if ($_POST['send']) {
            $userName = $_POST['userName'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];


            $userRepository = new UserRepository();
            $userRepository->create($userName,$firstName, $lastName, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public function delete()
    {
        $userRepository = new UserRepository();

        $userRepository->deleteById($_SESSION['user']->id);
        session_destroy();
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /');
    }
    public function login()
    {
        $userRepository = new UserRepository();

        $view = new View('user_login');
        $view->title = 'Einloggen';
        $view->heading = 'Einloggen';
        $view->users = $userRepository->readAll();
        $view->display();



    }
    public function authLog()
    {
        if(!empty($_POST['email']) && !empty($_POST['password'])){

            $email=$_POST['email'];
            $password = sha1($_POST['password']);


            $userRepository = new UserRepository();

            $user = $userRepository->getUserByEmail($email);

            if (!empty($user)) {

                if ($user->password == $password) {
                    $_SESSION['user'] = $user;
                    $this->myaccount();


                } else {
                    header('location: /');
                }
            } else {
                header('location: /');
            }
        }
        else
        {
            header('location: /');
        }

    }

    public function myaccount() {
        $view = new View('user_index');
        $view->title = "Mein Konto";
        $view->heading = "Mein Konto";
        $view->benutzername = Account::getUsername();
        $view->userid = Account::getUserid();
        $view->logged=Account::isLoggedIn();
        $view->display();
    }

    public function logout(){
        session_start();
        session_destroy();
        header('location: /');
    }


}
