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

// Check for form submission
// if (isset($_POST['submit'])) {
    // Get form data
    $username = $_POST['email'];
    $password = $_POST['psw'];

    try {
        // create a PDO instance
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    
        // prepare a SELECT query using a prepared statement
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM accounts WHERE username = :value");
    
        // bind the value to the prepared statement parameter
        $stmt->bindValue(':value', $username);
    
        // execute the prepared statement
        $stmt->execute();
    
        // fetch the result of the query
        $count = $stmt->fetchColumn();
    
        // check if the value is present in the database
        if ($count > 0) {
            echo "The username '$username' has been taken please choose another";
            sleep(2);
        } else {
            echo "An account by the name '$username' has been created";
            sleep(2);
            $stmt = $conn->prepare("INSERT INTO $table (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
        }
    
    } catch (PDOException $e) {
        // handle any errors that occur during the database connection or query execution
        echo "Error: " . $e->getMessage();
    }

    // Insert user into database

    header('Location: http://localhost/application/CSI2132-Course-Project-Deliverable/homepage.html');
    exit();
?>