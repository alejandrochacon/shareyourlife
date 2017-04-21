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
    public function Bildercreate($dateiname, $userid, $tags, $pfad)
    {

        $userid = Account::getUserid();

        $query = "INSERT INTO $this->tableName (dateiname, userid, tags, pfad) VALUES (?, ?, ?, ?)";

        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('siss', $dateiname, $userid, $tags, $pfad);

        if (!$statement->execute()) {
            throw new Exception($statement->error);
        }

        return $statement->insert_id;
    }

    public function selectbilderid($dateiname){


        $query ="select id from images where dateiname = (?)";
        $statement = ConnectionHandler::getConnection()->prepare($query);
        $statement->bind_param('s', $dateiname);
        if ($statement->execute()) {
            throw new Exception($statement->error);
        }
        return $statement->id;
        }
    }