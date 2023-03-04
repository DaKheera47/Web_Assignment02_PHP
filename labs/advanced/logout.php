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

        if (isset($_POST["action"]) && $_POST["action"] == "Logout") {
            session_destroy();
            header("Location: index.php");
        }

        if (!isset($_SESSION["username"])) {
            header("Location: index.php");
        }
        ?>

        <p>Hello <?php echo $_SESSION["username"]; ?></p>

        <p>If you're sure you want to logout, Click the button below to logout</p>

        <div class="grid">
            <a role="button" href="./index.php">
                Go back to the home page
            </a>

            <a role="button" href="./hello.php">
                Go to Hello PHP
            </a>

        </div>

        <br />

        <form method="post">
            <input type="submit" name="action" class="button secondary" value="Logout" />
        </form>

    </section>
</body>

</html>