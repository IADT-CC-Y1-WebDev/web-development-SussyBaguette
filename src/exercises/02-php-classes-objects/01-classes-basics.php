<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes Basics Exercises - PHP Classes &amp; Objects</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to Classes &amp; Objects</a>
        <a href="/examples/02-php-classes-objects/01-classes-basics.php">View Example &rarr;</a>
    </div>

    <h1>Classes Basics Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Create a Student Class File</h2>
    <p>
        <strong>Task:</strong>
        Create a new file called <code>Student.php</code> in the <code>classes/</code> folder.
        In this file, define a class called <code>Student</code> with two public properties:
        <code>$name</code> and <code>$number</code>.
    </p>
    <p>
        Then, in the code block below, use <code>require_once</code> to include your class file.
        Create an instance of the class, set the properties, and display them.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // Step 1: Create classes/Student.php with a Student class
        // Step 2: Require the file
        // require_once __DIR__ . '/classes/Student.php';
        // Step 3: Create a student and display their details

        require_once __DIR__ . '/classes/Student.php';

        //EXERCISE 1 
        // $studentID = new Student();
        // $studentID ->name = "Luke Murphy";
        // $studentID ->number = "9823746510"; 
        // echo "Name: " .$studentID ->name . "<br>";
        // echo "ID Number: " .$studentID ->number;

        $studentID = new Student("Luke Murphy", "9823746510");

        echo "Name: " .$studentID ->getName() . "<br>";
        echo "ID Number: " .$studentID ->getNumber();

        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Add a Constructor</h2>
    <p>
        <strong>Task:</strong>
        Modify your <code>Student</code> class in <code>classes/Student.php</code> to include
        a constructor that accepts <code>$name</code> and <code>$number</code> as parameters
        and sets the properties.
    </p>
    <p>
        Then create two Student objects with different values and display their details.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';

        //EXERCISE 2
        // require_once __DIR__ . '/classes/Student.php';
        // $studentID02 = new Student("Luke Murphy", "9823746510");
        // $studentID02 = new Student("Ben Conner", "9823746510");
        // echo "Name: " .$studentID01->name . "<br>";
        // echo "ID Number: " .$studentID->number;
        // echo "Name: " .$studentID02->name . "<br>";
        // echo "ID Number: " .$studentID->number;

        $studentID01 = new Student("Luke Murphy", "9823746510");
        $studentID02 = new Student("Ben Conner", "6547832190");

        echo "Name: " .$studentID01 ->getName() . "<br>";
        echo "ID Number: " .$studentID01 ->getNumber() . "<br>";
        echo "Name: " .$studentID02 ->getName() . "<br>";
        echo "ID Number: " .$studentID02 ->getNumber();

        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Add Getter Methods</h2>
    <p>
        <strong>Task:</strong>
        Add getter methods <code>getName()</code> and <code>getNumber()</code> to your
        Student class in <code>classes/Student.php</code>.
    </p>
    <p>
        Create a student and use the getter methods to display their information in a
        formatted string like: "Student [name] has number [number]".
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        // require_once __DIR__ . '/classes/Student.php';

        require_once __DIR__ . '/classes/Student.php';

        $studentID = new Student("Luke Murphy", "9823746510");

        echo "Student " . $studentID->getName() . " has number " . $studentID->getNumber() . ".";
 
        ?>
    </div>

</body>
</html>
