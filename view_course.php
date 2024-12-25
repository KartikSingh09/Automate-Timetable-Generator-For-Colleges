<?php
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM course";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div id="ab1">
        <h1>AUTOMATIC TIMETABLE GENERATOR</h1>
        <h2>An easier way to create Timetables and manage them...</h2>
    </div>
    <nav class="navbar">
  <div class="left"></div>
  <a href="index.html" class="home-link">Home</a>
  
  <div class="left"></div>
  <a href="add_course.php" class="home-link">Add New Course</a>
  <div class="right"></div>
</nav>
    
    <div id="head">
        <h2 align="center">Course Details</h2>
        <?php
            if (mysqli_num_rows($result) > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Semester</th>
                                <th>Division Count</th>
                                <th>Subjects</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['course_name']}</td>
                            <td>{$row['semester']}</td>
                            <td>{$row['division_counts']}</td>
                            <td>{$row['subj1']}, {$row['subj2']}, {$row['subj3']},<br>{$row['subj4']}, {$row['subj5']}</td>
                        </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No course details available.</p>";
            }
        ?>
    
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>
