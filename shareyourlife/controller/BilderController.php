<?php

require_once '../repository/BilderRepository.php';

/**
 * Siehe Dokumentation im DefaultController.
 */
class BilderController
{
    public function index()
    {
        $bilderRepository = new BilderRepository();

        $view = new View('picture_index');
        $view->title = 'Bilder';
        $view->heading = 'Bilder';
        $view->users = $bilderRepository->readAll();
        $view->display();
    }

    public function upload()
    {
     //   if (!is_null($_FILES['userfile']['tmp_name']))
    
        $ziel= "../public/images/upload";
        $name = $_FILES['userfile']['name'];
        move_uploaded_file($_FILES['userfile']['tmp_name'],"$ziel/$name");
        echo "<input type='image' src='/images/upload/$name'/>";
    
        //$view = new View('user_create');
        //$view->title = 'Benutzer erstellen';
        //$view->heading = 'Benutzer erstellen';
        //$view->display();
    }

    public function doCreate()
    {
        if ($_POST['send']) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            // $password  = $_POST['password'];
            $password = 'no_password';

            $userRepository = new UserRepository();
            $userRepository->create($firstName, $lastName, $email, $password);
        }

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }

    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
