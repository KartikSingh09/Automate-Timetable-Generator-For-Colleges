<?php
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');
    $query = "SELECT * FROM course";
    $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timetable Generator - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div id="ab1">
        <h1><u>AUTOMATIC TIMETABLE GENERATOR</u></h1>
        <h2><i><u>An easier way to create Timetables and manage them...!!!</u></i></h2>
    </div>
    <nav class="navbar">
  <div class="left"></div>
  <a href="index.html" class="home-link">Home</a>
  
 
</nav>
    <form method="post" action="creation.php" class="fr">
        <label>Select Course and Semester:</label>
        <select name="course" class="form-select" >
            <option value="">--Select Course--</option>
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id'] . "'>" . $row['course_name'] . " Sem " . $row['semester'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No courses available</option>";
                }
            ?>
        </select><br><br>
        <label>Total Number of Divisions:</label>
        <input type="number" name="division_count" class="form-input" required>
        <input type="submit" value="Submit" class="form-submit">
    </form>
</body>
</html>

<?php
    mysqli_close($conn);
?>
