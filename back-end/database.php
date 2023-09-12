<?php

class DataBase {

    private $db = null;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=TEST1', 'root', "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage() . "\n");
        }
    }

    public function getDataBase() {
        return $this->db;
    }
}