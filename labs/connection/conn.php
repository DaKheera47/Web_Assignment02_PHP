<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database connection!</title>
    <style>
        * {
            font-family: 'Source Sans Pro', sans-serif;
            transition: all 200ms linear;
            color: white;
        }

        body {
            padding: 0 5vw;
            margin: 0;
            background-color: #333;

            display: flex;
            justify-content: center;
            align-items: center;

            flex-wrap: wrap;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;

            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        li {
            padding: 20px;
            color: white;
            border-radius: 4px;
        }

        li:hover {
            background-color: #222;
        }

        .success {
            color: green;
            margin: 10px 0;
        }

        .my-4 {
            margin: 1rem 0;
        }

        .text-center {
            text-align: center;
        }

        .m-4 {
            margin: 1rem;
        }

        .border {
            border: 1px solid white;
        }

        .border:hover {
            border: 1px solid #222;
        }

        .w-full {
            width: 100%;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .select-none {
            user-select: none;
        }
    </style>
</head>

<body>
    <?php

    $host = "localhost";
    $user = "ssarfaraz";
    $pass = "xUCeLzDv";
    $db = "ssarfaraz";
    $conn = mysqli_connect($host, $user, $pass, $db);

    if (mysqli_connect_errno()) {
        echo "<p class='error my-4 w-full text-center'>ERROR: could not connect to database: " . mysqli_connect_error() . "</p>";
    } else {
        echo "<p class='success my-4 w-full text-center'> Connected to database. </p>";
    }

    $q = "SELECT * FROM modules ORDER BY title";
    $res = mysqli_query($conn, $q);

    echo "<p class='my-4 w-full text-center'>" . mysqli_num_rows($res) . " rows returned.</p>";

    echo "<ul class='my-4 w-full'>";
    while ($row = mysqli_fetch_array($res)) {
        echo "<li class='m-4 text-center border cursor-pointer select-none'>" . $row['title'] . "</li>";
    }
    echo "</ul>";

    ?>

</body>

</html>