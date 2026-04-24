<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';

startSession();

try {
    $publishers = Publisher::findAll();
}
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Publishers</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
                <div class="button">
                    <a href="publisher_create.php">Add New Publisher</a>
                </div>
                <div class="button">
                    <a href="index.php">Back to Books</a>
                </div>
            </div>
        </div>

        <div class="container">
            <?php if (empty($publishers)) { ?>
                <p>No publishers found.</p>
            <?php } else { ?>
                <div class="width-12">
                    <table class="publisher-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($publishers as $publisher) { ?>
                                <tr>
                                    <td><?= h($publisher->id) ?></td>
                                    <td><?= h($publisher->name) ?></td>
                                    <td class="actions">
                                        <a href="publisher_edit.php?id=<?= h($publisher->id) ?>">Edit</a> /
                                        <a href="publisher_delete.php?id=<?= h($publisher->id) ?>" onclick="return confirmDelete(event)">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>

        <script src="Javascript/confirm-delete.js"></script>
    </body>
</html>
