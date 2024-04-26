<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "hotel_reservation_system";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get room types from the database
$sql = "SELECT * FROM room_types";
$result = $conn->query($sql);

// Store room types in an array
$roomTypes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $roomTypes[$row['id']] = $row['name'];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $roomTypeId = $_POST['room_type'];
    $fromDate = $_POST['from_date'];
    $toDate = $_POST['to_date'];

    // Perform reservation logic here
    // ...

    // Example: Display the selected room type and dates
    echo "Selected Room Type: " . $roomTypes[$roomTypeId] . "<br>";
    echo "From Date: " . $fromDate . "<br>";
    echo "To Date: " . $toDate . "<br>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservations</title>
    <link href="bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    <h1>Reservations</h1>
    <form action="reservations.php" method="POST">
        <label for="room_type">Room Type:</label>
        <select id="room_type" name="room_type" required>
            <option value="">Select Room Type</option>
            <?php foreach ($roomTypes as $id => $name) { ?>
                <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
            <?php } ?>
        </select><br><br>
        <label for="from_date">From Date:</label>
        <input type="date" id="from_date" name="from_date" required><br><br>
        <label for="to_date">To Date:</label>
        <input type="date" id="to_date" name="to_date" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>