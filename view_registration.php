<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_registration";

$conn = new mysqli("localhost", "root", "", "event_registration");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into  registrations (name, reg_number, contact, email, event, message)
    value(?,?,?,?,?,?)");
    $stmt->bind_param("ssisss",$name, $regNumber, $contact, $email, $event, $message);
    $stmt->execute();
}

// Fetch data
$sql = "SELECT * FROM registrations";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registered Participants</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Registered Participants</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Reg Number</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Event</th>
        <th>Message</th>
        <th>Registration Date</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['reg_number']}</td>
                    <td>{$row['contact']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['event']}</td>
                    <td>{$row['message']}</td>
                    <td>{$row['registration_date']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No registrations yet.</td></tr>";
    }
    ?>
</table>

</body>
</html>