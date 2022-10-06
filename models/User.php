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

    public function create($full_name, $username, $password, $query_limit){
        try{
            $stmt = $this->conn->prepare("INSERT INTO users (full_name, user, password, query_limit) VALUES (:full_name, :username, :password, :query_limit)");
            $stmt->bindParam(':full_name', $full_name);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':query_limit', $query_limit);
            $user = $stmt->execute();
            return $user;
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

}

?>