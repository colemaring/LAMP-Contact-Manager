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

    $data['id'] = $_SESSION['user_id'];

    $contact_id = createContact($data);

    if ($contact_id == -1) {
        http_response_code(409);
        echo json_encode(['message' => 'Contacts cannnot have same phone number.']);
        return;
    }

    http_response_code(201);
    echo json_encode(['message' => 'Contact added successfully.']);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    session_start();

    $contacts = getContacts($_SESSION['user_id'], $_GET['name'], $_GET['page']);

    if ($contacts == null) {
        http_response_code(404);
        echo json_encode(['message' => 'No contacts found.']);
        return;
    }

    http_response_code(200);
    echo json_encode($contacts);
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $contact_id = deleteContact($_GET['contact_id']);

    if ($contact_id == 0) {
        http_response_code(404);
        echo json_encode(['message' => 'Contact not found.']);
        return;
    }

    http_response_code(200);
    echo json_encode(['message' => 'Contact deleted successfully.']);
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

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

    $contact_id = updateContact($_GET['contact_id'], $data);

    if ($contact_id == 0) {
        http_response_code(404);
        echo json_encode(['message' => 'Contact not found.']);
        return;
    }

    http_response_code(200);
    echo json_encode(['message' => 'Contact updated successfully.']);
}