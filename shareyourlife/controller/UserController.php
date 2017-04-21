<?php

require_once '../repository/UserRepository.php';
require_once '../repository/BilderRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class UserController
{
    public function index()
    {
        $userRepository = new UserRepository();
        $bilderRepository = new BilderRepository();

        $images = $bilderRepository->readAllByUserId(Account::getUserid());

        $view = new View('user_index');
        $view->title = 'Benutzer';
        $view->heading = 'Benutzer';
        $view->users = $userRepository->readById(Account::getUserid());
        $view->images = $images;
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
            $userName=htmlspecialchars($_POST['userName' ]);
            $firstName = htmlspecialchars($_POST['firstName']);
            $lastName = htmlspecialchars($_POST['lastName']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);


            $userRepository = new UserRepository();
            $userRepository->create($userName,$firstName, $lastName, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user/login');
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
        if(!empty(htmlspecialchars($_POST['email'])) && !empty ($_POST['password']))
        {

            $email=$_POST['email'];
            $password = sha1($_POST['password']);


            $userRepository = new UserRepository();

            $user = $userRepository->getUserByEmail($email);

            if (!empty($user)) {

                if ($user->password == $password) {

                    $_SESSION['falschpw'] = false;
                    $_SESSION['user'] = $user;
                    $this->myaccount();


                } else {
                    $_SESSION['falschpw'] = true;
                    header('location: /user/login');
                }
            } else {
                $_SESSION['falschpw'] = true;
                header('location: /user/login');
            }
        }
        else
        {
            $_SESSION['falschpw'] = true;
            header('location: /user/login');
        }

    }

    public function myaccount() {

        $bilderRepository = new BilderRepository();

        $images = $bilderRepository->readAllByUserId(Account::getUserid());

        $view = new View('user_index');
        $view->title = "Mein Konto";
        $view->heading = "Mein Konto";
        $view->benutzername = Account::getUsername();
        $view->userid = Account::getUserid();
        $view->logged=Account::isLoggedIn();
        $view->images = $images;
        $view->display();
    }

    public function logout(){
        session_start();
        session_destroy();
        header('location: /');
    }
    public function edit()
    {
        if (isset($_POST['edit_username'])) {
            $Nusername = htmlspecialchars($_POST['username']);
            $UserRepository = new UserRepository();
            $userid = Account::getUserid();

            $UserRepository->editUsername($Nusername, $userid);
            $_SESSION['user']->username = $Nusername;
        }

        $view = new View('user_edit');
        $view->title = "Benutzer bearbeiten";
        $view->heading = "Benutzer bearbeiten";
        $view->display();
    }






}
