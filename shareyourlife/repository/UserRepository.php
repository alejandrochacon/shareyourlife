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
    protected $tableName = 'users';

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
    public function selectuserid($username){
        $query="Select id from users WHERE username = (?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('i', $username);
        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }


        $result = $statement->get_result();
        $userid = $result->fetch_object();

        $benutzerid = $userid->username;
        //$username = $statement->get_result()->fetch_row();
        return $benutzerid;

    }


}
