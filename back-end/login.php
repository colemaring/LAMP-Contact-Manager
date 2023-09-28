<?php
require 'api.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    $user = getUser($data);

    if ($user == null) {
        http_response_code(400);
        echo json_encode(['message' => 'User does not exist.']);
        return;
    }

    if (password_verify($data['password'], $user['password'])) {
        http_response_code(200);
        echo json_encode(['user_id' => $user['id']]);
    } else {
        http_response_code(400);
        echo json_encode("Password is incorrect.");
    }

}