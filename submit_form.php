<?php
// Database credentials
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = ""; // Replace with your DB password
$dbname = "ebook_store";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert the data into the database
    $sql = "INSERT INTO contacts (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Prepare email details
        $to = "youremail@example.com"; // Replace with the desired recipient email
        $subject = "New Contact Form Submission from BOOKMART";
        $body = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
        $headers = "From: no-reply@bookmart.com"; // Replace with your preferred email

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            echo "<script>alert('Message sent successfully!'); window.location.href = 'contact.html';</script>";
        } else {
            echo "<script>alert('Message saved but email sending failed.'); window.location.href = 'contact.html';</script>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
