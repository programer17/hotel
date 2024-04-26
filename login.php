php
<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel_reservation_system";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if the user exists
    if ($result->num_rows > 0) {
        // User found, set session variables and redirect to home page
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        // User not found, display error message
        echo "Invalid username or password.";
    }

    // Close the connection
    $conn->close();
}
?>
