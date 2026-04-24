<?php
require_once __DIR__ . '/lib/config.php';
// =============================================================================
// Create PDO connection
// =============================================================================
try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
} 
catch (PDOException $e) {
    echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
    exit();
}
// =============================================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 6: DELETE Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-06-delete.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 6: DELETE Operations</h1>

        <h2>Task</h2>
        <p>Create a temporary book and then delete it.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Insert a new temporary book</li>
            <li>Display the book's ID</li>
            <li>Delete the book using a prepared statement</li>
            <li>Verify the deletion by trying to fetch it again</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // TODO: Write your solution here
            // 1. INSERT a temporary book
            // 2. Get the new ID
            // 3. Display "Created book with ID: X"
            // 4. DELETE FROM books WHERE id = :id
            // 5. Check rowCount()
            // 6. Try to fetch the book again to verify deletion

            $insertStmt = $db->prepare("INSERT INTO books (title, author, description) VALUES (:title, :author, :description)");
            $insertStmt->execute([
                'title' => 'Temporary Book to Delete',
                'author' => 'Your Name',
                'description' => 'This will be deleted.'
            ]);
            $tempId = $db->lastInsertId();
            echo "<p class='info'>Created temporary book with ID: $tempId</p>";

            $stmt = $db->prepare("DELETE FROM books WHERE id = :id");
            $stmt->execute(['id' => $tempId]);

            $deleted = $stmt->rowCount();

            if ($deleted > 0) {
                echo "<p class='success'>Deleted $deleted record(s)</p>";
            } else {
                echo "<p class='warning'>No records found to delete</p>";
            }
            
            $stmt = $db->prepare("DELETE FROM books WHERE id = :id");
            $stmt->execute(['id' => 57]);  // Non-existent ID

            if ($stmt->rowCount() === 0) {
                echo "<p class='warning'> No book found with that ID</p>";
            } else {
                echo "<p class='warning'> Book deleted</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
