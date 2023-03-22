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
    <div class="flex flex-col max-w-2xl px-8 pt-6 pb-8 mx-auto mb-4 space-y-4 transition-shadow bg-white rounded shadow-md hover:shadow-xl dark:bg-gray-700">
        <div>
            <label for="user_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Your Email
            </label>
            <input required type="text" id="user_email" name="user_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username@uclan.ac.uk">
        </div>

        <div class="grid grid-cols-2 gap-x-4">
            <div>
                <label for="user_pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Your Password
                </label>
                <input required type="password" name="user_pass" id="user_pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Unhackable Password">
            </div>

            <div>
                <label for="confirm_user_pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Confirm Your Password
                </label>
                <input required type="password" name="confirm_user_pass" id="confirm_user_pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Unhackable Password">
            </div>
        </div>

        <div>
            <label for="user_full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Your Full Name
            </label>
            <input required type="text" id="user_full_name" name="user_full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Alan Turing">
        </div>

        <div>
            <label for="user_address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                Your Address
            </label>
            <input required type="text" id="user_address" name="user_address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-300 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="NaN Boulevard, JS Land">
        </div>

        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            If you already have an account, please
            <a href="./login.php" class="font-medium text-uclan-yellow hover:underline">
                login
            </a>
            instead
        </p>

        <div id="passwordMsg" class="hidden">
            <h3>Password must contain the following:</h3>
            <p id="letterMsg" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capitalMsg" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="numberMsg" class="invalid">A <b>number</b></p>
            <p id="lengthMsg" class="invalid">Minimum <b>8 characters</b></p>
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="text-green-700 enabled:hover:text-white border border-green-700 enabled:hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 enabled:dark:hover:text-white enabled:dark:hover:bg-green-600 dark:focus:ring-green-800 flex group transition-all disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn">
                Create Account
            </button>
        </div>
    </div>
</form>

<script>
    // getting all required elements
    let ePassword = document.getElementById("user_pass");
    let eConfirmPassword = document.getElementById("confirm_user_pass");
    let eLetterMsg = document.getElementById("letterMsg");
    let eCapitalMsg = document.getElementById("capitalMsg");
    let eNumberMsg = document.getElementById("numberMsg");
    let eLengthMsg = document.getElementById("lengthMsg");
    let eMessageDiv = document.getElementById("passwordMsg");
    let eSubmitBtn = document.getElementById("submitBtn");

    // regexes for specific fields
    // https://regexlearn.com/cheatsheet
    var rLowerCaseLetters = /[a-z]/g;
    var rUpperCaseLetters = /[A-Z]/g;
    var rNumbers = /[0-9]/g;

    function validatePassword() {
        let isValid = true;

        // Validate lowercase letters
        if (ePassword.value.match(rLowerCaseLetters)) {
            eLetterMsg.classList.remove("invalid");
            eLetterMsg.classList.add("valid");
        } else {
            isValid = false;
            eLetterMsg.classList.remove("valid");
            eLetterMsg.classList.add("invalid");
        }

        // Validate capital letters
        if (ePassword.value.match(rUpperCaseLetters)) {
            eCapitalMsg.classList.remove("invalid");
            eCapitalMsg.classList.add("valid");
        } else {
            isValid = false;
            eCapitalMsg.classList.remove("valid");
            eCapitalMsg.classList.add("invalid");
        }

        // Validate numbers
        if (ePassword.value.match(rNumbers)) {
            eNumberMsg.classList.remove("invalid");
            eNumberMsg.classList.add("valid");
        } else {
            isValid = false;
            eNumberMsg.classList.remove("valid");
            eNumberMsg.classList.add("invalid");
        }

        // Validate length
        if (ePassword.value.length >= 8) {
            eLengthMsg.classList.remove("invalid");
            eLengthMsg.classList.add("valid");
        } else {
            isValid = false;
            eLengthMsg.classList.remove("valid");
            eLengthMsg.classList.add("invalid");
        }

        return isValid;
    }

    function areBothPasswordsSame() {
        console.log(ePassword.value, eConfirmPassword.value);
        return ePassword.value === eConfirmPassword.value;
    }

    // When the user clicks on the password field, show the message box
    ePassword.onfocus = function() {
        eMessageDiv.classList.remove("hidden");
    }

    // When the user clicks outside of the password field, hide the message box
    ePassword.onblur = function() {
        eMessageDiv.classList.add("hidden");
    }

    // When the user starts to type something inside the password field
    ePassword.onkeyup = function() {
        // Validate password
        if (validatePassword() && areBothPasswordsSame()) {
            eSubmitBtn.disabled = false;
        } else {
            eSubmitBtn.disabled = true;
        }
    }

    // When the user starts to type something inside the password field
    eConfirmPassword.onkeyup = function() {
        // Validate password
        if (validatePassword() && areBothPasswordsSame()) {
            eSubmitBtn.disabled = false;
        } else {
            eSubmitBtn.disabled = true;
        }
    }

    // for when the page is loaded
    eSubmitBtn.disabled = true;
</script>


<?php require_once "../components/pageBottom.component.php"; ?>