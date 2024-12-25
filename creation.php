<?php
$conn = mysqli_connect('localhost', 'root', '', 'timetable');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get faculty names
$facultyQuery = "SELECT * FROM faculty_info";
$facultyResult = mysqli_query($conn, $facultyQuery);
$facultyList = [];
if (mysqli_num_rows($facultyResult) > 0) {
    while ($row = mysqli_fetch_assoc($facultyResult)) {
        $facultyList[] = $row['faculty_name'];
    }
}

// Get subjects based on the selected course and semester
$courseId = $_POST['course'];
$divisionCount = $_POST['division_count'];
$courseQuery = "SELECT * FROM course WHERE id = $courseId";
$courseResult = mysqli_query($conn, $courseQuery);
$courseDetails = mysqli_fetch_assoc($courseResult);

$subjects = [];
for ($i = 1; $i <= 5; $i++) {
    if (!empty($courseDetails["subj$i"])) {
        $subjects[] = $courseDetails["subj$i"];
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Timetable - Automatic Timetable Generator</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<div id="ab1">
    <h1><u>Timetable Generator</u></h1>
    <h2><i><u>Generating Timetable for<br>  <?php echo "Course :- ".$courseDetails['course_name']."<br>Semester:- ".$courseDetails['semester'] ?></u></i></h2>
</div>

<nav class="navbar">
  <div class="left"></div>
  <a href="index.html" class="home-link">Home</a>
</nav>
<h3 style="font-size: 1.2rem; color: #005bb5; text-align: center; margin: 20px 0;">
    Note: Small Break for 15 Mins At 8:30 to 9:45<br>
    Lunch Break At 11:45 to 12:45
</h3>

<?php
// Variables
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
$periodsPerDay = 6;
$divisions = $divisionCount;
$specialSlots = ['NPTL', 'Library', 'Break'];
$timeSlots = [
    '07:30 - 08:30',
    '08:30 - 09:30',
    '09:45 - 10:45',
    '10:45 - 11:45',
    '12:45 - 01:30',
    '01:30 - 02:25'
];

// Generate timetable
$timetable = [];
$facultyAssignments = []; // Keep track of faculty assignments per subject

// Function to ensure a subject is not repeated more than twice a day
function isValidSubject($subject, $day, $period, $division, $timetable) {
    $subjectCount = 0;
    foreach ($timetable[$division][$day] as $p => $details) {
        if ($details['subject'] == $subject) {
            $subjectCount++;
        }
    }
    return $subjectCount < 2;
}

// Function to assign a faculty to a subject
function assignFaculty($subject, &$facultyAssignments, $facultyList) {
    if (!isset($facultyAssignments[$subject])) {
        $facultyAssignments[$subject] = $facultyList[array_rand($facultyList)];
    }
    return $facultyAssignments[$subject];
}

// Generate timetable with constraints
foreach (range(1, $divisions) as $division) {
    foreach ($days as $day) {
        $periodsAssigned = [];
        
        // Assign special slots first
        foreach ($specialSlots as $slot) {
            $period = array_rand(range(1, $periodsPerDay));
            while (in_array($period, $periodsAssigned)) {
                $period = array_rand(range(1, $periodsPerDay));
            }
            $timetable[$division][$day][$period] = [
                'subject' => $slot,
                'faculty' => null
            ];
            $periodsAssigned[] = $period;
        }

        // Assign subjects to remaining periods
        for ($period = 1; $period <= $periodsPerDay; $period++) {
            if (!isset($timetable[$division][$day][$period])) {
                do {
                    $subject = $subjects[array_rand($subjects)];
                } while (!isValidSubject($subject, $day, $period, $division, $timetable));

                $faculty = assignFaculty($subject, $facultyAssignments, $facultyList);
                $timetable[$division][$day][$period] = [
                    'subject' => $subject,
                    'faculty' => $faculty
                ];
                $periodsAssigned[] = $period;
            }
        }
    }
}

// Division labels (e.g., Division A, Division B)
$divisionLabels = array_map(function($i) {
    return chr(64 + $i); // Converts 1 to A, 2 to B, etc.
}, range(1, $divisions));
?>

<?php foreach ($divisionLabels as $index => $divisionLabel): ?>
    <h3 align="center">Division <?php echo $divisionLabel; ?></h3>
    <table class="timetable">
        <thead>
            <tr>
                <th>Time Slot</th>
                <?php foreach ($days as $day): ?>
                    <th><?php echo $day; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($period = 1; $period <= $periodsPerDay; $period++): ?>
                <tr>
                    <td><b><?php echo $timeSlots[$period - 1]; ?></b></td>
                    <?php foreach ($days as $day): ?>
                        <td>
                            <?php
                            if (isset($timetable[$index + 1][$day][$period])) {
                                echo htmlspecialchars($timetable[$index + 1][$day][$period]['subject']) . "<br>";
                                if ($timetable[$index + 1][$day][$period]['subject'] !== 'NPTL' && $timetable[$index + 1][$day][$period]['subject'] !== 'Library' && $timetable[$index + 1][$day][$period]['subject'] !== 'Break') {
                                    echo htmlspecialchars($timetable[$index + 1][$day][$period]['faculty']);
                                }
                            } else {
                                echo "No class";
                            }
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
<?php endforeach; ?>

</body>
</html>
