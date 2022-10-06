<?php 

namespace Model;

use PDO;
use PDOException;

class Rule {

    private $conn;

    public function __construct(){
        require_once($_SERVER['DOCUMENT_ROOT'].'/models/Connection.php');
        $this->conn = Connect::connection();
    }

    public function get_list(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM rules");
            $stmt->execute();
            $rules = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rules;
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

    public function create($title, $description){
        try{
            $stmt = $this->conn->prepare("INSERT INTO rules (title, description) VALUES (:title, :description)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $rule = $stmt->execute();
            return $rule;
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

}

?>