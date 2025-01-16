<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_registration";


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = $_POST['name'];
    $regNumber = $_POST['regNumber'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $event = $_POST['event'];
    $message = $_POST['message'];

    
// Connect to the database
$conn = new mysqli("localhost", "root", "", "event_registration");
// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into  registrations (name, reg_number, contact, email, event, message)
    value(?,?,?,?,?,?)");
    $stmt->bind_param("ssisss",$name, $regNumber, $contact, $email, $event, $message);
    $stmt->execute();
}

    // Check if insertion was successful
    if ($conn->query($sql) === TRUE) {
        // Show success message and reset form
        echo "<script>
                alert('Registration successful!');
                window.location.href='index.html';
              </script>";
    } else {
        // show error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // close the connection
    $stmt->close();
    $conn->close();
   
}
?>