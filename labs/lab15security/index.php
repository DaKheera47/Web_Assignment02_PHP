<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.*/css/pico.min.css">
</head>

<body>
    <section class="container">
        <?php require_once 'connect.php';
        // Create a variable to hold the value 1
        $id = 1;
        $stmt = $pdo->prepare("SELECT * FROM lab15security WHERE uid=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch();

        echo "<h2>" . $user['name'] . " - " . $user['email'] . "</h2>";

        // // Create three variables to hold the values (3, John Doe, JDoe@uclan.ac.uk)
        // $id = 3;
        // $name = 'John Doe';
        // $email = 'johndoe@example.com';
        // $stmt = $pdo->prepare("INSERT INTO lab15security (uid, name, email) VALUES (:id, :name, :email)");

        // // Bind the variables to the placeholders
        // $stmt->bindParam(':id', $id);
        // $stmt->bindParam(':name', $name);
        // $stmt->bindParam(':email', $email);

        // // Execute the query
        // $stmt->execute();

        // $sucess = $stmt->rowCount();

        // if ($sucess) {
        //     echo "<h2>Record added successfully</h2>";
        // } else {
        //     echo "<h2>Record not added</h2>";
        // }

        // Modify the code to use password_hash() instead of hash()
        if (isset($_GET['guess']) && !empty($_GET['guess'])) {
            $guess = $_GET['guess'];
            $password = password_hash('password', PASSWORD_DEFAULT);
            if (password_verify($guess, $password) == true) {
                echo "<h2 style='color: green;'>Your guess is correct!</h2>";
            } else {
                echo "<h2 style='color: red;'>Your guess isn't correct. Try again!</h2>";
            }

            echo "Password Hash is $password" . "<br>";
            echo "The entered passwords' hash is " . password_hash($guess, PASSWORD_DEFAULT);
        }

        // if (isset($_GET['guess']) && !empty($_GET['guess'])) {
        //     $secret = '1594244d52f2d8c12b142bb61f47bc2eaf503d6d9ca8480cae9fcf112f66e4967dc5e8fa98285e36db8af1b8ffa8b84cb15e0fbcf836c3deb803c13f37659a60';
        //     $guess = $_GET['guess'];
        //     $hash = hash('sha512', $guess);

        //     if ($hash == $secret) {
        //         echo "<h2>Correct!</h2>";
        //     } else {
        //         echo "<h2>Incorrect!</h2>";
        //     }
        // };
        ?>

        <form action="./">
            <input type="text" name="guess">
            <button type="submit">Submit!</button>
        </form>
    </section>
</body>

</html>