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

        $images = $bilderRepository->readAllByUserId(Account::getUserid());

        $view = new View('picture_gallery');
        $view->title = 'Bildergallerie';
        $view->heading = 'Bildergallerie';
        $view->images = $images;
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

        $ziel= "images/upload";
        $name = $_FILES['userfile']['name'];
        $pfad = "$ziel/$name";
        $size = $_FILES['userfile']['size'];
        $tags = htmlspecialchars($_POST['tags']);


        $bilderRepository = new BilderRepository();

        $bilderRepository->Bildercreate($name, Account::getUserid(), $tags, $pfad);
        move_uploaded_file($_FILES['userfile']['tmp_name'],$pfad);
        header('Location: /bilder');
        //$view = new View('user_create');
        //$view->title = 'Benutzer erstellen';
        //$view->heading = 'Benutzer erstellen';
        //$view->display();
    }



    public function delete()
    {
        if (isset($_GET['id'])) {
            $bildid = $_GET['id'];

            $bilderRepository = new BilderRepository();
            $bild = $bilderRepository->readById($bildid);

            if ($bild->userid == Account::getUserid()) {

                $bilderRepository->deleteById($bild->id);

                unlink('images/upload/' . $bild->dateiname);
            }
        }
        // Anfrage an die URI /user weiterleiten (HTTP 302)
        header('Location: /user/myaccount');
    }
    public function suche(){
        $tags=$_POST['searchbar'];
        $bilderRepository = new BilderRepository();
        $bilder = $bilderRepository->suche($tags);

        $view = new View('picture_suche');
        $view->title = 'Suchergebnis';
        $view->heading = 'Suchergebnis';
        $view->images = $bilder;
        $view->display();
            }
}
