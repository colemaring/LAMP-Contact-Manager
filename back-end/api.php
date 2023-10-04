<?php
require 'database.php';

// Creates a new user and adds it to the database
function createUser(Array $data) {

    $db = connectDB();

    // If a user with the same username already exists, return an error
    try {
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $data['username'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $data['password'], PDO::PARAM_STR);
        $stmt->execute();
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
function getUser($username) {
    
    $db = connectDB();

    // If the user does not exist, return an error
    try {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
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

// Creates a new contact and adds it to the database
function createContact(Array $data) {

    $db = connectDB();

    // If a contact can't be created for whatever reason, return an error
    try {
        $sql = "INSERT INTO contacts (id, firstname, lastname, email, phone, datecreated) VALUES (:id, :firstname, :lastname, :email, :phone, :datecreated)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $data['id'], PDO::PARAM_INT);
        $stmt->bindValue(':firstname', $data['firstname'], PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $data['lastname'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':datecreated', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
    }
    
    catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            return -1;
        }
    }
    
    // Return the contact id
    $contact_id = $db->lastInsertId();

    $db = null;

    return $contact_id;
    
}

function updateContact($contact_id, Array $data) {
    
    $db = connectDB();

    try {
        $sql = "UPDATE contacts SET firstname = :firstname, lastname = :lastname, email = :email, phone = :phone WHERE contact_id = :contact_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);
        $stmt->bindValue(':firstname', $data['firstname'], PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $data['lastname'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $data['email'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $data['phone'], PDO::PARAM_STR);
        $stmt->execute();
    }
    
    catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            return 0;
        }
    }

    $row = $stmt->rowCount();

    $db = null;

    return $row;
}

// Deletes a contact from the database
function deleteContact($contact_id) {

    $db = connectDB();

    // If the contact does not exist, return an error
    try {
        $sql = "DELETE FROM contacts WHERE contact_id = :contact_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':contact_id', $contact_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            return 0;
        }
    }
    
    // Return the number of rows affected
    $row = $stmt->rowCount();

    $db = null;

    return $row;
}

// Grabs 5 contacts from a user from the database
function getContacts($id, $page) {
    
    $db = connectDB();

    $contactsPerPage = 5;
    $offset = ($page - 1) * $contactsPerPage;

    // If a user didn't create a contact, return an error
    try {
        $sql = "SELECT * FROM contacts WHERE id = :id LIMIT :limit OFFSET :offset";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $contactsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
    } 
    
    catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            return null;
        }
    }

    // Return the contacts
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $contacts;
}

// Grabs a list of contacts depending on search from the database
function searchContacts($id, $name) {
        
    $db = connectDB();

    // If a user didn't create a contact, return an error
    try {
        $sql = "SELECT * FROM contacts WHERE id = :id AND ( CONCAT(firstName, ' ', lastName) LIKE :name OR lastName LIKE :name )";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
        $stmt->execute();
    } 
    
    catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            return null;
        }
    }

    // Return the contacts
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;

    return $contacts;
}

// Finds the total amount of contacts a user has
function numOfContacts($id) {
        
    $db = connectDB();

    // If a user didn't create a contact, return an error
    try {
        $sql = "SELECT COUNT(*) FROM contacts WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } 
    
    catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            return null;
        }
    }

    // Return the contacts
    $numContacts = $stmt->fetch(PDO::FETCH_ASSOC);

    $db = null;

    return $numContacts;
}
