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





if(isset($_GET['search'])){
    $query = "SELECT * FROM students WHERE idno = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("s", $searchId);
    $statement->execute();
    $result = $statement->get_result();
    // Fetch data and store in $students array
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    // Close the statement and connection
    $statement->close();
    $connection->close();
}else {
    $query = "SELECT * FROM students";
    $result = $connection->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }
    $connection->close();
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
<body>
    <header>
        <nav class="px-10 mx-14 mt-5 border  shadow-sm rounded-md p-2 bg-white text-black flex justify-between">
            <div>
                <div>
                    <a href="./" class="text-xl font-bold ">SitIn</a>
                </div>
               
            </div>
             <ul class="flex gap-3 items-center">
                    <li>
                        <a href="./search.php" class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold">Search</a>
                    </li>
                     <li>
                        <a class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold">View Sit In Records</a>
                    </li>
                     <li>
                        <a class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold">Generate Report</a>
                    </li>
                </ul>
        </nav>
    </header>

    <main class=" mx-14 mt-5 flex gap-4 flex-col">
    
        <div class="flex justify-end    ">
            <form method="get" action ="">
                <label>Search</label>
                <input type="text" name="search"placeholder="Search student..." class="outline-none border shadow-lg px-3 p-2 rounded-md"/>
            </form>
        </div>
         <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs bg-gradient-to-l to-slate-800 from-gray-900 uppercase ">
                    <tr>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center font-bold">ID NO
                        </th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">FIRST NAME</th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">LAST NAME</th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">EMAIL</th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="tbody" class="relative">
                    

                <?php 

            foreach ($students as $student) {
                   echo '<tr class="odd:bg-gray-700 bg-slate-800">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['idno'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['firstname'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['lastname'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['email'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-lg flex items-center justify-center text-white">
                               <a href="./student_session?id=${student.id}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                               </a>
                                <svg  xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M9 15v-4.25l9.175-9.175q.3-.3.675-.45t.75-.15q.4 0 .763.15t.662.45L22.425 3q.275.3.425.663T23 4.4q0 .375-.137.738t-.438.662L13.25 15zm10.6-9.2l1.425-1.4l-1.4-1.4L18.2 4.4zM5 21q-.825 0-1.412-.587T3 19V5q0-.825.588-1.412T5 3h8.925L7 9.925V17h7.05L21 10.05V19q0 .825-.587 1.413T19 21z"/></svg>
                               <div id="delete">
                                <input  value="${student.id}" type="hidden"/>
                                 <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"/></svg>
                               </div>
                               
                                </td></tr>';
                }
            ?>

                </tbody>

            </table>
    
    </main>
</body>
</html>