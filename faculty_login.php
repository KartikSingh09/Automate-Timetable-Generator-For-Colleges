<?php
    session_start();
    
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $adminid = $_POST['adminid'];
        $adminpass = $_POST['adminpass'];
        
        $adminid = mysqli_real_escape_string($conn, $adminid);
        $adminpass = mysqli_real_escape_string($conn, $adminpass);
        
        $query = "SELECT * FROM faculty_info WHERE faculty_id='$adminid' AND faculty_password='$adminpass'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['facultyid'] = $adminid;
            header("Location: faculty.php");
        } else {
            echo "<script>alert('Invalid Faculty ID or Password.')</script>";
        }
    }

    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Login - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

    <div id="ab1">
        <h1>AUTOMATIC TIMETABLE GENERATOR</h1>
        <h2>An easier way to create and manage timetables...!!!</h2>
    </div>

    <div class="fr">
    <a href="index.html" class="button">Home</a>
        <form action="" method="post">
            <h2>Faculty Login</h2>
            <label for="adminid">Faculty ID</label>
            <input type="number" name="adminid" id="adminid" required>
            <label for="adminpass">Password</label>
            <input type="password" name="adminpass" id="adminpass" required>
            <input type="submit" value="Login" class="button">
        </form>
    </div>

</body>
</html>
