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
    <nav class="fixed top-0 left-0 w-full bg-uclan-red text-white border-gray-200 px-[5vw] py-2.5 rounded">
        <div class="container flex flex-wrap items-center justify-between mx-auto max-w-screen-xl">
            <a href="./index.php" class="flex items-center">
                <img src="../../public/images/uclanLogo.jpg" class="rounded-full h-6 mr-3 sm:h-9" alt="UCLan Logo" />

                <span class="font-semibold whitespace-nowrap dark:text-white text-sm lg:text-xl">
                    UCLan Student Shop
                </span>
            </a>

            <div class="flex md:order-2">
                <!-- cta -->
                <button onclick="handleTheme()" type="button" class="mr-3 text-white focus:outline-none hover:text-uclan-red hover:bg-gray-100 rounded-lg text-sm p-2.5">
                    <svg fill="currentColor" class="w-6 h-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <button id="cartIcon" type="button" onclick="populateCartDropdown()" class="mr-3 text-white focus:outline-none hover:text-uclan-red hover:bg-gray-100 rounded-lg text-sm p-2.5" aria-expanded="false" data-dropdown-toggle="cart-dropdown" data-dropdown-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                    </svg>
                </button>

                <!-- dropdown -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="cart-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">
                            Glance At Your Cart
                        </span>
                    </div>

                    <ul class="py-2 flex flex-col space-y-2" aria-labelledby="user-menu-button" id="cart-dropdown-list">
                        <!-- populated from js -->
                    </ul>
                </div>

                <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true) { ?>
                    <div class="flex items-center md:order-2 mr-2">
                        <button type="button" class="text-white focus:outline-none hover:text-uclan-red hover:bg-gray-100 rounded-lg text-sm p-2.5" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                            <span class="sr-only">Open user menu</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                            <div class="px-4 py-3">
                                <span class="block text-sm text-gray-900 dark:text-white">
                                    <?php echo $_SESSION["user_full_name"] ?>
                                </span>
                                <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                                    <?php echo $_SESSION["user_email"] ?>
                                </span>
                            </div>

                            <ul class="py-2" aria-labelledby="user-menu-button">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        Order History
                                    </a>
                                </li>

                                <li>
                                    <form action="./logout.php" method="POST" class="w-full">
                                        <input type="hidden" name="action" value="logout">
                                        <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                            Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php } else { ?>
                    <a href="./signup.php" class="hidden md:block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 my-auto whitespace-nowrap">
                        Get Started
                    </a>
                <?php } ?>

                <button data-collapse-toggle="navbar-cta" type="button" class="md:hidden inline-flex items-center mr-3 text-white focus:outline-none hover:text-uclan-red hover:bg-gray-100 rounded-lg text-sm p-2.5" aria-controls="navbar-cta" aria-expanded="false">
                    <span class="sr-only">
                        Open main menu
                    </span>

                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
                <ul class="flex flex-col p-4 mt-4 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium divide-y-2 md:divide-y-0">
                    <li>
                        <a href="./products.php" class="block py-2 pl-3 pr-4 text-white hover:text-gray-300 rounded md:p-0" aria-current="page">
                            Products
                        </a>
                    </li>

                    <?php if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true) { ?>
                        <li>
                            <a href="./cart.php" class="block py-2 pl-3 pr-4 text-white hover:text-gray-300 rounded md:p-0" aria-current="page">
                                Cart
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="./login.php" class="block py-2 pl-3 pr-4 text-white hover:text-gray-300 rounded md:p-0" aria-current="page">
                                Login
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="px-[5vw] xl:px-0 max-w-screen-xl mx-auto">