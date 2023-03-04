<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Page</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
</head>

<body>
    <section class="container">
        <?php
        session_start();
        if (isset($_SESSION["username"]) && $_SESSION["username"] == 'admin') {
            echo '<p>Hello admin</p>';
        } else {
            header("Location: index.php");
        }
        ?>

        <div class="grid">
            <a role="button" href="./index.php">
                Go back to the home page
            </a>

            <a role="button" href="./hello.php">
                Go to Hello PHP
            </a>

            <a role="button" href="./logout.php">
                Logout
            </a>
        </div>

    </section>
</body>

</html>