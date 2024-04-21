<?php 

session_start();
if(!isset($_SESSION['role'])) {
    header("Location: ./login.php");
}
if(!isset($_GET['id']))
    header("Location: ./records.php");
$servername = "localhost";
$username = "root";
$password = "";
$database = "sitin";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection === false) {
    die("connection error");
}
$studentId = $_GET['id']; 

$query = "DELETE FROM sessions WHERE student_id = '$studentId'";
$result = $connection->query($query);

// Check if the deletion was successful
if (!$result) {
    $errorMessage = "Error: " . $conn->error;
    // Handle the error here, e.g., display an error message
    return;
}
$query = "DELETE FROM students WHERE id = '$studentId'";
$result = $connection->query($query);

// Check if the deletion was successful
if (!$result) {
    $errorMessage = "Error: " . $connection->error;
    // Handle the error here, e.g., display an error message
} else {
    echo "Record deleted successfully";
}

// Close the connection
$connection->close();

?>