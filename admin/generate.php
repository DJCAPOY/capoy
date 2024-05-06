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



$query = "SELECT * FROM sessions INNER JOIN students ON students.id = sessions.student_id WHERE time_out IS NOT NULL ORDER BY time_out";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  
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
                        <a  href="./reports.php"class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold">Feedbacks</a>
                    </li>
                     <li>
                        <a href=".././logout.php" class="hover:text-blue-500 duration-200 transition-colors cursor-pointer font-semibold bg-red-600 text-white px-3 p-1 rounded-md">Logout</a>
                    </li>
                </ul>
        </nav>
    </header>

    <main class=" mx-14 mt-5 flex gap-4 flex-col">
    
        <div class="flex justify-end gap-4   ">
            <div class="bg-green-500 text-white px-3 p-2 rounded-md ">
                 <i class="fa-solid fa-download"></i>
                <button id="generate" class="">Export</button>
            </div>
            <div method="get" action ="">
                <label class="font-bold text-white">Search</label>
                <input id="search" type="text" name="search"placeholder="Search student..." class="outline-none border shadow-lg px-3 p-2 rounded-md"/>
            </div>
             <div>
                 <label class="font-bold text-white">Purpose</label>
                <select name="status" id="purpose" class="pr-32 text-gray-700 border p-2 rounded-md">
                                  <option value="Lab 524" selected disabled hidden>Purpose</option>
                                  <option value="Java">Java</option>
                                  <option value="Python">Python</option>
                                  <option value="C">C</option>
                                  <option value="C++">C++</option>
                                  <option value="C#">C#</option>
                                  <option value="Others">Others</option>
              </select>
             </div>
             <div>
                <label class="font-bold text-white">Laboratory</label>
               <select name="laboratory" id="laboratory" class=" pr-32 text-gray-700 border p-2 rounded-md">
                        <option value="Lab 524" selected disabled hidden>Laboratory</option>
                        <option value="Lab 524">Lab 524</option>
                        <option value="Lab 526">Lab 526</option>
                        <option value="Lab 528">Lab 528</option>
                        <option value="Lab 542">Lab 542</option>
                        <option value="Lab 543">Lab 543</option>
              </select>
            </div>
            <div class="flex items-center gap-2">
                 <label class="font-bold text-white">From Date</label>
              <input type="text" id="datetimepicker" placeholder="From Date" class="outline-none px-3 p-2 rounded-md form-input ">
              </div>
        </div>
         <table id="oktable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs bg-gradient-to-l to-slate-800 from-gray-900 uppercase ">
                    <tr>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center font-bold">ID NO
                        </th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">FIRST NAME</th>
              
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">EMAIL</th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">Purpose</th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">Laboratory</th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">Time In</th>
                        <th class="border px-4 py-4 font-medium border-none text-slate-300 text-center">Time Out</th>
                        
                    </tr>
                </thead>
                <tbody id="tbody" class="relative">
                    
                
               

                <?php 
                if(count($students) > 0 ){
                     foreach ($students as $student) {
                   echo '<tr class="odd:bg-gray-700 bg-slate-800">
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['idno'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['firstname'].' '.$student['lastname'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['email'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['purpose'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['laboratory'].'</td>
                                <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">'.$student['time_in'].'</td>
                              <td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">' . ($student['time_out'] !== null ? $student['time_out'] : '<a href="./timeout.php?id='.$student['id'].'" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>') . '</td>
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
 <script src="../xlsx.full.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>

        $(document).ready(function() {

            
            const students = <?php echo json_encode($students); ?>;
            console.log(students)

             $("#generate").click(function(){

                var table = document.getElementById('oktable');
               var wb = XLSX.utils.table_to_book(table);

    // Save the workbook as an Excel file
                XLSX.writeFile(wb, `export_data.xlsx`);
            })

            function studentRow(student,statusElement,time_in,time_out) {
                return `<tr class="odd:bg-gray-700 bg-slate-800"><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.idno}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.firstname} ${student.lastname}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.email}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.purpose}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.laboratory}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${student.time_in}</td><td class="border px-4 py-4 border-none text-center text-xs md:text-sm text-white">${statusElement}</td></tr>`
            }
            $("#search").on('input', function() {

                 if(this.value == "")
                   return restore(students);
                 let data = "";
                    students.forEach(student => {
                        const studentDate = student.time_in.split(' ')[0];
                        const time_in = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                         const time_out = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                        if(student.idno == this.value) {
                            const statusElement = student.time_out !== null 
                            ? `<span href="#" class="text-white ">${student.time_in}</span>` 
                            : `<a href="./timeout.php?id=${student['id']}&s_id=${student['session_id']}" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>`;
                            data += studentRow(student,statusElement,time_in,time_out);
                        }
                       
                    })
                   if(data != "")
                   $("#tbody").html(data)
                   else 
                    $("#tbody").html('<span class="text-xl font-semibold text-white text-center w-full">No records found</span>')
            })
            flatpickr('#datetimepicker', {
                dateFormat: "F j, Y",
                onChange: function(selectedDates, dateStr, instance) {
                    const selectedDate = formatDate(dateStr);
                    let data = "";
                    students.forEach(student => {
                        const studentDate = student.time_in.split(' ')[0];
                        const time_in = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                         const time_out = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                        if(selectedDate == studentDate) {
                            const statusElement = student.time_out !== null 
                            ? `<span href="#" class="text-white ">${student.time_in}</span>` 
                            : `<a href="./timeout.php?id=${student['id']}&s_id=${student['session_id']}" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>`;
                            data += studentRow(student,statusElement,time_in,time_out);
                        }
                       
                    })
                   if(data != "")
                   $("#tbody").html(data)
                   else 
                    $("#tbody").html('<span class="text-xl font-semibold text-white text-center w-full">No records found</span>')
                }
            
            });
             $("#purpose").change(function() {
                filter = `by_purpose_${this.value}`
                 if(this.value == "")
                   return restore(students);
                 let data = "";
                    students.forEach(student => {
                        const studentDate = student.time_in.split(' ')[0];
                        const time_in = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                         const time_out = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                        if(student.purpose == this.value) {
                            const statusElement = student.time_out !== null 
                            ? `<span href="#" class="text-white ">${student.time_in}</span>` 
                            : `<a href="./timeout.php?id=${student['id']}&s_id=${student['session_id']}" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>`;
                            data += studentRow(student,statusElement,time_in,time_out);
                        }
                       
                    })
                   if(data != "")
                   $("#tbody").html(data)
                   else 
                    $("#tbody").html('<span class="text-xl font-semibold text-white text-center w-full">No records found</span>')
            })
             $("#laboratory").change(function() {
                filter = `by_laboratory_${this.value}`
                 if(this.value == "")
                   return restore(students);
                 let data = "";
                    students.forEach(student => {
                        const studentDate = student.time_in.split(' ')[0];
                        const time_in = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                         const time_out = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                        if(student.laboratory == this.value) {
                            const statusElement = student.time_out !== null 
                            ? `<span href="#" class="text-white">${student.time_in}</span>` 
                            : `<a href="./timeout.php?id=${student['id']}&s_id=${student['session_id']}" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>`;
                            data += studentRow(student,statusElement,time_in,time_out);
                        }
                       
                    })
                   if(data != "")
                   $("#tbody").html(data)
                   else 
                    $("#tbody").html('<span class="text-xl font-semibold text-white text-center w-full">No records found</span>')
            })

            function formatDate(dateString) {
    
                const date = new Date(dateString);

                
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0'); 
                const day = String(date.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${day}`;

                return formattedDate;
            }

           function restore(students) {
                let data= "";
               
                students.forEach(student => {

                    const studentDate = student.time_in.split(' ')[0];
                        const time_in = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                    const time_out = new Date(student.time_in).toLocaleString('en-US', { month: 'long', day: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                     const statusElement = student.time_out !== null 
                            ? `<span href="#" class="text-white ">${student.time_in}</span>` 
                            : `<a href="./timeout.php?id=${student['id']}&s_id=${student['session_id']}" class="text-white bg-red-500 px-3 p-2 rounded-md">Logout</a>`;
                            data += studentRow(student,statusElement,time_in,time_out);
                })

                  if(data != "")
                   $("#tbody").html(data)
                   else 
                    $("#tbody").html('<span class="text-xl font-semibold text-white text-center w-full">No records found</span>')
                        
            }

        });
        // Initialize Flatpickr
        
    </script>
</body>
</html>