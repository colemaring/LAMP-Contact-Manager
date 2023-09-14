<?php

class DataBase {

    private $db = null;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=users', 'root', "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage() . "\n");
        }

        if ($this->db != null) {
            echo "Connected to the database.\n";
        }
        else {
            echo "Failed to connect to the database.\n";
        }
    }

    public function getDataBase() {
        return $this->db;
    }
}