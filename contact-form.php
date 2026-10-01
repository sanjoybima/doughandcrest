<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: contact.html");
    exit;
}

// Get form data
$full_name = trim($_POST['full_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$phone     = trim($_POST['phone'] ?? '');
$help_type = trim($_POST['help_type'] ?? '');
$message   = trim($_POST['message'] ?? '');

// Validate
if (empty($full_name) || empty($email) || empty($phone) || empty($help_type) || empty($message)) {
    die("Please fill in all required fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Please enter a valid email address.");
}

// Restaurant email address
$to = "sales@dough&crest.com";

// Email subject
$subject = "New Contact Form - Dough & Crest";

// Email body
$email_body = "
You have received a new enquiry from your website.

Name: $full_name
Email: $email
Phone: $phone
How can we help: $help_type

Message:
$message
";

// Email headers
$headers  = "From: Dough & Crest Website <no-reply@yourdomain.com>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
if (mail($to, $subject, $email_body, $headers)) {

    // Redirect after successful submission
    header("Location: thank-you.html");
    exit;

} else {
    echo "Sorry, your message could not be sent. Please try again.";
}
?>