<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "sitin";

// Connection
$connection = new mysqli($servername, $username, $password, $database);
if ($connection === false) {
    die("connection error");
}

if(isset($_SESSION['role']))
    header("Location: ./dashboard.php");
if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        $email = $_POST['email'];
        $password = $_POST['password'];
        if(!empty($email) && !empty($password))
        {
           if($email == 'admin@gmail.com' && $password == 'admin123')
                {
                    $_SESSION["role"] = 'admin';
                    header("Location: ./dashboard.php");
                }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('background.jpg') center/cover;
        }

        .login-container {
            background-color: #343a40;
            width: 500px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
        margin-bottom: 10px;
        color: #fff;
        }

        input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #E1E1E1;
            color: #000;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        .btn-custom {
            background-color: #E1E1E1;
            color: #000;
            border: none;
            border-radius: 5px;
            padding: 10px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #E1E1E1;
        }
        p {
        color: #fff;
        text-align: center;
        }   
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login Form</h1>
        <form action="" method="POST">
            <label for="username">Email</label>
            <input type="text" name="email" id="idno" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="Login">
            <p>Sign in as <a href="/capoy/login.php">Student</a>.</p>
        </form>
    </div>
</body>
</html>
