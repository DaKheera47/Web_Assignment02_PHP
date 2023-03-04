<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
?>


<h1 class="text-4xl font-bold text-center mt-8 mb-4">
    Log In To Access your Account
</h1>

<!-- login form -->
<div class="mx-auto bg-white hover:shadow-xl transition-shadow shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col max-w-md">
    <div class="mb-4">
        <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
            Email
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" type="email" placeholder="example@example.com">
    </div>
    <div class="mb-6">
        <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
            Password
        </label>
        <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" type="password" placeholder="Your Password">
        <p class="text-uclan-red text-xs italic">Please choose a password.</p>
    </div>
    <div class="flex items-center justify-between">
        <button type="button" class="text-green-500 hover:text-white border border-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm px-4 py-2 text-center mr-2 mb-2">
            Log In
        </button>
    </div>
</div>

<?php require_once "../components/pageBottom.component.php"; ?>