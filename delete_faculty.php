<?php
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
        $faculty_id = $_GET['id'];

        // Prepare the SQL statement to prevent SQL injection
        $stmt = $conn->prepare("DELETE FROM faculty_info WHERE faculty_id = ?");
        $stmt->bind_param("s", $faculty_id);

        if ($stmt->execute()) {
            echo "<p>Faculty record deleted successfully. <a href='view_faculty.php'>Go back</a></p>";
        } else {
            echo "<p>Error deleting record: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>No faculty ID provided.</p>";
    }

    mysqli_close($conn);
?>
