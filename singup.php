<?php
require_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $user = $_POST["user"]; // Get the selected user type

    // Perform validation and sanitize user inputs as needed

    // Insert user data into the temp_reg table
    $sql = "INSERT INTO registered  (name, email, password, user) VALUES ('$name', '$email', '$password', '$user')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Your account will be approved soon.');</script>";
        echo "<script>window.location.href = 'login.html';</script>";
        exit(); // Terminate script execution to ensure the redirection happens
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
