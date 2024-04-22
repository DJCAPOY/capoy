<?php
session_start();
if(!isset($_SESSION['role'])) {
    header("Location: ./login.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "sitin";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection === false) {
    die("connection error");
}


$student = null;


if(isset($_GET['search'])){

$searchId = $connection->real_escape_string($_GET['search']);
    $query = "SELECT * FROM students WHERE idno = '$searchId' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if($result && mysqli_num_rows($result) > 0)
    {
        $student = mysqli_fetch_assoc($result);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
     <script src=".././tailwind.js"></script>
</head>
<body style="background-image: url('./background.jpg'); background-repeat: no-repeat; background-size: cover;">
    <header>
        <nav class="px-10 mx-14 mt-5 border  shadow-sm rounded-md p-2 bg-white text-black flex justify-between">
            <div>
                <div>
                    <a href="./" class="text-xl font-bold ">U-Sitin</a>
                </div>
               
            </div>
              <ul class="flex gap-3 items-center">
                    <li>
                        <a href="./search.php" class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold">Search</a>
                    </li>
                     <li>
                        <a href="./records.php" class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold">View Sit In Records</a>
                    </li>
                     <li>
                        <a  href="./generate.php"class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold">Generate Report</a>
                    </li>
                     <li>
                        <a href=".././logout.php" class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold bg-red-600 text-white px-3 p-1 rounded-md">Logout</a>
                    </li>
                </ul>
        </nav>
    </header>

    <main class=" mx-14 mt-14 flex gap-4 flex-col">
    
        <div class="flex justify-center   flex-col items-center gap-3">
            <form method="get" action ="">
               
                <input type="text" name="search"placeholder="Search student..." class="outline-none border shadow-lg px-3 p-2 rounded-md"/>
                <input type="submit" value="Search" class="bg-sky-500 px-3 shadow-lg p-2 rounded-md text-white cursor-pointer hover:bg-sky-600 duration-200 transition-colors"/>
            </form>

            
            <?php if($student != null ) { ?>
            <div class="bg-gray-500 border p-10 shadow-lg rounded-lg">
                <form action="./sitin.php" method="post" class="flex flex-col gap-4">
                 <div class="flex flex-col">
                    <label>IDNO</label>
                       <input type="text" value="<?php echo $student['idno']?>" disabled class="border px-3 p-1 rounded-md"/>
                 </div>
                <div class="flex flex-col">
                    <label>FIRST NAME</label>
                       <input type="text" value="<?php echo $student['firstname']?>" disabled class="border px-3 p-1 rounded-md"/>
                 </div>
                 <div class="flex flex-col">
                    <label>LAST NAME</label>
                       <input type="text" value="<?php echo $student['lastname']?>" disabled class="border px-3 p-1 rounded-md"/>
                 </div>
                <div class="flex flex-col">
                    <label>Sessions Available</label>
                       <input type="text" value="<?php echo $student['sessions']?>" disabled class="border px-3 p-1 rounded-md"/>
                 </div>
                <div class="flex flex-col gap-2">
                    <label class="">Purpose</label>
                    <select name="purpose" class="border p-2 rounded-md">
                        <option value="Java">Java</option>
                        <option value="Python">Python</option>
                        <option value="C">C</option>
                        <option value="C++">C++</option>
                        <option value="C#">C#</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="">Laboratory</label>
                    <select name="laboratory" class="border p-2 rounded-md">
                        <option value="Lab 524">Lab 524</option>
                        <option value="Lab 526">Lab 526</option>
                        <option value="Lab 528">Lab 528</option>
                        <option value="Lab 542">Lab 542</option>
                        <option value="Lab 543">Lab 543</option>
                    </select>
                </div>
                <input type="hidden" value="<?php echo $student['id']?>" name="id"/>
                <div class="flex flex-col gap-3">
                    <input type="submit" value="SitIn" class="bg-green-500 px-3 p-2 rounded-md w-full text-white cursor-pointer hover:bg-green-600 duration-200 transition-colors"/>
                     <a  href="./delete.php?id=<?php echo $student['id']?>" class="text-center bg-red-500 px-3 p-2 rounded-md w-full text-white cursor-pointer hover:bg-green-600 duration-200 transition-colors">Delete</a>
                </div>
                </form>
            </div>  
            <?php } else if((isset($_GET['search']) && $student == null)) { ?>
                <h1 class="text-center text-xl font-bold"> NO STUDENT FOUND</h1>
            <?php } ?>
        </div>
    </main>
</body>
</html>