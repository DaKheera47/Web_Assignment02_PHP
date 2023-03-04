<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello PHP</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
</head>

<body>
    <section class="container">
        <?php
        if (isset($_POST["username"])) {
            $_SESSION["username"] = htmlspecialchars($_POST['username']);
        }

        if (isset($_POST["email"])) {
            $_SESSION["email"] = htmlspecialchars($_POST['email']);
        }

        if (isset($_POST["password"])) {
            $_SESSION["password"] = htmlspecialchars($_POST['password']);
        }

        if (isset($_POST["color"])) {
            $_SESSION["color"] = htmlspecialchars($_POST['color']);
        }

        if ($_SESSION["password"] == 'password') {
            echo '<p>Insecure password!</p>';
        } else {
            echo '<p>Hello ' . $_SESSION["username"] . '</p>';
        }
        ?>

        <div style="background-color: <?php echo $_SESSION["color"]; ?>;">
            <p>You selected <?php echo $_SESSION["color"]; ?> which is why the background of this div is also <?php echo $_SESSION["color"]; ?></p>
        </div>

        <div class="grid">
            <a role="button" href="./index.php">
                Go back to the home page
            </a>

            <?php
            if ($_SESSION["username"] == 'admin') {
                echo '<a role="button" href="./private.php">
                Go to the private page
            </a>';
            }
            ?>

            <a role="button" href="./logout.php">
                Logout
            </a>
        </div>


    </section>
</body>

</html>