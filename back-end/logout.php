<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['logout'] == 'true') {

    // Destroy the user session
    session_start();
    session_destroy();

    http_response_code(200);
    echo json_encode(['message' => 'Logged out.']);

}