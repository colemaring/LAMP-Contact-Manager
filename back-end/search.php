<?php
require 'api.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    session_start();

    $contacts = searchContacts($_SESSION['user_id'], $_GET['name']);

    if ($contacts == null) {
        http_response_code(404);
        echo json_encode(['message' => 'No contacts found.']);
        return;
    }

    http_response_code(200);
    echo json_encode($contacts);
}