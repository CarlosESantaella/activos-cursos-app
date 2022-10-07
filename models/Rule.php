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

    public function get($id){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM rules WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $rule = $stmt->fetch(PDO::FETCH_ASSOC);
            return $rule;
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

    public function get_list_by_filter($filter) {
        try{

            $params = [];
            $sql = "SELECT * FROM rules WHERE (title LIKE :filter)";
            $params[] = [":filter", "%$filter%"];
            if (count(explode(" ", $filter)) > 1) {
                $sql .= " OR (";
                foreach (explode(" ", $filter) as $key => $value) {
                    if ($key != 0) {
                        $sql .= " OR ";
                    }
                    $sql .= "title LIKE :filter$key";
                    $params[] = [":filter$key", "%$value%"];
                }
                $sql .= ")";
            }
            $stmt = $this->conn->prepare($sql);
            foreach ($params as $key => $param) {
                $stmt->bindParam($param[0], $param[1]);
            }
            $stmt->execute();
            $rules = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rules;
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
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
            $stmt->execute();
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

    public function update($title, $description, $id_rule){
        try{
            $stmt = $this->conn->prepare("UPDATE rules SET title = :title, description = :description WHERE id = :id");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id', $id_rule);
            $stmt->execute();
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

    public function delete($id){
        try{
            $stmt = $this->conn->prepare("DELETE FROM rules WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }catch(PDOException $e){
            die('error: '.$e->getMessage().' on '.$e->getLine());
        }
    }

}

?>