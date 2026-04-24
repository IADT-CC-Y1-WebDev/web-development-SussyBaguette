<?php
require_once __DIR__ . '/lib/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 10: Complete Active Record - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-10-active-record.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 10: Complete Active Record Pattern</h1>

        <h2>Task</h2>
        <p>Implement the <code>save()</code> and <code>delete()</code> methods in the Book class.</p>

        <h3>Methods to Implement:</h3>
        <ol>
            <li><code>save()</code> - INSERT if new (no id), UPDATE if existing (has id)</li>
            <li><code>delete()</code> - DELETE the record from the database</li>
        </ol>

        <h3>Test CREATE (new book):</h3>
        <div class="output">
            <?php
            $db = DB::getInstance()->getConnection();
                $stmt = $db->prepare("SELECT id FROM books WHERE title = :title");
                $stmt->execute(['title' => 'Active Record Book']);
                $existing = $stmt->fetch();

            if (!$existing) {
                try {
                    $book = new Book();
                    $book->title = "Test Book " . time();
                    $book->author = "Test Author";
                    $book->publisher_id = 1;
                    $book->year = 2024;
                    $book->description = "Created via Active Record pattern";

                    $book->save();

                echo "<p class='success'>Created game with ID: " . $book->id . "</p>";
                    echo "<p>Title: " . htmlspecialchars($book->title) . "</p>";
                } catch (Exception $e) {
                    echo "<p class='error'>Error: " . $e->getMessage() . "</p>";
                }
            } else {
                echo "<p class='info'>Demo game already exists with ID: " . $createdId['id'] . "</p>";
            }
            ?>
        </div>

        <h3>Test READ (verify creation):</h3>
        <div class="output">
            <?php
            if (!$existing) {
                $found = Book::findById($book->id);
                if ($found) {
                    echo "<p class='success'>Found created book: " . htmlspecialchars($found->title) . "</p>";
                } else {
                    echo "<p class='warning'>Could not find the created book</p>";
                }
            } else {
                echo "<p class='info'>Skipped - no book was created</p>";
            }
            ?>
        </div>

        <h3>Test UPDATE:</h3>
        <div class="output">
            <?php
            if (!$existing) {
                try {
                    $book = Book::findById($book->id);
                    if ($book) {
                        $book->title = "Updated Title " . time();
                        $book->save();
                        echo "<p class='success'>Updated book title to: " . htmlspecialchars($book->title) . "</p>";
                    }
                } catch (Exception $e) {
                    echo "<p class='warning'>UPDATE failed: " . $e->getMessage() . "</p>";
                }
            } else {
                echo "<p class='info'>Skipped - no book to update</p>";
            }
            ?>
        </div>

        <h3>Test DELETE:</h3>
        <div class="output">
            <?php
            if (!$existing) {
                try {
                    $book = Book::findById($book->id);
                    if ($book) {
                        $result = $book->delete();
                        if ($result) {
                            echo "<p class='success'>Deleted book ID: {$book->id}</p>";

                            // Verify deletion
                            $check = Book::findById($book->id);
                            if ($check === null) {
                                echo "<p class='success'>Verified: Book no longer exists</p>";
                            } else {
                                echo "<p class='warning'>Book still exists after delete</p>";
                            }
                        } else {
                            echo "<p class='warning'>delete() returned false</p>";
                        }
                    }
                } catch (Exception $e) {
                    echo "<p class='warning'>DELETE failed: " . $e->getMessage() . "</p>";
                }
            } else {
                echo "<p class='info'>Skipped - no book to delete</p>";
            }
            ?>
        </div>

        <h2>Congratulations!</h2>
        <p>If all tests pass, you have successfully implemented the Active Record pattern for the Book class!</p>

        <h3>Your Book class should now support:</h3>
        <ul>
            <li><code>Book::findAll()</code> - Get all books</li>
            <li><code>Book::findById($id)</code> - Get one book</li>
            <li><code>Book::findByPublisher($id)</code> - Get books by publisher</li>
            <li><code>$book->save()</code> - Create or update</li>
            <li><code>$book->delete()</code> - Remove from database</li>
            <li><code>$book->toArray()</code> - Convert to array</li>
        </ul>
    </div>
</body>
</html>
