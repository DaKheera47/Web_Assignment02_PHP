<?php
$tab_title = "Profile Page - UCLan Student Shop";
require_once "../components/pageTop.component.php";

// check if user is logged in
if (!isset($_SESSION["isLoggedIn"]) || $_SESSION["isLoggedIn"] == false) {
    echo "<script>window.location.href = '../pages/login.php';</script>";
}

// get user data
$sql = "SELECT * FROM tbl_users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>

<div class="mb-12">
    <h1 class="heading">Settings</h1>

    <p>Here is the settings page for <?php echo $_SESSION["user_full_name"] ?></p>

    <div class="my-8">
        <div class="w-full">
            <p class="mb-3 text-2xl">Choose your theme</p>

            <div class="grid grid-cols-2 gap-x-4">
                <div onclick="enableDarkMode()" class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                    <input id="dark-mode" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="dark-mode" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dark Mode</label>
                </div>

                <div onclick="disableDarkMode()" class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                    <input id="light-mode" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="light-mode" class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Light Mode</label>
                </div>
            </div>
        </div>
    </div>

    <div>
        <form id="update-user-info" class="space-y-4" action="../actions/updateAccountDetails.php" method="post">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_full_name">Full Name:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="user_full_name" name="user_full_name" value="<?php echo htmlspecialchars($_SESSION['user_full_name']); ?>">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_address">Address:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" id="user_address" name="user_address" value="<?php echo htmlspecialchars($_SESSION['user_address']); ?>">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_email">Email:</label>
                <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="email" id="user_email" name="user_email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" readonly>
            </div>

            <button type="submit" class="text-green-700 enabled:hover:text-white border border-green-700 enabled:hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-green-500 dark:text-green-500 enabled:dark:hover:text-white enabled:dark:hover:bg-green-600 dark:focus:ring-green-800 flex group transition-all disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn">
                Update
            </button>
        </form>

    </div>

</div>

<script>
    $(document).ready(function() {
        // Check local storage for the dark mode setting
        if (localStorage.getItem("darkMode") === "enabled") {
            // Set the checked attribute for the dark mode radio input
            $("#dark-mode").prop("checked", true);
        } else {
            // Set the checked attribute for the light mode radio input
            $("#light-mode").prop("checked", true);
        }
    });
</script>

<?php require_once "../components/pageBottom.component.php"; ?>