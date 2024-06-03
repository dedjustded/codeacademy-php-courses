<html>
<body>
<?php
function AverageGrade($students) {
    $totalGrade = 0;
    $numberOfStudents = count($students);
    foreach ($students as $name => $grade) {
        echo "$name: $grade\n";
        $totalGrade += $grade;
    }
    $averageGrade = $totalGrade / $numberOfStudents;
    return $averageGrade;
}
$students = array(
    "Alex" => 5,
    "Kircho" => 6,
    "Ivan" => 4,
    "Martin" => 3,
    "Hristo" => 5
);
$averageGrade = AverageGrade($students);
echo "Общата оценка е: " . $averageGrade;
?>
</body>
</html>