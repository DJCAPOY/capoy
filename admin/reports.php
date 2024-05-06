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


$students = [];


$query = "SELECT * FROM fee INNER JOIN students ON students.id = fee.student_id ";
$result = $connection->query($query);
if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $students[] = $row;
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
                        <a  href="./reports.php"class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold">Feedbacks</a>
                    </li>
                     <li>
                        <a href=".././logout.php" class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold bg-red-600 text-white px-3 p-1 rounded-md">Logout</a>
                    </li>
                </ul>
        </nav>
    </header>

    <main class=" mx-14 mt-5 flex gap-4 flex-col">
    
        <div class="flex justify-start    ">
           <h1 class="text-white text-xl font-medium">Student Reports!</h1>
        </div>
         <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs bg-gradient-to-l to-slate-800 from-gray-900 uppercase ">
                    <tr>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">NAME</th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">CONTENT</th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">SUBMITTED</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="relative">
                    
                
               

                <?php 
                if(count($students) > 0 ){
                     foreach ($students as $student) {
                   echo '<tr class="odd:bg-gray-700 bg-slate-800">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['firstname'].' '.$student['lastname'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['content'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['date_created'].'</td>
                               
                                </tr>';
                }
                }
                else {
                    echo '<tr><span class="text-semibold text-red-500">No Student found</span></tr>';
                }
           
            ?>

                </tbody>

            </table>
    
    </main>
</body>
</html>