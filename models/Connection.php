<?php 
namespace Model;

use PDO;
use PDOException;
use Dotenv;

class Connect{

    public static function connection(){
        try{
            $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']."/app");
            $dotenv->load();
            $connection = new PDO("mysql:host={$_ENV['DB_SERVER']};dbname={$_ENV['DB_NAME']};charset=utf8", "{$_ENV['DB_USER']}", "{$_ENV['DB_PASS']}");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            die('error '.$e->getMessage());
            echo "Linea del error".$e->getLine();
        }
        return $connection;
    }


}

?>