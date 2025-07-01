<?php
// Connection config
$servername = "localhost";
$username = "root";        // default for XAMPP
$password = "";            // default is empty in XAMPP
$dbname = "portfolio_db";  // the database you created

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = $conn->real_escape_string(trim($_POST["name"]));
    $email = $conn->real_escape_string(trim($_POST["email"]));
    $message = $conn->real_escape_string(trim($_POST["message"]));

    // Validate fields
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Insert into DB
        $sql = "INSERT INTO contact_form (name, email, message) 
                VALUES ('$name', '$email', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Message submitted successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Please fill in all fields.";
    }
}

$conn->close();
?>

