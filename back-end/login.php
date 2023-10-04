<?php
require 'api.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Grab the user
    $user = getUser($_GET['username']);

    // If the user does not exist, return an error
    if ($user == null) {
        http_response_code(400);
        echo json_encode(['message' => 'User does not exist.']);
        return;
    }

    // If the password is incorrect, return an error
    if (password_verify($_GET['password'], $user['password'])) {
        http_response_code(200);

        // Create a user session
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        echo json_encode(['user_id' => $user['id']]);
    } else {
        http_response_code(400);
        echo json_encode("Password is incorrect.");
    }

}
