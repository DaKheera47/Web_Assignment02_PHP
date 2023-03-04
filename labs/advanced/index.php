<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
</head>

<body>
    <section class="container">
        <?php
        session_start();
        ?>

        <form name="form1" id="form1" action="hello.php" method="post" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input required type="text" name="username" id="username">

            <label for="email">Email:</label>
            <input required type="text" name="email" id="email">

            <label for="password">Password:</label>
            <input required type="password" name="password" id="password">

            <fieldset>
                <legend>Choose a color</legend>
                <label for="red">
                    <input required type="radio" name="color" id="red" value="red">
                    Red
                </label>

                <label for="green">
                    <input required type="radio" name="color" id="green" value="green">
                    Green
                </label>

                <label for="blue">
                    <input required type="radio" name="color" id="blue" value="blue">
                    Blue
                </label>
            </fieldset>

            <div class="grid">
                <a href="#" onclick="document.getElementById('form1').submit();" role="button">
                    Submit
                </a>

                <?php
                if (isset($_SESSION["username"])) {
                    echo '<a role="button" href="./hello.php">
                            Go to Hello PHP
                        </a>';
                }
                ?>
            </div>

        </form>
    </section>


    <script>
        function myCheck() {
            let p = document.forms["form1"]["password"].value;
            if (p == "password") {
                alert("Insecure password!");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>