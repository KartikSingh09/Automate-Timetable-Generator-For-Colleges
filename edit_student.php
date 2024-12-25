<?php
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch student details if ID is provided
    if (isset($_GET['id'])) {
        $student_id = $_GET['id'];
        $query = "SELECT * FROM student_info WHERE student_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $student_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $student = mysqli_fetch_assoc($result);
    }

    // Update student details if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $student_id = $_POST['student_id'];
        $student_name = $_POST['student_name'];
        $student_email = $_POST['student_email'];
        $student_subject = $_POST['student_subject'];
        $enrolled_division = $_POST['enrolled_division'];
        $enrolled_course = $_POST['enrolled_course'];

        $update_query = "UPDATE student_info 
                         SET student_name = ?, 
                             student_email = ?, 
                             student_subject = ?, 
                             enrolled_division = ?, 
                             enrolled_course = ? 
                         WHERE student_id = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, 'sssssi', $student_name, $student_email, $student_subject, $enrolled_division, $enrolled_course, $student_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<p>Record updated successfully. <a href='view_students.php' class='button'>Go back</a></p>";
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
    <title>Edit Student - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <!-- Header Section -->
    <div id="ab1">
        <h1>AUTOMATIC TIMETABLE GENERATOR</h1>
        <h2>An easier way to create Timetables and manage them...</h2>
    </div>
    
    <!-- Navbar -->
    <nav class="navbar">
        <a href="index.html">Home</a>
        <a href="add_student.php">Add New Student</a>
        <a href="view_student.php" class="active">View Student Details</a>
    </nav>

    <!-- Main Content -->
    <div id="main-content" class="fr">
        <h2>Edit Student Details</h2>
        <?php if (isset($student)): ?>
            <form method="post" action="">
                <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>">
                <label for="student_name">Name:</label>
                <input type="text" id="student_name" name="student_name" value="<?php echo htmlspecialchars($student['student_name']); ?>" required>

                <label for="student_email">Email:</label>
                <input type="email" id="student_email" name="student_email" value="<?php echo htmlspecialchars($student['student_email']); ?>" required>

                <label for="student_subject">Enrolmetn Number:</label>
                <input type="text" id="student_subject" name="student_subject" value="<?php echo htmlspecialchars($student['student_id']); ?>" required>

                <label for="enrolled_division">Division:</label>
                <input type="text" id="enrolled_division" name="enrolled_division" value="<?php echo htmlspecialchars($student['division']); ?>" required>

                <label for="enrolled_course">Course:</label>
                <input type="text" id="enrolled_course" name="enrolled_course" value="<?php echo htmlspecialchars($student['course']); ?>" required><br>

                <input type="submit" value="Update">
                <a href="view_students.php" class="button">Cancel</a>
            </form>
        <?php else: ?>
            <p>No student details found for the given ID.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>
