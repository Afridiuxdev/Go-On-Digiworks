<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "goondigiworks@gmail.com"; // Your email
    $from_name = strip_tags($_POST["name"]);
    $from_email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = strip_tags($_POST["subject"]);
    $message = strip_tags($_POST["message"]);

    // Validate fields
    if (!filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }
    if (empty($from_name) || empty($subject) || empty($message)) {
        die("All fields are required.");
    }

    // Email content
    $email_message = "From: $from_name\n";
    $email_message .= "Email: $from_email\n\n";
    $email_message .= "Message:\n$message\n";

    // Headers
    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $email_message, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request.";
}
?>
