<?php
require 'api.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $data = json_decode(file_get_contents('php://input'), true);

    $contact_id = createContact($data);

    if ($contact_id == -1) {
        http_response_code(409);
        echo json_encode(['message' => 'Contacts cannnot have same phone number.']);
        return;
    }

    http_response_code(201);
    echo json_encode(['data' => $data]);
}
