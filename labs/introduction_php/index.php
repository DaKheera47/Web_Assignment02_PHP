<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>An Introduction to PHP</title>
    <meta name="description" content="Web Technologies Activity Introducing PHP server-side scripting language">
    <meta name="author" content="Mark Lochrie">
    <meta property="og:title" content="An Introduction to PHP">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Web Technologies Activity Introducing PHP server-side scripting language">
</head>

<body>
    <!-- your content here... -->
    <?php echo "Hello World"; ?>

    <p>
        <?php
        $name = "Mark";
        echo "My name is $name!";

        ?>
    </p>

    <?php
    $age = 36;
    $email = "MLochrie@uclan.ac.uk";

    for ($i = 1; $i <= 10; $i++) {
        echo "<p>" . "<span style='margin: 3px;'>$i</span>" . "<span style='margin: 3px;'>$name</span> " . "<span style='margin: 3px;'>$age</span> " . "<span style='margin: 3px;'>$email</span> " . "</p>";
    }

    $x = 1;
    $y = 2;

    $z = $x + $y;

    echo "<p>$z</p>";
    ?>
</body>

</html>