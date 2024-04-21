<?php 
session_start();

if(!isset($_SESSION['role']))
    header("Location: ./login.php");
$servername = "localhost";
$username = "root";
$password = "";
$database = "sitin";

// Connection
$connection = new mysqli($servername, $username, $password, $database);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $id = $_POST['id'];
    $query = "SELECT * FROM sessions WHERE student_id = '$id'  AND time_out IS NULL";
    $result = mysqli_query($connection, $query);
    if($result && mysqli_num_rows($result) <= 0)
    {
        $purpose = $_POST['purpose'];
        $laboratory = $_POST['laboratory'];

        $sql = "INSERT INTO sessions ( student_id, laboratory, purpose) VALUES ('$id', '$laboratory', '$purpose')";
        $result = $connection->query($sql);
        if (!$result) {
            $errorMessage = "Error: " . $connection->error;

            return;
        }
        header('Location: ./records.php');
    }

    header("Location: ./records.php");

}

?>