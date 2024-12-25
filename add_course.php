<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div id="ab1">
        <h1>AUTOMATIC TIMETABLE GENERATOR</h1>
        <h2>An easier way to create Timetables and manage them...</h2>
    </div>
    
    <div id="main-content">
       
        
        <div class="navbar">
            <a href="view_course.php" class="button">View Course Details</a>
            <a href="index.html" class="button">Home</a>
        </div>

        <form action="add_course.php" method="post" class="fr">
        <h2>Add Course</h2>
            <label for="course_name">Course Name:</label>
            <input type="text" name="course_name" id="course_name" required>

            <label for="semester">Semester:</label>
            <input type="number" name="semester" id="semester" required>

            <label for="division_counts">Division Count:</label>
            <input type="number" name="division_counts" id="division_counts" required>

            <label for="subj1">Subject 1:</label>
            <input type="text" name="subj1" id="subj1" required>

            <label for="subj2">Subject 2:</label>
            <input type="text" name="subj2" id="subj2">

            <label for="subj3">Subject 3:</label>
            <input type="text" name="subj3" id="subj3">

            <label for="subj4">Subject 4:</label>
            <input type="text" name="subj4" id="subj4">

            <label for="subj5">Subject 5:</label>
            <input type="text" name="subj5" id="subj5"><br><b r>

            <input type="submit" value="Add Course" class="button">
            <input type="reset" value="Reset" class="button">
        </form>
    </div>
</body>
</html>

<?php
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
        $semester = mysqli_real_escape_string($conn, $_POST['semester']);
        $division_counts = mysqli_real_escape_string($conn, $_POST['division_counts']);
        $subj1 = mysqli_real_escape_string($conn, $_POST['subj1']);
        $subj2 = mysqli_real_escape_string($conn, $_POST['subj2']);
        $subj3 = mysqli_real_escape_string($conn, $_POST['subj3']);
        $subj4 = mysqli_real_escape_string($conn, $_POST['subj4']);
        $subj5 = mysqli_real_escape_string($conn, $_POST['subj5']);

        $query = "INSERT INTO course
                  VALUES ('','$course_name', '$semester', '$division_counts', '$subj1', '$subj2', '$subj3', '$subj4', '$subj5')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Course added successfully.....!!')</script>";
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }
    }

    mysqli_close($conn);
?>
