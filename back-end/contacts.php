<?php
require 'api.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    $missingError = empty($data['firstname']) || empty($data['lastname']) || empty($data['email']) || empty($data['phone']);
    $emailError = !filter_var($data['email'], FILTER_VALIDATE_EMAIL);
    $phoneError = !preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $data['phone']);

    if ($missingError) {
        http_response_code(400);
        echo json_encode(['message' => 'All fields are required.']);
        return;
    }

    if ($emailError || $phoneError) {
        http_response_code(400);
        echo json_encode(['message' => 'Phone number or email are not valid.']);
        return;
    }

    session_start();

    $contact_id = createContact($_SESSION['user_id'], $data);

    if ($contact_id == -1) {
        http_response_code(409);
        echo json_encode(['message' => 'Contacts cannnot have same phone number.']);
        return;
    }

    http_response_code(201);
    echo json_encode(['data' => 'Data inserted successfully.']);
}
