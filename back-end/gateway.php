<?php
require 'database.php';

class Gateway {

    private $db = null;

    public function __construct($db) {
        $this->db = $db->getDataBase();
    }

    public function createUser(Array $data) {

        $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $data['username'], 'password' => $data['password']]);

        return $this->db->lastInsertId();
    }

    public function createContact(Array $data) {

        $sql = "INSERT INTO contact (id, firstname, lastname, email, phone, record) VALUES (:id, :firstname, :lastname, :email, :phone, :record)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $data['id'], 'firstname' => $data['firstname'], 'lastname' => $data['lastname'], 'email' => $data['email'], 'phone' => $data['phone'], 'record' => $data['record']])

        return $this->db->lastInsertId();
    }

    publlic function updateContact(Array $data, $contact_id) {
            
            $sql = "UPDATE contact SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone, record = :record WHERE contact_id = :contact_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['firstname' => $data['firstname'], 'lastname' => $data['lastname'], 'email' => $data['email'], 'phone' => $data['phone']]);
    
            return $stmt->rowCount();
    }

}

$gate = new Gateway(new DataBase());
$gate->createUser([
    'username' => 'John1',
    'password' => 'Doe1']);