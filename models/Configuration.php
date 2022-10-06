<?php 

namespace Model;

use PDO;
use PDOException;

class Configuration {

    private $conn;

    public function __construct(){
        require_once($_SERVER['DOCUMENT_ROOT'].'/models/Connection.php');
        $this->conn = Connect::connection();
    }

    public function get_setups(){
        try{
            $query = "SELECT * FROM configuration WHERE id = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

    public function update($user_limit){
        try{
            $stmt = $this->conn->prepare("UPDATE configuration SET user_limit = :user_limit WHERE id = 1");
            $stmt->bindParam(':user_limit', $user_limit);
            $stmt->execute();
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

}

?>