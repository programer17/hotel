<?php
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

// Function to add a new hotel
function addHotel($name, $address, $city, $state, $country) {
    global $conn;
    $sql = "INSERT INTO hotels (name, address, city, state, country) VALUES ('$name', '$address', '$city', '$state', '$country')";
    if ($conn->query($sql) === TRUE) {
        echo "Hotel added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to edit a hotel
function editHotel($id, $name, $address, $city, $state, $country) {
    global $conn;
    $sql = "UPDATE hotels SET name='$name', address='$address', city='$city', state='$state', country='$country' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Hotel updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Function to delete a hotel
function deleteHotel($id) {
    global $conn;
    $sql = "DELETE FROM hotels WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Hotel deleted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Example usage: Add a new hotel
addHotel("Hotel ABC", "123 Main Street", "New York", "NY", "USA");

// Example usage: Edit an existing hotel
editHotel(1, "Hotel XYZ", "456 Elm Street", "Los Angeles", "CA", "USA");

// Example usage: Delete a hotel
deleteHotel(1);

// Close the connection
$conn->close();
?>