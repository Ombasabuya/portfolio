<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portfolio_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Set parameters and execute
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

if ($stmt->execute() === TRUE) {
    // Send email notification
    $to = 'your-email@example.com'; // Replace with your email
    $subject = 'New Contact Form Submission';
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: noreply@yourdomain.com"; // Replace with your domain

    mail($to, $subject, $body, $headers);

    // Redirect to thank you page
    header('Location: thankyou.html');
    exit;
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
