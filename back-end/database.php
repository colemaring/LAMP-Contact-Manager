<?php

function connectDB() {

    $db = null;
    
    try {
        $db = new PDO('mysql:host=localhost;port=3306;dbname=LAMP', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    
    catch (PDOException $e) {
        die('Error: ' . $e->getMessage() . "\n");
    }

    return $db;
    
}
