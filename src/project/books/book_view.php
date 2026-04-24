<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';
 
if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
    die("<p>Error: No book ID provided.</p>");
}
$id = $_GET['id'];
 
try {
    $book = Book::findById($id);
    if ($book === null) {
        die("<p>Error: book not found.</p>");
    }
 
    // Get publisher name
    $publisher = Publisher::findById($book->publisher_id);
 
    // Get formats for this book
    $formats = Format::findByBookId($book->id);
    $formatNames = [];
    foreach ($formats as $format) {
        $formatNames[] = h($format->name);
    }
} 
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>View Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
        </div>
        <div class="container">
            <div class="width-12">
                <div class="hCard">
                    <div class="bottom-content">
                        <?php if ($book->cover_filename): ?>
                            <img src="images/<?= h($book->cover_filename) ?>" alt="Cover for <?= h($book->title) ?>" />
                        <?php else: ?>
                            <img src="images/placeholder.jpg" alt="No cover available" />
                        <?php endif; ?>
 
                        <div class="actions">
                            <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a> /
                            <a href="book_delete.php?id=<?= h($book->id) ?>" onclick="return confirmDelete(event)">Delete</a>/
                            <a href="index.php">Back</a>
                        </div>
                    </div>
 
                    <div class="bottom-content">
                        <h2><?= h($book->title) ?></h2>
                        <p>Author: <?= h($book->author) ?></p>
 
                        <!-- Shows publisher name instead of just the ID -->
                        <p>Publisher: <?= $publisher ? h($publisher->name) : 'Unknown' ?></p>
 
                        <p>Year: <?= h($book->year) ?></p>
 
                        <?php if ($book->isbn): ?>
                            <p>ISBN: <?= h($book->isbn) ?></p>
                        <?php endif; ?>
 
                        <!-- Shows format names instead of nothing -->
                        <?php if (!empty($formatNames)): ?>
                            <p>Formats: <?= implode(', ', $formatNames) ?></p>
                        <?php endif; ?>
 
                        <p>Description:<br /><?= nl2br(h($book->description)) ?></p>
                    </div>
                </div>
            </div>
        </div>

         <script src="Javascript/confirm-delete.js"></script>
    </body>
</html>
