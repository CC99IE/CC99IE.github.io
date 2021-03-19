<?php
//Contact form mailing system
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

$email_from = 'elon@musk.com'; // From where we want to send the email

$email_subject ="New Form Submission";

$email_body = "User: $name.\n". 
                "Email: $visitor_email.\n"
                    "Message: $message.\n";

$to = "musk@elon.com"; // Where we want to get those emails
$headers = "From: $email_from \r\n";
$headers = "Reply-to: $visitor_email \r\n";
mail($to, $email_subject, $email_body, $headers);
header("Location: index.html");
// Database connection
$conn = new mysqli('localhost', 'root','','contact');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into registration(name, email, message)
            values(?, ?, ?, ?, ?, ?,)");
    $stmt->bind_param("sssssi", $name, $visitor_email, $message);
    $stmt->execute();
    echo "Registration has been a success";
    $stmt->close();
    $conn->close();
}
?>