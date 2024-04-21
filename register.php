<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sitin";

// Connection
$connection = new mysqli($servername, $username, $password, $database);

$idno = "";
$firstname = "";
$midname = "";
$lastname = "";
$age = "";
$gender = "";
$contactno = "";
$email = "";
$address = "";
$password = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idno = $_POST["idno"];
    $firstname = $_POST["firstname"];
    $midname = $_POST["midname"];
    $lastname = $_POST["lastname"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $contactno = $_POST["contactno"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

if (empty($idno) || empty($firstname) || empty($midname) || empty($lastname) || empty($age) || empty($gender) || empty($contactno) || empty($email) || empty($address) || empty($password==$cpassword)) {
        $errorMessage = "Please fill in all fields.";
    } else {
       $checkSql = "SELECT * FROM students WHERE idno = '$idno' AND email = '$email'";
	$checkResult = $connection->query($checkSql);

        if ($checkResult->num_rows > 0) {
            $errorMessage = "Error: Student is already registered.";
        } else {
            $sql = "INSERT INTO students (idno, firstname, midname, lastname, age, gender, contactno, email, address, password) VALUES ('$idno', '$firstname', '$midname', '$lastname', '$age','$gender', '$contactno', '$email', '$address', '$password')";
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Error: " . $connection->error;
            } else {
                $idno = "";
                $firstname = "";
                $midname = "";
                $lastname = "";
                $age = "";
                $gender = "";
                $contactno = "";
                $email = "";
                $address = "";
                $password="";

                $successMessage = "Student added successfully.";

                header("Location: ./login.php");
                exit;
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
    <title>Register Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('background.jpg') center/cover;
        }

        .container {
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #343a40;
        }

        .form-label {
            color: #343a40;
            font-weight: bold;
        }

        .alert {
            margin-top: 20px;
        }

        .btn-custom {
            background-color: #343a40;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #343a40;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h2>Register</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "
        <div class='alert alert-danger' role='alert'>
            <strong>Error:</strong> $errorMessage
        </div>
        ";
    }

    if (!empty($successMessage)) {
        echo "
        <div class='alert alert-success' role='alert'>
            <strong>Success:</strong> $successMessage
        </div>
        ";
    }
    ?>

    <form method="post">
    <div class="mb-3">
            <label class="form-label">ID Number</label>
            <input type="text" class="form-control" name="idno" value="<?php echo $idno; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control" name="midname" value="<?php echo $midname; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="text" class="form-control" name="age" value="<?php echo $age; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <input type="text" class="form-control" name="gender" value="<?php echo $gender; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contactno" value="<?php echo $contactno; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword" required>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-custom">Submit</button>
            </div>
            <div class="col">
                <a class="btn btn-outline-primary" href="/capoy/login.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
