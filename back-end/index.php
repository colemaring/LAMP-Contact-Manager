<?php
require 'api.php';

function handleSignUp($method) {

    if ($method == 'POST') {

        header ('Content-Type: application/json');
        header ('Access-Control-Allow-Origin: *');
        header ('Access-Control-Allow-Methods: POST');
        header ('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

        $data = json_decode(file_get_contents('php://input'), true);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $user_id = createUser($data);

        echo json_encode(['user_id' => $user_id]);
    }

}

function handleLogin($method) {

    if ($method == 'POST') {

        header ('Content-Type: application/json');
        header ('Access-Control-Allow-Origin: *');
        header ('Access-Control-Allow-Methods: POST');
        header ('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

        $data = json_decode(file_get_contents('php://input'), true);

        $user = getUser($data);

        if (password_verify($data['password'], $user['password'])) {
            echo json_encode("Login successful.");
        } else {
            echo json_encode("Username or password is incorrect.");
        }
    }

}

handleLogin($_SERVER['REQUEST_METHOD']);