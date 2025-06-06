<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Grade Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Student Grade Calculator</h2>
    <p>Enter grades below to compute the final scores and letter grades for five students.</p>

    <form method="post">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <fieldset>
                <legend>Student <?= $i ?></legend>
                
                <label>Name:</label>
                <input type="text" name="name[]" required>

                <label>Enabling Assessments (5):</label>
                <?php for ($j = 1; $j <= 5; $j++): ?>
                    <input type="number" name="ea<?= $i ?>[]" min="0" max="100" required>
                <?php endfor; ?>

                <label>Summative Assessments (3):</label>
                <?php for ($j = 1; $j <= 3; $j++): ?>
                    <input type="number" name="sa<?= $i ?>[]" min="0" max="100" required>
                <?php endfor; ?>

                <label>Final Exam:</label>
                <input type="number" name="exam[]" min="0" max="100" required>
            </fieldset>
        <?php endfor; ?>
        <button type="submit" name="submit">Calculate Grades</button>
    </form>

    <?php if (isset($_POST['submit'])): ?>
        <h3>Grade Results</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Class Participation</th>
                    <th>Summative Grade</th>
                    <th>Final Exam</th>
                    <th>Final Grade</th>
                    <th>Letter Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < 5; $i++) {
                    $name = $_POST['name'][$i];
                    $ea = $_POST['ea'.($i+1)];
                    $sa = $_POST['sa'.($i+1)];
                    $exam = $_POST['exam'][$i];

                    $cp = array_sum($ea) / count($ea);
                    $summative = array_sum($sa) / count($sa);
                    $final = ($cp * 0.3) + ($summative * 0.3) + ($exam * 0.4);

                    if ($final >= 90) $grade = "A";
                    elseif ($final >= 80) $grade = "B";
                    elseif ($final >= 70) $grade = "C";
                    elseif ($final >= 60) $grade = "D";
                    else $grade = "F";

                    echo "<tr>
                            <td>$name</td>
                            <td>" . round($cp) . "</td>
                            <td>" . round($summative) . "</td>
                            <td>$exam</td>
                            <td>" . round($final) . "</td>
                            <td>$grade</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>

