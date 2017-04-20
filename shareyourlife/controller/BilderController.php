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

        $view = new View('picture_gallery');
        $view->title = 'Bildergallerie';
        $view->heading = 'Bildergallerie';
        $view->users = $bilderRepository->readAll();
        $view->display();
    }
    public function upload()
    {
        $bilderRepository = new BilderRepository();

        $view = new View('picture_index');
        $view->title = 'Bild hochladen';
        $view->heading = 'Bild hochladen';
        $view->users = $bilderRepository->readAll();
        $view->display();
    }

    public function uploaden()
    {
     //   if (!is_null($_FILES['userfile']['tmp_name']))
    
        $ziel= "../public/images/upload";
        $name = $_FILES['userfile']['name'];
        move_uploaded_file($_FILES['userfile']['tmp_name'],"$ziel/$name");
        header('Location: /bilder');
        //$view = new View('user_create');
        //$view->title = 'Benutzer erstellen';
        //$view->heading = 'Benutzer erstellen';
        //$view->display();
    }



    public function delete()
    {
        $userRepository = new UserRepository();
        $userRepository->deleteById($_GET['id']);

        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user');
    }
}
