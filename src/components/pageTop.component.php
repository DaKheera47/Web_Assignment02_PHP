<?php
session_start();
require_once "../components/connection.component.php";
?>

<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="stylesheet" href="../../output.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $tab_title; ?></title>

    <script>
        // enable dark mode
        function enableDarkMode() {
            var element = document.documentElement;
            element.classList.add("dark");
            // update dark mode in local storage
            localStorage.setItem("darkMode", "enabled");
        }

        // disable dark mode
        function disableDarkMode() {
            var element = document.documentElement;
            element.classList.remove("dark");
            // update dark mode in local storage
            localStorage.setItem("darkMode", null);
        }

        // check if dark mode is enabled
        if (localStorage.getItem("darkMode") === "enabled") {
            // enable dark mode
            enableDarkMode();
        } else {
            // disable dark mode
            disableDarkMode();
        }

        function handleTheme() {
            // get from local storage
            let darkMode = localStorage.getItem("darkMode");

            // if dark mode is not enabled
            if (darkMode !== "enabled") {
                // enable dark mode
                enableDarkMode();
            } else {
                // disable dark mode
                disableDarkMode();
            }
        }

        function handleNav() {
            let element = document.getElementById("nav-content");
            element.classList.toggle("hidden");
        }
    </script>
</head>

<body class="dark:bg-gray-900 dark:text-white pt-16 md:pt-24">
    <nav class="fixed top-0 left-0 w-full bg-uclan-red text-white border-gray-200 py-2.5 md:py-0 rounded px-[5vw]">
        <div class="container flex flex-wrap md:flex-nowrap items-center justify-between mx-auto max-w-screen-xl">
            <a href="./index.html" class="flex items-center">
                <img src="../../public/images/uclanLogo.jpg" class="h-6 mr-3 sm:h-9 rounded-full" alt="UCLan Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap">
                    UCLan Student Shop
                </span>
            </a>

            <div class="flex">
                <button onclick="handleTheme()" type="button" class="block md:hidden text-white focus:outline-none hover:text-uclan-red hover:bg-gray-100 rounded-lg text-sm p-2.5">
                    <svg fill="currentColor" class="w-6 h-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <button onclick="handleNav()" class="block md:hidden text-white focus:outline-none hover:text-uclan-red hover:bg-gray-100 rounded-lg text-sm p-2.5">
                    <svg fill="currentColor" class="w-6 h-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <ul id="nav-content" class="hidden w-full md:w-3/5 lg:w-2/5 md:flex flex-col p-4 my-4 text-white rounded-lg justify-center items-center md:flex-row md:space-x-8 md:my-0 md:text-sm md:font-medium md:border-0 divide-y-2 md:divide-y-0">
                <li class="w-full text-center inline-flex items-center justify-center">
                    <a href="./index.php" class="block py-5 md:py-2 rounded hover:text-gray-200 md:bg-transparent md:p-0" aria-current="page">
                        Home
                    </a>
                </li>

                <li class="w-full text-center inline-flex items-center justify-center">
                    <a href="./products.php" class="block py-5 md:py-2 rounded hover:text-gray-200 md:bg-transparent md:p-0">
                        Products
                    </a>
                </li>

                <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true) { ?>
                    <li class="w-full text-center inline-flex items-center justify-center">
                        <a href="./cart.php" class="block py-5 md:py-2 rounded hover:text-gray-200 md:bg-transparent md:p-0">
                            Cart
                        </a>
                    </li>
                <?php } ?>

                <li class="w-full text-center inline-flex items-center justify-center">
                    <button onclick="handleTheme()" type="button" class="hidden md:block text-white focus:outline-none hover:text-uclan-red hover:bg-gray-100 rounded-lg text-sm p-2.5">
                        <svg fill="currentColor" class="w-6 h-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </li>

                <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true) { ?>
                    <form action="./logout.php" method="POST">
                        <input type="hidden" name="action" value="logout">
                        <li class="w-full text-center inline-flex items-center justify-center">
                            <button type="submit" class="block py-5 md:py-2 rounded hover:text-gray-200 md:bg-transparent md:p-0 whitespace-nowrap">
                                Log Out
                            </button>
                        </li>
                    </form>

                <?php } else { ?>
                    <li class="w-full text-center inline-flex items-center justify-center">
                        <a href="./login.php" class="block py-5 md:py-2 rounded hover:text-gray-200 md:bg-transparent md:p-0">
                            Login
                        </a>
                    </li>

                    <li class="w-full text-center inline-flex items-center justify-center group">
                        <a href="./signup.php" class="hover:bg-white hover:text-uclan-red bg-uclan-red text-white focus:outline-none font-bold rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center whitespace-nowrap">
                            Sign Up

                            <svg aria-hidden="true" class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <main class="px-[5vw] xl:px-0 max-w-screen-xl mx-auto">