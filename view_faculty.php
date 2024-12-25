<?php
    $conn = mysqli_connect('localhost', 'root', '', 'timetable');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM faculty_info";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Details - Automatic Timetable Generator</title>
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
        <a href="index.html" class="active">Home</a>
        <a href="add_faculty.php" class="active">Add New Faculty</a>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <h1 align="center">Faculty Details</h1>
        <?php
            if (mysqli_num_rows($result) > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Faculty ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Assigned Subject</th>
                                <th>Assigned Division</th>
                                <th>Assigned Course</th>
                                <th>Actions</th> <!-- New column for actions -->
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['faculty_id']}</td>
                            <td>{$row['faculty_name']}</td>
                            <td>{$row['faculty_email']}</td>
                            <td>{$row['faculty_subject']}</td>
                            <td>{$row['assigned_division']}</td>
                            <td>{$row['assigned_course']}</td>
                            <td>
                                <a href='edit_faculty.php?id={$row['faculty_id']}' class='button'>Edit</a>
                                <a href='delete_faculty.php?id={$row['faculty_id']}' class='button' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                            </td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>No faculty details found.</p>";
            }
        ?>
    </div>
</body>
</html>

<?php
    mysqli_close($conn);
?>
