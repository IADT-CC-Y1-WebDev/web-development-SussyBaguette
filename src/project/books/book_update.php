<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';
 
startSession();
 
try {
    // Initialize form data array
    $data = [];
    // Initialize errors array
    $errors = [];
    
    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }
 
    // Get form data
    $data = [
        'id' => $_POST['id'] ?? null,
        "title" => $_POST["title"] ?? null,
        "author" => $_POST["author"] ?? null,
        "publisher_id" => $_POST["publisher_id"] ?? null,
        "year" => $_POST["year"] ?? null,
        "isbn" => $_POST["isbn"] ?? null,
        "format_ids" => $_POST["format_ids"] ?? [],
        "description" => $_POST["description"] ?? null,
        "cover" => $_FILES["cover"] ?? null,
    ];
 
    // Define validation rules
    // FIX 1: cover is optional on edit - removed "required" from cover rule
    $rules = [
        'id' => 'required|integer',
        "title" => "required|noempty|min:4|max:255",
        "author" => "required|noempty|min:5|max:255",
        "publisher_id" => "required|noempty|integer",
        "year" => "required|noempty|integer|minvalue:1900|maxvalue:2026",
        "isbn" => "required|noempty|min:13|max:13",
        "format_ids" => "required|noempty|array|min:1|max:4",
        "description" => "required|noempty|min:10",
        "cover" => "file|image|mimes:jpg,jpeg,png|max_file_size:5242880",
    ];
 
    // Validate all data (including file)
    $validator = new Validator($data, $rules);
 
    if ($validator->fails()) {
        // Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
 
        throw new Exception('Validation failed.');
    }
 
    // Find existing book
    $book = Book::findById($data['id']);
    if (!$book) {
        throw new Exception('Book not found.');
    }
 
    // Verify publisher exists
    $publisher = Publisher::findById($data['publisher_id']);
    if (!$publisher) {
        throw new Exception('Selected publisher does not exist.');
    }
 
    // Verify formats exist
    foreach ($data['format_ids'] as $formatId) {
        if (!Format::findById($formatId)) {
            throw new Exception('One or more selected formats do not exist.');
        }
    }
  
    // Process the uploaded image (validation already completed)
    $imageFilename = null;
    $uploader = new ImageUpload();
 
    // FIX 2: changed 'image' to 'cover' to match the form field name
    if ($uploader->hasFile('cover')) {
        // Delete old image
        $uploader->deleteImage($book->cover_filename);
        // Process new image
        // FIX 2: changed $_FILES['image'] to $_FILES['cover']
        $imageFilename = $uploader->process($_FILES['cover']);
        // Check for processing errors
        if (!$imageFilename) {
            throw new Exception('Failed to process and save the image.');
        }
    }
    
    // Update the book instance
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->publisher_id = $data['publisher_id'];
    $book->year = $data['year'];
    $book->isbn = $data['isbn'];
    $book->description = $data['description'];
    
    // FIX 3: changed $cover_filename to $imageFilename
    if ($imageFilename) {
        $book->cover_filename = $imageFilename;
    }
 
    // Save to database
    $book->save();
 
    // Update format associations
    BookFormat::deleteByBook($book->id);
    if (!empty($data['format_ids']) && is_array($data['format_ids'])) {
        foreach ($data['format_ids'] as $formatId) {
            BookFormat::create($book->id, $formatId);
        }
    }
   
    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();
 
    // Set success flash message
    setFlashMessage('success', 'Book updated successfully.');
 
    // Redirect to book details page
    redirect('book_view.php?id=' . $book->id);
}
catch (Exception $e) {
    // Error - clean up uploaded image if one was processed
    if (isset($imageFilename) && $imageFilename) {
        $uploader->deleteImage($imageFilename);
    }
 
    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());
 
    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);
 
    // Redirect back to edit page if there is an ID; otherwise, go to index page
    if (isset($data['id']) && $data['id']) {
        redirect('book_edit.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}