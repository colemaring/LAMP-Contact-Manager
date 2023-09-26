<?php
require 'database.php';

// Creates a new user and adds it to the database
function createUser(Array $data) {

    $db = connectDB();

    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $db->prepare($sql);
    $stmt->execute(['username' => $data['username'], 'password' => $data['password']]);
    $user_id = $db->lastInsertId();
    
    $db = null;

    return $user_id;

}

// Grabs a user by username from the database
function getUser(Array $data) {
    
    $db = connectDB();

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->execute(['username' => $data['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $db = null;

    return $user;

}

function createContact(Array $data) {

    $db = connectDB();

    $sql = "INSERT INTO contacts (id, firstname, lastname, email, phone, record) VALUES (:id, :firstname, :lastname, :email, :phone, :record)";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $data['id'], 'firstname' => $data['firstname'], 'lastname' => $data['lastname'], 'email' => $data['email'], 'phone' => $data['phone'], 'record' => $data['record']]);
    $contact_id = $db->lastInsertId();

    $db = null;

    return $contact_id;
    
}

function updateContact(Array $data, $contact_id) {
    
    $db = connectDB();

    $sql = "UPDATE contacts SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone, WHERE contact_id = :contact_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['firstname' => $data['firstname'], 'lastname' => $data['lastname'], 'email' => $data['email'], 'phone' => $data['phone']]);
    $row = $stmt->rowCount();

    $db = null;

    return $row;

}

function deleteContact($contact_id) {

    $db = connectDB();

    $sql = "DELETE FROM contacts WHERE contact_id = :contact_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['contact_id' => $contact_id]);
    $row = $stmt->rowCount();

    $db = null;

    return $row;
}

function getContacts($id) {
    
    $db = connectDB();

    $sql = "SELECT * FROM contacts WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['id' => $id]);
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $contacts;
}
