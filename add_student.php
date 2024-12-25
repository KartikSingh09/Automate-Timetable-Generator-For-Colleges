<?php
$conn = mysqli_connect('localhost', 'root', '', 'timetable');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
    $division = mysqli_real_escape_string($conn, $_POST['division']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);

    $query = "INSERT INTO student_info VALUES ('$student_id', '$student_name', '$student_email', '$division', '$semester', '$course', '$password', '$specialization')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Student added successfully....!')</script>";
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<div id="ab1">
    <h1><u>AUTOMATIC TIMETABLE GENERATOR</u></h1>
    <h2><u><i>An easier way to create Timetables and manage them...!!!</i></u></h2>
</div>
<nav class="navbar">
  <div class="left"></div>
  <a href="index.html" class="home-link">Home</a>
  
  <div class="left"></div>
  <a href="view_student.php" class="home-link">View Students Details</a>
  <div class="right"></div>
</nav>
<div id="head">
<form action="add_student.php" method="post" class="fr">
  <h2 style="text-align:center;">Add Student Details</h2>
  <div class="form-group">
    <label for="student_id">Enrolment Number: 
      <input type="text" name="student_id" id="student_id" required>
    </label>
  </div>
  <div class="form-group">
    <label for="student_name">Name:
      <input type="text" name="student_name" id="student_name" required>
    </label>
  </div>
  <div class="form-group">
    <label for="student_email">Email:
      <input type="email" name="student_email" id="student_email" required>
    </label>
  </div>
  <div class="form-group">
    <label for="division">Division:
      <select name="division" id="division" required>
        <option value="">Select Division</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
      </select>
    </label>
  </div>
  <div class="form-group">
    <label for="semester">Semester:
      <input type="number" name="semester" id="semester" required>
    </label>
  </div>
  <div class="form-group">
    <label for="course">Course:
      <input type="text" name="course" id="course" required>
    </label>
  </div>
  <div class="form-group">
    <label for="password">Password:
      <input type="password" name="password" id="password" required>
    </label>
  </div>
  <div class="form-group">
    <label for="specialization">Specialization:
      <input type="text" name="specialization" id="specialization" required>
    </label>
  </div>
  <input type="submit" value="Add Student">
  <input type="reset" value="Reset">
</form>
</div>
</body>
</html>
