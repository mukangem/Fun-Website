<?php
session_start();
include 'db.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL injection by using prepared statements
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a session and redirect to ebooks.html
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: ebooks.html");
            exit();
        } else {
            // Invalid password, redirect back with an error
            $_SESSION['error'] = "Incorrect password.";
            header("Location: account.html");
            exit();
        }
    } else {
        // Invalid email, redirect back with an error
        $_SESSION['error'] = "No account found with that email.";
        header("Location: account.html");
        exit();
    }
}
?>
