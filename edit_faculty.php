<?php
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
        $faculty_id = $_GET['id'];
        $query = "SELECT * FROM faculty_info WHERE faculty_id = '$faculty_id'";
        $result = mysqli_query($conn, $query);
        $faculty = mysqli_fetch_assoc($result);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $faculty_id = $_POST['faculty_id'];
        $faculty_name = $_POST['faculty_name'];
        $faculty_email = $_POST['faculty_email'];
        $faculty_subject = $_POST['faculty_subject'];
        $assigned_division = $_POST['assigned_division'];
        $assigned_course = $_POST['assigned_course'];

        $update_query = "UPDATE faculty_info 
                         SET faculty_name = '$faculty_name', 
                             faculty_email = '$faculty_email', 
                             faculty_subject = '$faculty_subject', 
                             assigned_division = '$assigned_division', 
                             assigned_course = '$assigned_course' 
                         WHERE faculty_id = '$faculty_id'";

        if (mysqli_query($conn, $update_query)) {
            echo "<p>Record updated successfully. <a href='index.html'>Go back</a></p>";
        } else {
            echo "<p>Error updating record: " . mysqli_error($conn) . "</p>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Faculty - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <!-- Header Section -->
    <div id="ab1">
        <h1>AUTOMATIC TIMETABLE GENERATOR</h1>
        <h2>An easier way to create Timetables and manage them...</h2>
    </div>
    
    <!-- Navbar -->
    <div class="navbar">
        <a href="index.html">Home</a>
        <a href="add_faculty.php">Add New Faculty</a>
        <a href="view_faculty.php">View Faculty Details</a>
    </div>

    <!-- Main Content -->
    <div id="main-content">
       
        <?php if (isset($faculty)): ?>
            <form class="fr" method="post" action="">
            <h2>Edit Faculty Details</h2>
                <input type="hidden" name="faculty_id" value="<?php echo $faculty['faculty_id']; ?>">
                <label for="faculty_name">Name:</label>
                <input type="text" id="faculty_name" name="faculty_name" value="<?php echo $faculty['faculty_name']; ?>" required>

                <label for="faculty_email">Email:</label>
                <input type="email" id="faculty_email" name="faculty_email" value="<?php echo $faculty['faculty_email']; ?>" required>

                <label for="faculty_subject">Assigned Subject:</label>
                <input type="text" id="faculty_subject" name="faculty_subject" value="<?php echo $faculty['faculty_subject']; ?>" required>

                <label for="assigned_division">Assigned Division:</label>
                <input type="text" id="assigned_division" name="assigned_division" value="<?php echo $faculty['assigned_division']; ?>" required>

                <label for="assigned_course">Assigned Course:</label>
                <input type="text" id="assigned_course" name="assigned_course" value="<?php echo $faculty['assigned_course']; ?>" required>
                <br>
                <input type="submit" value="Update">
                <a href="view_faculty.php" class="button">Cancel</a>
            </form>
        <?php else: ?>
            <p>No faculty details found for the given ID.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>
