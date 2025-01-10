<?php
    // Set the recipient email
    $to = "chippuu715@gmail.com";

    // Sanitize and validate inputs
    $from = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_POST['name']);
    $number = htmlspecialchars($_POST['number']);
    $cmessage = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Validate phone number
    if (!preg_match('/^\d{10}$/', $number)) {
        die("Invalid phone number format");
    }

    // Prepare email headers
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // Email subject
    $email_subject = "You have a message from your website";

    // Email body
    $logo = 'img/logo.png';  // Ensure this path is correct
    $link = '#';

    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
    $body .= "<table style='width: 100%;'>";
    $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
    $body .= "<a href='{$link}'><img src='{$logo}' alt='Logo'></a><br><br>";
    $body .= "</td></tr></thead><tbody><tr>";
    $body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
    $body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
    $body .= "</tr>";
    $body .= "<tr><td style='border:none;'><strong>Phone Number:</strong> {$number}</td></tr>";
    $body .= "<tr><td colspan='2' style='border:none;'><strong>Message:</strong><br>{$cmessage}</td></tr>";
    $body .= "</tbody></table>";
    $body .= "</body></html>";

    // Send email
    if (mail($to, $email_subject, $body, $headers)) {
        // Redirect to the thank you page after the email is successfully sent
        header("Location: thank-you.html");
        exit();
    } else {
        echo "Failed to send the message. Please try again.";
    }
?>
