<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Basics</title>
</head>

<body>
    <?php
    $colours = array("blue", "green", "red", "yellow");
    for ($i = 0; $i < count($colours); $i++) {
        echo $colours[$i] . "<br>";
    }
    for ($i = 0; $i < count($colours); $i++) {
        echo "<p style='color: $colours[$i]'>This text is $colours[$i]</p>";
    }
    ?>


    <?php
    // constants are global and can be used anywhere in the code
    // constants are case sensitive
    // constants are defined using the define() function

    // Write a new constant variable named MODULES which contains an array of strings of all the modules you are taking this year
    define("USERNAME", "ssarfaraz");
    define("MODULES", array("Intro to web development", "Networking", "Programming", "Systems Analysis and Database Design", "System Security", "Games Concepts"));

    // Write a for-loop to loop through the constant variable and print each module to a new line 
    for ($i = 0; $i < count(MODULES); $i++) {
        echo MODULES[$i] . "<br>";
    }

    echo "<br>";
    echo "<br>";

    for ($i = 0; $i < count(MODULES); $i++) {
        if ($i == 5) {
            echo "My favourite module is: " . MODULES[$i] . "<br>";
        } else {
            echo MODULES[$i] . "<br>";
        }
    }
    echo "<br>";
    echo "<br>";

    $my_grades = array(45, 52, 65, 30, 87, 74);

    echo "<br>";
    echo "<br>";
    // Write a foreach loop that loops through the my_grades array and prints out:
    foreach ($my_grades as $grade) {
        echo "My grade is: " . $grade . "<br>";
    }
    echo "<br>";
    echo "<br>";

    function getGradeClassification($grade)
    {
        if ($grade >= 70) {
            return "1st";
        } else if ($grade >= 60) {
            return "2:1";
        } else if ($grade >= 50) {
            return "2:2";
        } else if ($grade >= 40) {
            return "3rd";
        } else {
            return "Fail";
        }
    }

    $my_grades = array(
        "Intro to web development" => 45,
        "Networking" => 52,
        "Programming" => 65,
        "Systems Analysis and Database Design" => 30,
        "System Security" => 87,
        "Games Concepts" => 74
    );
    echo "<br>";
    echo "<br>";

    // sort the array by value
    asort($my_grades);

    foreach ($my_grades as $module => $grade) {
        echo "My grade for $module is: " . $grade . " (" . getGradeClassification($grade) . ")" . "<br>";
    }
    echo "<br>";
    echo "<br>";

    echo "My grade for my favourite module is: " . $my_grades["Games Concepts"] . " (" . getGradeClassification($my_grades["Games Concepts"]) . ")" . "<br>";

    ?>

</body>

</html>