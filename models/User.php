<?php 

namespace Model;

use PDO;
use PDOException;

class User {

    private $conn;

    public function __construct(){
        require_once($_SERVER['DOCUMENT_ROOT'].'/models/Connection.php');
        $this->conn = Connect::connection();
    }

    public function get_user_by_username($username){
        try{
            $query = "SELECT * FROM users WHERE user = :user";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

}

?>