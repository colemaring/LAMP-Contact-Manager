<?php
require 'database.php';

// Creates a new user and adds it to the database
function createUser(Array $data) {


    $db = connectDB();

    // If the user already exists, return an error
    try {
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $db->prepare($sql);
        $status = $stmt->execute(['username' => $data['username'], 'password' => $data['password']]);
    }

    catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            return -1;
        }
    }

    // Return the user id
    $user_id = $db->lastInsertId();
    
    $db = null;

    return $user_id;

}

// Grabs a user by username from the database
function getUser(Array $data) {
    
    $db = connectDB();

    // If the user does not exist, return an error
    try {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $status = $stmt->execute(['username' => $data['username']]);
    }

    catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            return null;
        }
    }

    // Return the user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $db = null;

    return $user;

}

function createContact(Array $data) {

    $db = connectDB();

    try {
        $sql = "INSERT INTO contacts (id, firstname, lastname, email, phone, datecreated) VALUES (:id, :firstname, :lastname, :email, :phone, :datecreated)";
        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $data['id'], 'firstname' => $data['firstname'], 'lastname' => $data['lastname'], 'email' => $data['email'], 'phone' => $data['phone'], 'datecreated' => $data['datecreated']]);
    }
    
    catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            return -1;
        }
    }
    
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
