<?php
include 'database.php';

class Gateway {

    private $db = null;

    public function __construct() {
        $db = new DataBase();
    }

    public function createUser(Array $data) {

        json_decode($data);

        $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':username' => $data['username'],
                ':password' => $data['password']
            ]);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
            
        }

        return $this->db->lastInsertId();
    }
}

$gate = new Gateway();
$gate->createUser([
    'username' => 'John',
    'password' => 'Doe']);