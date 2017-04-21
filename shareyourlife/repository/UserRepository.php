<?php

require_once '../lib/Repository.php';

/**
 * Das UserRepository ist zuständig für alle Zugriffe auf die Tabelle "user".
 *
 * Die Ausführliche Dokumentation zu Repositories findest du in der Repository Klasse.
 */
class UserRepository extends Repository
{
    /**
     * Diese Variable wird von der Klasse Repository verwendet, um generische
     * Funktionen zur Verfügung zu stellen.
     */
    protected $tableName = 'Users';

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
    public function create($userName,$firstName, $lastName, $email, $password)
    {
        $password = sha1($password);

        $query = "INSERT INTO $this->tableName (username, firstName, lastName, email, password) VALUES (?,?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('sssss', $userName, $firstName, $lastName, $email, $password);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }
  //  public function login($email,$password)
    //{
      //  if($_POST = $email){
        //    session_start();

        //}
    //}

    public function selectusername($email, $password) {

        $query="Select username from users WHERE email = (?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }


        $result = $statement->get_result();
        $username = $result->fetch_object();

        $benutzername = $username->username;
        //$username = $statement->get_result()->fetch_row();
        return $benutzername;

    }
    public function selectuserid($email) {

        $query="Select id from users WHERE email = (?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }


        $result = $statement->get_result();
        $username = $result->fetch_object();

        $userid = $username->username;
        //$username = $statement->get_result()->fetch_row();
        return $userid;

    }
    public function getUserByEmail($email) {

        $query = "SELECT * FROM $this->tableName WHERE email=?";

        // Datenbankverbindung anfordern und, das Query "preparen" (vorbereiten)
        // und die Parameter "binden"
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $email);

        // Das Statement absetzen
        $statement->execute();

        // Resultat der Abfrage holen
        $result = $statement->get_result();
        if (!$result) {
            throw new Exception($statement->error);
        }

        // Ersten Datensatz aus dem Reultat holen
        $row = $result->fetch_object();

        // Datenbankressourcen wieder freigeben
        $result->close();

        // Den gefundenen Datensatz zurückgeben
        return $row;
    }

    public function editUsername($Nusername,$userid)
    {
        $query ="UPDATE $this->tableName SET username=? where id=?";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('si', $Nusername, $userid);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }
    }



}
