<?php
require 'api.php';

// Find total amount of contacts a user has based on a search
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    session_start();

    $count = numOfContacts($_SESSION['user_id'], $_GET['name']);

    echo json_encode(['count' => $count['COUNT(*)']]);

} 