<?php
// Database configuration
$dbhost = "localhost";
$dbname = "mysql";
$dbuser = "elias";
$dbpass = "Databases2132"; // if you have set a password for the user, enter it here
$table = "accounts";

// Connect to the database
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Get form data
    $username = $_POST['usernm'];
    $password = $_POST['pass'];

    // create a PDO instance
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

    // prepare a SELECT query using a prepared statement
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM accounts WHERE username = :username AND password = :password");

    // bind the values to the prepared statement parameters
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    // execute the prepared statement
    $stmt->execute();

    // fetch the result of the query
    $count = $stmt->fetchColumn();

    // check if the username and password are present in the database
    if ($count > 0) {
        echo "Login successful";
        header('Location: http://localhost/application/CSI2132-Course-Project-Deliverable/index.html');
        exit();
    } else {
        echo "Invalid username or password";
        sleep(2);
        header('Location: http://localhost/application/CSI2132-Course-Project-Deliverable/homepage.html');
        exit();
    }
    

?>