<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
?>

<?php
if (isset($_POST["user_email"])) {
    $_SESSION["user_email"] = htmlspecialchars($_POST["user_email"]);
}

if (isset($_POST["user_pass"])) {
    $_SESSION["user_pass"] = htmlspecialchars($_POST["user_pass"]);
}

// // redirect to products page if user is logged in
// if (isset($_SESSION["user_email"]) && isset($_SESSION["user_pass"])) {
//     header("Location: products.php");
//     exit();
// }

// if email as password arent set, skip the rest of the code
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_pass"])) {
    // hash password
    $hashed_password = password_hash($_SESSION["user_pass"], PASSWORD_DEFAULT);

    // check if email already exists
    $sql = "SELECT * FROM tbl_users WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["user_email"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // check if password is correct
        $row = $result->fetch_assoc();
        if (password_verify($_SESSION["user_pass"], $row["user_pass"])) {
            // set session variables
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["user_email"] = $row["user_email"];
            $_SESSION["user_full_name"] = $row["user_full_name"];
            $_SESSION["user_address"] = $row["user_address"];

            // is logged in
            $_SESSION["isLoggedIn"] = true;

            // redirect to products page without header
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            $_SESSION["error"] = "Incorrect password";
        }
    } else {
        $_SESSION["error"] = "Email does not exist, please <a class='underline' href='signup.php'>sign up</a> before logging in";
    }
}

?>

<h1 class="mt-8 mb-4 text-4xl font-bold text-center js-show-on-scroll">
    Log In To Access your Account
</h1>

<?php if (isset($_SESSION["error"]) && $_SESSION["error"] != "") { ?>
    <div id="toast-simple" class="flex items-center w-full max-w-md p-4 mx-auto my-6 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow js-show-on-scroll dark:text-gray-200 dark:divide-gray-700 space-x dark:bg-gray-700" role="alert">
        <!-- warning icon -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke="currentColor" >
        </svg>

        <div class="pl-4 text-sm font-normal"><?php echo $_SESSION["error"] ?></div>
    </div>
<?php } ?>

<!-- login form -->
<form class="js-show-on-scroll" action="login.php" method="post">
    <div class="flex flex-col max-w-md px-8 pt-6 pb-8 mx-auto mb-4 space-y-4 transition-shadow bg-white rounded shadow-md hover:shadow-xl dark:bg-gray-700">
        <div class="mb-4">
            <label for="user_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
            <input type="text" name="user_email" id="user_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com">
        </div>

        <div class="mb-2">
            <label for="user_pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Password</label>
            <input type="password" name="user_pass" id="user_pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="user_pass">
        </div>

        <p id="helper-text-explanation" class="mt-2 mb-6 text-sm text-gray-500 dark:text-gray-400">
            If you don't have an account, please
            <a href="./signup.php" class="font-medium text-uclan-yellow hover:underline">
                sign up
            </a>
            instead
        </p>

        <div class="flex items-center justify-between">
            <button type="submit" class="px-4 py-2 mb-2 mr-2 text-sm font-medium text-center text-green-500 border border-green-500 rounded-md hover:text-white hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                Log In
            </button>
        </div>
    </div>
</form>

<?php require_once "../components/pageBottom.component.php"; ?>