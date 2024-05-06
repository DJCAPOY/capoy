<?php

session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ./login.php");
}
$id = $_SESSION['id'];
$servername = "localhost";
$username = "root";
$password = "";
$database = "sitin";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection === false) {
    die("connection error");
}

$student = "";
$query = "SELECT * FROM students WHERE id = '$id' LIMIT 1";
$result = mysqli_query($connection, $query);
if($result && mysqli_num_rows($result) > 0)
{
        $student = mysqli_fetch_assoc($result);
}
echo $id;
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home</title>
</head>
<body style="background-image: url('./background.jpg'); background-repeat: no-repeat; background-size: cover;">
    

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
          <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">U-Sitin</span>
      </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-200 dark:border-gray-100" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-200">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="./home.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-[#2672E3] hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-[#2672E3] dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ms-3 ">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="./history.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
               </svg>
               <span class="flex-1 ms-3 hover:text-white text-gray-700 whitespace-nowrap">History</span>
            </a>
         </li>
          <li>
            <a href="./report.php" class="flex items-center text-[#2672E3] p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
               </svg>
               <span class="flex-1 ms-3 hover:text-white text-gray-700 whitespace-nowrap">Report</span>
            </a>
         </li>
         <li>
            <a href="./settings.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                  <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
               </svg>
               <span class="flex-1 ms-3 hover:text-white text-gray-700 whitespace-nowrap">Settings</span>
            </a>
         </li>
         <li>
            <a href="./logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
               </svg>
               <span class="flex-1 ms-3 hover:text-white text-gray-700 whitespace-nowrap">Sign-Out</span>
            </a>
         </li>
      </ul>
   </div>
</aside>
<main class="ml-72 text-black mt-20">
    <div class="flex flex-col">
      <span class="text-xl text-center text-white">Welcome <?php echo $student['firstname'];?>!</span>
      <span class="text-xl  text-center text-white">You have <?php echo $student['sessions'];?> sessions available!</span>
        <div class="bg-gray-700 bg-opacity-40 text-white mt-8 rounded-lg shadow-lg p-8  w-full pr-25">
        <h2 class="text-2xl font-semibold mb-4 text-center">LABORATORY RULES AND REGULATIONS</h2>
        <ol class="list-decimal pl-6">
            <li class="mb-2">Maintain silence, proper decorum, and discipline inside the laboratory. Mobile phones, walkmans and other personal pieces of equipment must be switched off.</li>
            <li class="mb-2">Games are not allowed inside the lab. This includes computer-related games, card games and other games that may disturb the operation of the lab.</li>
            <li class="mb-2">Surfing the Internet is allowed only with the permission of the instructor. Downloading and installing of software are strictly prohibited.</li>
            <li class="mb-2">Getting access to other websites not related to the course (especially pornographic and illicit sites) is strictly prohibited.</li>
            <li class="mb-2">Deleting computer files and changing the set-up of the computer is a major offense.</li>
            <li class="mb-2">Observe computer time usage carefully. A fifteen-minute allowance is given for each use. Otherwise, the unit will be given to those who wish to “sit-in”.</li>
            <li class="mb-2">Observe proper decorum while inside the laboratory:
                <ol class="list-disc pl-6">
                    <li>Do not get inside the lab unless the instructor is present.</li>
                    <li>All bags, knapsacks, and the likes must be deposited at the counter.</li>
                    <li>Follow the seating arrangement of your instructor.</li>
                    <li>At the end of class, all software programs must be closed.</li>
                    <li>Return all chairs to their proper places after using.</li>
                </ol>
            </li>
            <li class="mb-2">Chewing gum, eating, drinking, smoking, and other forms of vandalism are prohibited inside the lab.</li>
            <li class="mb-2">Anyone causing a continual disturbance will be asked to leave the lab. Acts or gestures offensive to the members of the community, including public display of physical intimacy, are not tolerated.</li>
            <li class="mb-2">Persons exhibiting hostile or threatening behavior such as yelling, swearing, or Disregarding requests made by lab personnel will be asked to leave the lab.</li>
            <div class="bg-gray-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">DISCIPLINARY ACTION</h2>
            <p class="mb-2"><strong>First Offense:</strong> The Head or the Dean or OIC recommends to the Guidance Center for a suspension from classes for each offender.</p>
            <p class="mb-2"><strong>Second and Subsequent Offenses:</strong> A recommendation for a heavier sanction will be endorsed to the Guidance Center.</p>
        </div>
        </ol>
    </div>
    </div>
</main>
</body>
</html>