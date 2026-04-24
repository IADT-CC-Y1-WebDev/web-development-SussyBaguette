<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

$data = [];
$errors = [];

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'id' => $_GET['id'] ?? null,
    ];

    $rules = [
        'id' => 'required|integer',
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    $publisher = Publisher::findById($data['id']);
    if (!$publisher) {
        throw new Exception('Publisher not found.');
    }

    $publisher->delete();

    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Publisher deleted successfully.');
    redirect('publisher_index.php');
}
catch (Exception $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('publisher_index.php');
}
