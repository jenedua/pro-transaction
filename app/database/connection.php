<?php
    namespace app\database;
    use PDO;
    class Connection{
        public static ?PDO $connection = null;
        public static function getConnection(){
            if(!self::$connection){
                self::$connection = new PDO('mysql:host=localhost;dbname=laravelconsultas', 'root', '', [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
               // self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$connection;
        }
    }