<?php
session_start();
if(isset($_SESSION['id'])) {
    header("Location: ./home.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "sitin";

// Connection
$connection = new mysqli($servername, $username, $password, $database);
if ($connection === false) {
    die("connection error");
}
if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $idno = $_POST['idno'];
        $password = $_POST['password'];

        if(!empty($idno) && !empty($password))
        {

            //read from database
            $query = "select * from students where idno = '$idno' limit 1";
            $result = mysqli_query($connection, $query);

            if($result)
            {
                if($result && mysqli_num_rows($result) > 0)
                {

                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['password'] === $password)
                    {

                        $_SESSION['id'] = $user_data['id'];
                        $_SESSION["log_in"] = true;
                        header("Location: ./home.php");
                    }
                }
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
            <label for="username">ID Number:</label>
            <input type="text" name="idno" id="idno" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="Login">

            <p>If you don't have an account, <a href="./register.php">Register Here</a>.</p>
            <p>Sign in as <a href="./admin/login.php">Admin</a>.</p>
        </form>
    </div>
</body>
</html>
