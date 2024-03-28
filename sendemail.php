<?php
error_log("PHP script is being executed!");
if (isset($_POST["username"])) {
    // Read the form values and sanitize input
    $userName = isset($_POST['username']) ? filter_var($_POST['username'], FILTER_SANITIZE_STRING) : "";
    $senderEmail = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : "";
    $message = isset($_POST['contact_message']) ? filter_var($_POST['contact_message'], FILTER_SANITIZE_STRING) : "";

    // Check if required fields are not empty
    if (empty($userName) || empty($senderEmail) || empty($message)) {
        echo '<div class="failed">Please fill all the required fields.</div>';
    } else {
        // Set up email headers
        $to = "patel.vraj7255@gmail.com";
        $subject = 'Contact Us';
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        // Construct email body
        $email_body = "Name: $userName <br> Email: $senderEmail <br> Message: $message";

        // Send email
        $send_email = mail($to, $subject, $email_body, $headers);

        // Check if email was sent successfully
        if ($send_email) {
            echo '<div class="success">Email has been sent successfully.</div>';
        } else {
            echo '<div class="failed">Error: Email could not be sent.</div>';
        }
    }
} else {
    echo '<div class="failed">Failed sending your email.</div>';
}
?>