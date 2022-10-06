<?php 

namespace Model;

use PDO;
use PDOException;

class User {

    private $conn;

    public function __construct(){
        require_once('Connection.php');
        $this->conn = Connect::connection();
    }

    public function get_user_by_auth($user, $password) {
        try{
            $query = "SELECT * FROM users WHERE user = :user AND password = :password";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user', $user);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

}

?>