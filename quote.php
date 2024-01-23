<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize input data
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize input data
    $name = sanitizeInput($_POST["name"]);
    $email = sanitizeInput($_POST["email"]);
    $message = sanitizeInput($_POST["message"]);

    // Validate name
    if (empty($name)) {
        die("Error: Name is required");
    }

    // Validate email
    if (empty($email)) {
        die("Error: Email is required");
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format");
    }

    // Validate message
    if (empty($message)) {
        die("Error: Message is required");
    }

    // Email configuration
    $to = "eduard.eduard25@yahoo.com"; // Replace with your email address
    $subject = "New Quote Form Submission";
    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        header("Location: thankyou.html");
    } else {
        echo "Error: Unable to send the message. Please try again later.";
    }
} else {
    // Redirect users who try to access this file directly
    header("Location: quote.html");
    exit();
}
?>
