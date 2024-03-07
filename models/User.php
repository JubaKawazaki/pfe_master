<?php
class  User
{
    static function logine($data)
    {
        $mat = $data['mat'];
        try {
            $stm = db::connect()->prepare("SELECT e.*, s.id_service
                FROM employer e 

                JOIN service s ON e.id_service = s.id_service
                WHERE  e.mat = ?");
            $stm->execute(array($mat));
            $employ = $stm->fetch(PDO::FETCH_OBJ);
            return $employ;
        } catch (PDOException $ex) {
            echo 'error' . $ex->getMessage();
        }
    }

    static function createUser($data)
    {
        $db = db::connect();
        $stmt = $db->prepare("INSERT INTO user (nom_pr, username,password)
         VALUES (:fullname, :username, :password)");

        // Liaison des paramètres individuels
        $stmt->bindValue(':fullname', $data['fullname']);
        $stmt->bindValue(':username', $data['username']);
        $stmt->bindValue(':password', $data['password']);

        $res = $stmt->execute();

        if ($res) {
            return 'ok';
        } else {
            return 'error';
        }
        $stmt = null;
    }
}
