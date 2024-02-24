<?php 

class db
{
    static $dbhs;

    public static function connect()
    {
        $username = 'root';
        $password = '';
        $dsn = 'mysql:host=localhost;dbname=saidal';

        try {
            if (is_null(static::$dbhs)) {
                static::$dbhs = $dbh = new pdo($dsn, $username, $password);
            }



            return static::$dbhs;
        } catch (PDOException $e) {
            die("Erreur ! : " . $e->getMessage());
        }
    }
}





?>