<?php
session_start();


if(!isset($_SESSION['role'])) {
    header("Location: ./login.php");
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
                        <a class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold">Generate Report</a>
                    </li>
                     <li>
                        <a href=".././logout.php" class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold bg-red-600 text-white px-3 p-1 rounded-md">Logout</a>
                    </li>
                </ul>
        </nav>
    </header>

    <main class=" mx-14 mt-5 flex gap-4">
      
            <div class="border shadow-lg p-5">
                <span>Total Students</span>
                <p>56</p>
            </div>

    </main>
</body>
</html>