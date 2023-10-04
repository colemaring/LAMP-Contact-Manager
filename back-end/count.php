<?php
require 'api.php';

// Find total amount of contacts
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    session_start();

    $count = numOfContacts($_SESSION['user_id']);

    echo json_encode(['count' => $count['COUNT(*)']]);

} 