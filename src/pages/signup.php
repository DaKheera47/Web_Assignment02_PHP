<?php
$tab_title = "Create an account - UCLan Student Shop";
require_once("../components/pageTop.component.php");
?>

<?php
if (isset($_POST["user_email"])) {
    $_SESSION["user_email"] = htmlspecialchars($_POST["user_email"]);
}

if (isset($_POST["user_full_name"])) {
    $_SESSION["user_full_name"] = htmlspecialchars($_POST["user_full_name"]);
}

if (isset($_POST["user_address"])) {
    $_SESSION["user_address"] = htmlspecialchars($_POST["user_address"]);
}

if (isset($_POST["user_pass"])) {
    $_SESSION["user_pass"] = htmlspecialchars($_POST["user_pass"]);
}

// if email as password arent set, skip the rest of the code
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_pass"]) && isset($_SESSION["user_full_name"]) && isset($_SESSION["user_address"])) {
    // hash password
    $hashed_password = password_hash($_SESSION["user_pass"], PASSWORD_DEFAULT);

    // check if email already exists
    $sql = "SELECT * FROM tbl_users WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $_SESSION["user_email"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["error"] = "Email already exists";
    } else {
        // insert user into database
        $sql = "INSERT INTO tbl_users (user_email, user_pass, user_full_name, user_address) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $_SESSION["user_email"], $hashed_password, $_SESSION["user_full_name"], $_SESSION["user_address"]);
        $stmt->execute();

        // check if user was inserted
        if ($stmt->affected_rows > 0) {
            // redirect to login page without header
            unset($_SESSION["user_email"]);
            unset($_SESSION["user_pass"]);
            unset($_SESSION["user_full_name"]);
            unset($_SESSION["user_address"]);
            unset($_SESSION["error"]);

            // create a session object with a success message, then redirect to login page
            $_SESSION["success"] = "Account created successfully";
            // is logged in
            $_SESSION["isLoggedIn"] = false;

            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            $_SESSION["error"] = "Something went wrong";
        }
    }
}
?>

<h1 class="mt-8 mb-4 text-4xl font-bold text-center">
    Create an account to get started
</h1>

<?php if (isset($_SESSION["error"]) && $_SESSION["error"] != "") { ?>
    <div id="toast-simple" class="flex items-center w-full max-w-md p-4 mx-auto my-6 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-200 dark:divide-gray-700 space-x dark:bg-gray-700" role="alert">
        <!-- warning icon -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke="currentColor" />
        </svg>

        <div class="pl-4 text-sm font-normal"><?php echo $_SESSION["error"] ?></div>
    </div>
<?php } ?>

<!-- sign up form -->
<form action="signup.php" method="post">
    <div class="flex flex-col max-w-md px-8 pt-6 pb-8 mx-auto mb-4 space-y-4 transition-shadow bg-white rounded shadow-md hover:shadow-xl dark:bg-gray-700">
        <div>
            <label for="user_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Email</label>
            <input required type="text" id="user_email" name="user_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ilovecats@gmail.com">
        </div>

        <div>
            <label for="user_pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Password</label>
            <input required type="user_pass" name="user_pass" id="user_pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Top Secret Password">
        </div>

        <div>
            <label for="user_full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Full Name</label>
            <input required type="text" id="user_full_name" name="user_full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alan Turing">
        </div>

        <div>
            <label for="user_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your Address</label>
            <input required type="text" id="user_address" name="user_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="NaN Boulevard, JS Land">
        </div>

        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            If you already have an account, please
            <a href="./login.php" class="font-medium text-uclan-yellow hover:underline">
                login
            </a>
            instead
        </p>

        <div class="flex items-center justify-between">
            <button type="submit" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800 flex group transition-all">
                Create Account

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hidden w-5 h-5 ml-2 group-hover:block">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zM12 2.25V4.5m5.834.166l-1.591 1.591M20.25 10.5H18M7.757 14.743l-1.59 1.59M6 10.5H3.75m4.007-4.243l-1.59-1.59" />
                </svg>
            </button>
        </div>
    </div>
</form>

<?php require_once "../components/pageBottom.component.php"; ?>