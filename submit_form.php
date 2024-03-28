<?php
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = sanitize_input($_POST['phone']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");                             // to check if the email format is correct not
    }

    $admin_email = "sunilreddy60825@gmail.com"; // my emailid as I consider myself as admin
    $admin_subject = "New Enquiry from the mail assignment web page";
    $admin_message = "Name: $name\nEmail ID: $email\nPhone Number: $phone";         // this message is going to send in the mail to admin
    if (mail($admin_email, $admin_subject, $admin_message)) {
        $user_subject = "Thank you for your enquiry";
        $user_message = "Dear $name,\n\nThank you for contacting us. We will get back to you soon.";         // this msg will be sending to the user
        if (mail($email, $user_subject, $user_message)) {
            header("Location: thank_you.html");
            exit();
        } else {
            die("Error: Failed to send email to user.");
        }
    } else {
        die("Error: Failed to send email to admin.");
    }
} else {
    die("Invalid request!");
}
?>

// so this is the assignment I hope you check it throughly and give an update as soon as possible

