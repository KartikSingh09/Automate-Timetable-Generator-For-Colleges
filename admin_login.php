<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div id="ab1">
        <h1>AUTOMATIC TIMETABLE GENERATOR</h1>
        <h2><i>An easier way to create and manage timetables...!!!</i></h2>
    </div>

    <div class="fr">
        <a href="index.html" class="button">Home</a>
        <form action="" method="post">
            <h2>ADMIN LOGIN</h2>
            <label for="adminid">Admin ID:</label>
            <input type="number" name="adminid" id="adminid" required>
            <label for="adminpass">Password:</label>
            <input type="password" name="adminpass" id="adminpass" required>
            <input type="submit" value="Login" class="button">
        </form>
    </div>
</body>
</html>
<?php
    // Database connection
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $adminid = mysqli_real_escape_string($conn, $_POST['adminid']);
        $adminpass = mysqli_real_escape_string($conn, $_POST['adminpass']);

        // Check credentials
        $query = "SELECT * FROM admin_info WHERE admin_id='$adminid' AND admin_password='$adminpass'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Successful login
            header("Location: admin.php");
            exit();
        } else {
            // Invalid credentials
            echo "<script>alert('Invalid Admin ID or Password.');</script>";
        }
    }

    mysqli_close($conn);
?>
