<?php
require 'api.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    header('Content-Type: application/json');

    $data = json_decode(file_get_contents('php://input'), true);
    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

    $user_id = createUser($data);

    if ($user_id == -1) {
        http_response_code(400);
        echo json_encode(['message' => 'User already exists.']);
        return;
    }

    http_response_code(200);
    echo json_encode(['user_id' => $user_id]);

}
