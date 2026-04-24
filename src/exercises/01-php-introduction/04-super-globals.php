<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Globals Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/04-super-globals.php">View Example &rarr;</a>
    </div>

    <h1>Super Globals Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Server Information</h2>
    <p>
        <strong>Task:</strong> 
        Display the following information from $_SERVER: PHP_SELF, 
        REQUEST_METHOD, HTTP_HOST, and HTTP_USER_AGENT. Format them 
        nicely with labels.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $keys = ['PHP_SELF', 'REQUEST_METHOD', 'HTTP_HOST', 'HTTP_USER_AGENT'];

        echo "<ul>";
        foreach ($keys as $key) {
            $value = isset($_SERVER[$key]) ? $_SERVER[$key] : 'N/A';
            echo "<li><strong>$key:</strong> $value</li>";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: URL Parameters</h2>
    <p>
        <strong>Task:</strong> 
        Check if a 'name' parameter exists in the URL. If it does, 
        display "Hello, [name]!". If not, display "Hello, Guest!". 
        Try adding ?name=YourName to the URL for this page.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        if (isset($_GET['name'])) {
            echo "Hello, " . htmlspecialchars($_GET['name']) . "!";
        } else {
            echo "Hello, Guest!";
        }
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Multiple URL Parameters</h2>
    <p>
        <strong>Task:</strong> 
        Check for 'product' and 'quantity' parameters in the URL. 
        If both exist, display "You ordered [quantity] [product](s)". 
        If either is missing, display appropriate error messages. 
        Try adding ?product=Widget&quantity=5 to the URL for this page.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        if (isset($_GET['product']) && isset($_GET['quantity'])) {
            $product  = htmlspecialchars($_GET['product']);
            $quantity = htmlspecialchars($_GET['quantity']);
            echo "You ordered $quantity $product(s).";
        } elseif (!isset($_GET['product'])) {
            echo "Error: missing product parameter.";
        } else {
            echo "Error: missing quantity parameter.";
        }
        ?>
    </div>

</body>
</html>
