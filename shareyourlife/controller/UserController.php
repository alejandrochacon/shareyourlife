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
        $userRepository->deleteById($_GET['id']);

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
        $email=$_POST['email'];
        $password=$_POST['password'];







        $_POST['password']=sha1($_POST['password']);
        $query="Select * from users WHERE email=$email";
        $query2="select * from users where password = $password";
        if($query&&$query2){
            $userRepository = new UserRepository();
            $userRepository->selectusername($email, $password);
            $view = new View('user_home');
            $view->benutzername = $userRepository->selectusername($email, $password);
            $username = $userRepository->selectusername($email, $password);

            session_start();
            $_SESSION['username']=$username;
            header('location: /');


        }
        else
            {
                echo "Die Einloggdaten waren falsch";
            }

    }
    public function logout(){
        session_start();
        session_destroy();
        header('location: /');
    }

}
