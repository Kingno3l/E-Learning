
<?php
// Database credentials
$host = "localhost";
$user = "root";
$password = "";
$database = "elearning";

// Create a database connection
$con = new PDO("mysql:host=$host;dbname=$database", $user, $password);

// Check if the connection is successful
if ($con->errorCode() != null) {
    $errorInfo = $con->errorInfo();
    die("Connection failed: " . $errorInfo[2]);
} else {
    echo "Connection successful!";
    // Execute SQL queries here
}

// Close the database connection when you're done
//$con = null;
?>
