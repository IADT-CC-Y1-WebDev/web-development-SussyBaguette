<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

$data = [];
$errors = [];

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'id'   => $_POST['id']   ?? null,
        'name' => $_POST['name'] ?? null,
    ];

    $rules = [
        'id'   => 'required|integer',
        'name' => 'required|noempty|min:2|max:255',
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

    $publisher->name = $data['name'];
    $publisher->save();

    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Publisher updated successfully.');
    redirect('publisher_index.php');
}
catch (Exception $e) {
    setFormErrors($errors);
    setFormData($data);
    setFlashMessage('error', 'Could not update publisher.');

    if (isset($data['id']) && $data['id']) {
        redirect('publisher_edit.php?id=' . $data['id']);
    } else {
        redirect('publisher_index.php');
    }
}
