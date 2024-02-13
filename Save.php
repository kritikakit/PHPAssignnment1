<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "daata";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else {
    echo "Connected successfully";
}

// Retrieve form data
$id = $_POST['uid'];
$name = $_POST['uname'];
$email = $_POST['email'];
$age = $_POST['age'];
$phone = $_POST['phone'];

// Prepare and execute the INSERT statement
$sql = "INSERT INTO mineinfo (uid, uname, email, age, phone) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
}

$stmt->bind_param("issss", $id, $name, $email, $age, $phone);

if ($stmt->execute()) {
    echo "Records inserted successfully";
}
else {
    echo "Error executing statement: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
