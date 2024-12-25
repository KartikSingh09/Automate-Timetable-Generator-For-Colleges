<?php
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
        $faculty_name = mysqli_real_escape_string($conn, $_POST['faculty_name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $faculty_email = mysqli_real_escape_string($conn, $_POST['faculty_email']);
        $faculty_subject = mysqli_real_escape_string($conn, $_POST['faculty_subject']);
        $assigned_course = mysqli_real_escape_string($conn, $_POST['assigned_course']);
        
        // Handling assigned_division as an array
        if (isset($_POST['assigned_division'])) {
            $assigned_division = implode(',', $_POST['assigned_division']);
        } else {
            $assigned_division = '';
        }

        $query = "INSERT INTO faculty_info (faculty_id, faculty_name, faculty_password, faculty_email, faculty_subject, assigned_division, assigned_course) 
                  VALUES ('$faculty_id', '$faculty_name', '$password', '$faculty_email', '$faculty_subject', '$assigned_division', '$assigned_course')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Faculty added successfully.')</script>";
        } else {
            $message = "Error: " . mysqli_error($conn);
            echo "<script>alert('$message')</script>";
        }
    }
    
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Faculty - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div id="ab1">
        <h1><u>AUTOMATIC TIMETABLE GENERATOR</u></h1>
        <h2><u><i>An easier way to create Timetables and manage them...!!!</i></u></h2>
    </div>

    <nav class="navbar">
        <a href="index.html" class="home-link">Home</a>
        <a href="view_faculty.php" class="home-link">View Faculty Details</a>
    </nav>

    <div class="fr">
        <h2>Add Faculty</h2>
        <form action="add_faculty.php" method="post">
            <div class="form-group">
                <label for="faculty_id">Faculty ID:</label>
                <input type="text" name="faculty_id" id="faculty_id" required>
            </div>
            <div class="form-group">
                <label for="faculty_name">Name:</label>
                <input type="text" name="faculty_name" id="faculty_name" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="faculty_email">Email:</label>
                <input type="email" name="faculty_email" id="faculty_email" required>
            </div>
            <div class="form-group">
                <label for="faculty_subject">Assigned Subject:</label>
                <select name="faculty_subject" id="faculty_subject" required>
                    <option value="PHP">PHP</option>
                    <option value="Java">Java</option>
                    <option value="FOW">FOW</option>
                    <option value="FOP">FOP</option>
                </select>
            </div>
            <div class="form-group">
                <label for="assigned_course">Assigned Course:</label>
                <select name="assigned_course" id="assigned_course" required>
                    <option value="BCA">BCA</option>
                    <option value="MCA">MCA</option>
                    <option value="IMCA">IMCA</option>
                    <option value="BSCIT">BSCIT</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="assigned_division">Assigned Division:</label>
                <div class="checkbox-group">
                    <input type="checkbox" name="assigned_division[]" value="A"> A
                    <input type="checkbox" name="assigned_division[]" value="B"> B
                    <input type="checkbox" name="assigned_division[]" value="C"> C
                    <input type="checkbox" name="assigned_division[]" value="D"> D
                    <input type="checkbox" name="assigned_division[]" value="E"> E
                    <input type="checkbox" name="assigned_division[]" value="F"> F
                    <input type="checkbox" name="assigned_division[]" value="G"> G
                    <input type="checkbox" name="assigned_division[]" value="H"> H
                </div>
            </div>
           
            <div class="button-group">
                <input type="submit" value="Submit" class="button">
                <input type="reset" value="Reset" class="button">
            </div>
        </form>
    </div>
</body>
</html>
