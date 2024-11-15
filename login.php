<?php
session_start(); // Start the session

require_once("conn.php"); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform validation and sanitize user inputs as needed

    // Query to retrieve user data based on email
    $sql = "SELECT * FROM registered WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Directly compare plaintext passwords
        if ($password === $row["password"]) {
            // Password is correct, set session variables
            $_SESSION["user_type"] = $row["user_type"];
            $_SESSION["email"] = $row["email"];
            
            // Redirect based on user type
            if ($_SESSION["user_type"] == "super") {
                header("Location: super.html");
            }
            else  if ($_SESSION["user_type"] == "admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit(); // Terminate script execution after redirection
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }

    // Close the database connection
    $conn->close();
}
?>
