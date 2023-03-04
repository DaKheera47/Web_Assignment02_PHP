<?php
function createNav()
{
    echo '
    <nav class="bg-uclan-red text-white border-gray-200 py-2.5 rounded px-[5vw]">
        <div class="container flex flex-wrap items-center justify-between mx-auto max-w-screen-xl">
            <a href="./index.html" class="flex items-center">
                <img src="../../public/images/uclanlogo.svg" class="h-6 mr-3 sm:h-9" alt="UCLan Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap">
                    UCLan Student Shop
                </span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-uclan-blue rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="flex flex-col p-4 mt-4 text-white rounded-lg md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0">
                    <li>
                        <a href="./index.php" class="block py-2 pl-3 pr-4 rounded hover:text-gray-200 md:bg-transparent md:p-0" aria-current="page">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="./products.php" class="block py-2 pl-3 pr-4 rounded hover:text-gray-200 md:hover:bg-transparent md:border-0 md:p-0">
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="./cart.php" class="block py-2 pl-3 pr-4 rounded hover:text-gray-200 md:hover:bg-transparent md:border-0 md:p-0">
                            Cart
                        </a>
                    </li>
                    <li>
                        <a href="./login.php" class="block py-2 pl-3 pr-4 rounded hover:text-gray-200 md:hover:bg-transparent md:border-0 md:p-0">
                            Log In
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
';
}
