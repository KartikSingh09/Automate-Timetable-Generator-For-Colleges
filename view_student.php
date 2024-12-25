<?php
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM student_info";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Details - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div id="ab1">
        <h1>AUTOMATIC TIMETABLE GENERATOR</h1>
        <h2>An easier way to create Timetables and manage them...!!!</h2>
    </div>
    <nav class="navbar">
        <div class="left"></div>
        <a href="index.html" class="home-link">Home</a>
        <div class="left"></div>
        <a href="add_student.php" class="home-link">Add Student Details</a>
        <div class="right"></div>
    </nav>
    <div id="head">
        <h2 align="center">Student Details</h2>
        <?php
            if (mysqli_num_rows($result) > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Enrolment Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Division</th>
                                <th>Semester</th>
                                <th>Specialization</th>
                                <th>Actions</th> <!-- New column for actions -->
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $studentId = $row['student_id']; // Use this to reference student ID
                    echo "<tr>
                            <td>{$row['student_id']}</td>
                            <td>{$row['student_name']}</td>
                            <td>{$row['student_email']}</td>
                            <td>{$row['division']}</td>
                            <td>{$row['course']}-{$row['semester']}</td>
                            <td>{$row['specialization']}</td>
                            <td>
                                <a href='edit_student.php?id=$studentId' class='button'>Edit</a>
                                <a href='delete_student.php?id=$studentId' class='button' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                            </td>
                            </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No student details.</p>";
            }
        ?>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>
