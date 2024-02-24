<?php 


class  User
{
    static function login($data)
    {
        $mat = $data['mat'];
        $id = $data['id'];
        try {
            $stm = db::connect()->prepare("select * from employer  where id = ? AND mat = ? ");
            $stm->execute(array($id, $mat));
            $employe = $stm->fetch(PDO::FETCH_OBJ);
            return $employe;
        } catch (PDOException $ex) {
            echo 'error' . $ex->getMessage();
            //throw $th;
        }
        $stmt = null;
    }

}



?>