<?php
require 'database.php';

class Gateway {

    private $db = null;

    public function __construct() {
        $database = new DataBase();
        $this->db = $database->getDataBase();
    }

    public function createUser(Array $data) {

        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$data['username'], $data['password']]);

        return $this->db->lastInsertId();
    }
}

$gate = new Gateway();
$gate->createUser([
    'username' => 'John',
    'password' => 'Doe']);