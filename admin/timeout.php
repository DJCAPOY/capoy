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

// Connection
$connection = new mysqli($servername, $username, $password, $database);
$newTimeOut = date("Y-m-d H:i:s");
$studentId = $_GET['id']; 

$query = "UPDATE sessions SET time_out = '$newTimeOut' WHERE student_id = '$studentId'";
$result = $connection->query($query);

if (!$result) {
    $errorMessage = "Error: " . $connection->error;
}
$student = null;
$query = "SELECT * FROM students WHERE id = '$studentId' LIMIT 1";
$result = mysqli_query($connection, $query);
if($result && mysqli_num_rows($result) > 0)
{
    $student = mysqli_fetch_assoc($result);
}
$newSession = $student['sessions'] - 1;
$query = "UPDATE students SET sessions = '$newSession' WHERE id = '$studentId'";
$result = $connection->query($query);

if (!$result) {
    $errorMessage = "Error: " . $connection->error;
} else {
    header("Location: ./records.php");
}
?>