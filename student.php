<?php
session_start();
$facultyid = $_SESSION['studentid'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Page - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css"> <!-- Link to external stylesheet -->
    <style>
        body {
            background-color: #f4f7fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        #ab1 {
            text-align: center;
            padding: 60px 20px;
            background-color: #0073e6;
            color: #fff;
            background-image: url('t3.gif');
            background-size: cover;
            background-position: center;
            border: 10px solid #005bb5;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #ab1 h1 {
            font-size: 2.5rem;
            margin: 0;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            display: inline-block;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            color: #0073e6;
            text-transform: uppercase;
            border: 4px solid rgba(0, 0, 0, 0.1);
        }

        #ab1 h2 {
            font-size: 1.4rem;
            margin: 20px auto;
            padding: 10px 20px;
            width: fit-content;
            color: #005bb5;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-style: italic;
            border: 2px solid rgba(0, 0, 0, 0.1);
        }

        /* Navbar Styling */
        .navbar {
            background-color: #003366; /* Darker blue for a more professional look */
            padding: 15px 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 3px solid #002244; /* Slightly darker border */
        }

        .navbar a {
            color: #ffffff;
            text-decoration: none;
            font-size: 1rem;
            margin: 0 15px;
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: 500;
        }

        .navbar a:hover {
            background-color: #002244; /* Darker blue for hover effect */
            color: #f0f0f0;
        }

        /* Faculty Details Section */
        .faculty-details {
            margin: 30px auto;
            padding: 20px;
            border: 2px solid #005bb5;
            border-radius: 8px;
            background-color: #fff;
            width: 60%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .faculty-details h3 {
            color: #005bb5;
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 2px solid #0073e6;
            padding-bottom: 10px;
        }

        .faculty-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .faculty-details table, .faculty-details th, .faculty-details td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .faculty-details th {
            background-color: #0073e6;
            color: #fff;
        }

        .faculty-details td {
            background-color: #fafafa;
            color: #555;
        }

        .faculty-details tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .faculty-details tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Schedule Table Styling */
        .schedule-table th, .schedule-table td {
    border: 1px solid #ddd;
    padding: 15px; /* Increased padding for better spacing */
    text-align: center;
    vertical-align: middle; /* Aligns content vertically */
}

.schedule-table th {
    background-color: #0073e6;
    color: #fff;
    font-weight: bold;
}

.schedule-table td {
    background-color: #fafafa;
    color: #555;
    text-align: center; /* Centers the content inside the cells */
}

.schedule-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.schedule-table tbody tr:hover {
    background-color: #f1f1f1;
}

    </style>
</head>
<body>
    <div id="ab1">
        <h1>AUTOMATIC TIMETABLE GENERATOR</h1>
        <h2><i>An easier way to create Timetables and manage them...!!!</i></h2>
    </div>

    <div class="navbar">
        <a href="index.html">Home</a>
    </div>

    <div class="faculty-details">
    <div class="faculty-details">
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'timetable');

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM student_info WHERE student_id='$facultyid'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            echo "<h3>Student Details</h3>";
            echo "<table>";
            echo "<tr><th>Name</th><td>" . htmlspecialchars($row['student_name']) . "</td></tr>";
            echo "<tr><th>Email</th><td>" . htmlspecialchars($row['student_email']) . "</td></tr>";
            echo "<tr><th>Division</th><td>" . $row['division'] . "</td></tr>";
            echo "<tr><th>Semester</th><td>" . htmlspecialchars($row['semester']) . "</td></tr>";
            echo "<tr><th>Department</th><td>" . htmlspecialchars($row['course']) . "</td></tr>";
            echo "<tr><th>Specialization</th><td>" . $row['specialization'] . "</td></tr>";
            echo "</table>";
        
        } else {
            echo "<p>No details found for the Student.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>

    <div class="schedule-table">
        <h3 align="center">Your Schedule</h3>
        <table>
           
            <tr>
                <th>Timing</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
            <tr>
                <th>07:30 - 08:30</th>
                <td><?php                 
                echo "Library";?></td>
                <td><?php                 
                echo "PHP <br> Prof. Vinod Shah";?></td>
                <td><?php                 
                echo "JAVA <br> Prof. Neha Sharma";?></td></td>
                <td><?php                 
                echo "JAVA <br> Prof. Neha Sharma";?></td></td>
                <td><?php                 
                echo "Project";?></td>
            </tr>
            <tr>
                <th>08:30 - 09:30</th>
                <td><?php                 
                echo "JAVA <br> Prof. Neha Sharma";?></td>
                <td><?php                 
                echo "PHP <br> Prof. Vinod Shah";?></td>
                <td><?php                 
                echo "DCN <br> Prof. Shika Bansal";?></td>
                <td><?php                 
                echo "NPTEL";?></td></td>
                <td><?php                 
                echo "Comunication Skills <br> Prof. Bindi Bhat";?></td></td>
            </tr>
            <tr>
                <td colspan="6"><b>Small Break For 15 Minutes</b></td>
            </tr>
            <tr>
                <th>09:45 - 10:45</th>
                <td><?php                 
                echo "Comunication Skills <br> Prof. Bindi Bhat";?></td></td>
                <td><?php                 
                echo "Maths <br> Prof. Komal Makwana";?></td>
                <td><?php                 
                echo "Library";?></td>
                <td><?php                 
                echo "Maths <br> Prof. Komal Makwana";?></td>
                <td><?php                 
                echo "DCN <br> Prof. Shika Bansal";?></td>
            </tr>
            <tr>
                <th>10:45 - 11:45</th>
                <td><?php                 
                echo "NPTEL"?></td></td>
                <td><?php                 
                echo "DCN <br> Prof. Shika Bansal";?></td>
                <td><?php                 
                echo "PHP <br> Prof. Vinod Shah";?></td>
                <td><?php                 
                echo "PHP <br> Prof. Vinod Shah";?></td>
                <td><?php                 
                echo "Maths <br> Prof. Komal Makwana";?></td>
            </tr>
            <tr>
                <td colspan="6"><b>Lunch Break</b></td>

            </tr>
            <tr>
                <th>12:45 - 01:30</th>
                <td><?php                 
                echo "DCN <br> Prof. Shika Bansal";?></td></td>
                <td><?php                 
                echo "Project";?></td>
                <td><?php                 
                echo "Maths <br> Prof. Komal Makwana";?></td>
                <td><?php                 
                echo "JAVA <br> Prof. Neha Sharma";?></td>
                <td><?php                 
                echo "Maths <br> Prof. Komal Makwana";?></td>
            </tr>
            <tr>
                <th>01:30 - 02:25</th>
                <td><?php                 
                echo "DCN <br> Prof. Shika Bansal";?></td>
                <td><?php                 
                echo "NPTEL";?></td>
                <td></td>
                <td><?php                 
                echo "JAVA <br> Prof. Neha Sharma";?></td>
                <td><?php                 
                echo "JAVA <br> Prof. Neha Sharma";?></td>
            </tr>
        </table>
    </div>
</body>
</html>
