<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
?>

<div class="mt-10 children:my-3 js-show-on-scroll">
    <?php
    if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true && isset($_SESSION["user_full_name"])) { ?>
        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            Welcome back, <span class="text-uclan-red dark:text-uclan-yellow">
                <?php echo $_SESSION["user_full_name"] ?>
            </span>
        </div>
    <?php } ?>

    <h1 class="mb-4 heading">
        Where opportunity creates success
    </h1>

    <p>
        Every student at
        <a href="https://www.uclan.ac.uk/" class="link">
            The University Of Central Lancashire
        </a>
        is automatically a member of the Student's Union. We're here
        to make life better for students — inspiring you to succeed
        and achieve your goals.
    </p>

    <p>
        Everything you need to know about UCLan Students' Union.
        Your membership starts here.
    </p>
</div>

<div class="my-10 js-show-on-scroll">
    <h1 class="mb-4 heading">
        Our Open Day!
    </h1>
    <iframe class="w-full border-0 h-96" src="https://www.youtube.com/embed/wyXNXbqFdAs" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
</div>

<div class="my-10 js-show-on-scroll">
    <h1 class="mb-4 heading">
        Currently Running Offers
    </h1>

    <div class="grid grid-cols-1">
        <?php
        require_once("../components/connection.component.php");

        $q = "SELECT * FROM tbl_offers";
        $res = mysqli_query($conn, $q);
        ?>

        <div id="accordion-collapse" data-accordion="collapse">
            <?php while ($row = mysqli_fetch_array($res)) { ?>
                <!-- heading -->
                <h2 id=<?php echo 'heading-' . $row["offer_id"] ?>>
                    <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target=<?php echo '#body-' . $row["offer_id"] ?> aria-expanded="true" aria-controls=<?php echo 'body-' . $row["offer_id"] ?>>
                        <span class="capitalize"><?php echo $row["offer_title"] ?></span>
                        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd">
                            </path>
                        </svg>
                    </button>
                </h2>

                <!-- content -->
                <div id=<?php echo 'body-' . $row["offer_id"] ?> class="hidden" aria-labelledby=<?php echo 'heading-' . $row["offer_id"] ?>>
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <p class="mb-2 text-gray-800 dark:text-gray-200">
                            <?php echo $row["offer_dec"] ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="container px-5 py-24 mx-auto js-show-on-scroll">
    <div class="flex flex-col flex-wrap items-center w-full mb-20 text-center">
        <h1 class="mb-2 text-2xl font-medium capitalize sm:text-3xl title-font">
            Services we offer
        </h1>
        <p class="w-full leading-relaxed lg:w-1/2 text-opacity-80">
            Our student shop offers a variety of services to cater to the needs of our students.
        </p>
    </div>

    <div class="flex flex-wrap -m-4">
        <div class="p-4 xl:w-1/3 md:w-1/2">
            <div class="p-6 border border-gray-700 border-opacity-75 rounded-lg">
                <div class="inline-flex items-center justify-center w-10 h-10 mb-4 rounded-full text-uclan-blue dark:text-yellow-400 dark:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"></path>
                    </svg>
                </div>

                <h2 class="mb-2 text-lg font-medium capitalize title-font">
                    Free Delivery
                </h2>
                <p class="text-base leading-relaxed">
                    Our shop offers free delivery service to all UCLan students who reside on campus.
                </p>
            </div>
        </div>

        <div class="p-4 xl:w-1/3 md:w-1/2">
            <div class="p-6 border border-gray-700 border-opacity-75 rounded-lg">
                <div class="inline-flex items-center justify-center w-10 h-10 mb-4 rounded-full text-uclan-blue dark:text-yellow-400 dark:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"></path>
                    </svg>
                </div>

                <h2 class="mb-2 text-lg font-medium capitalize title-font">
                    24/7 online support
                </h2>
                <p class="text-base leading-relaxed">
                    Our team is always available to provide online support, available for order help or need assistance with the online platform.
                </p>
            </div>
        </div>

        <div class="p-4 xl:w-1/3 md:w-1/2">
            <div class="p-6 border border-gray-700 border-opacity-75 rounded-lg">
                <div class="inline-flex items-center justify-center w-10 h-10 mb-4 rounded-full text-uclan-blue dark:text-yellow-400 dark:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.121 7.629A3 3 0 009.017 9.43c-.023.212-.002.425.028.636l.506 3.541a4.5 4.5 0 01-.43 2.65L9 16.5l1.539-.513a2.25 2.25 0 011.422 0l.655.218a2.25 2.25 0 001.718-.122L15 15.75M8.25 12H12m9 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <h2 class="mb-2 text-lg font-medium capitalize title-font">
                    Discounts and promotions
                </h2>
                <p class="text-base leading-relaxed">
                    We regularly offer discounts and promotions on our products, so keep an eye out for our special deals.
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once "../components/pageBottom.component.php"; ?>