<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class BilderRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'images';

    /**
     * Erstellt einen neuen benutzer mit den gegebenen Werten.
     *
     * Das Passwort wird vor dem ausführen des Queries noch mit dem SHA1
     *  Algorythmus gehashed.
     *
     * @param $firstName Wert für die Spalte firstName
     * @param $lastName Wert für die Spalte lastName
     * @param $email Wert für die Spalte email
     * @param $password Wert für die Spalte password
     *
     * @throws Exception falls das Ausführen des Statements fehlschlägt
     */
    public function selectuserid($username){

        $query="Select userid from $this->tableName WHERE username = (?) inner join users on images.userid = users.id";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $username);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }


        $result = $statement->get_result();
        $userid = $result->fetch_object();

        $benutzerid = $userid->id;
        //$username = $statement->get_result()->fetch_row();
        return $benutzerid;

    }
    public function Bildercreate($dateiname,$userid, $tags, $pfad)
    {



        $query = "INSERT INTO $this->tableName (dateiname, userid, tags, pfad) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('siss', $dateiname, $userid, $tags, $pfad);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function readAllByUserId($userid) {

        // Query erstellen
        $query = "SELECT * FROM {$this->tableName} WHERE userid=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $userid);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        $rows = [];
        // Ersten Datensatz aus dem Reultat holen
        while($row = $result->fetch_object()) {
            $rows[] = $row;
        }

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $rows;

    }

    public function selectbilderid($dateiname){


        $query ="select id from images where dateiname = (?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $dateiname);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->id;
        }
    public function selectbildername(){
        $userid = account::getUserid();
        $query ="select dateiname from images where userid = (?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $userid);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->dateiname;
    }
    public function suche($tags)
    {
        $tags = $_POST['searchbar'];
        $tags = "%" . $tags . "%";
        $query ="select pfad from images join Users on images.userid = Users.id where tags LIKE ? or username LIKE ?";
        $statement = ConnectionHandler::getConnection()->prepare($query);

        $statement->bind_param('ss', $tags, $tags);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
        $result = $statement->get_result();
        if(!empty($result)) {
            return $result;
        }
        else {
            return 1;
        }
        }
public function gallerie(){
$query ="select * from bilder join user.id on userid"
}
    }
