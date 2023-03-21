<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
?>

<div class="mt-10 children:my-3">
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


<div class="my-10">
    <h1 class="mb-4 heading">
        Our Open Day!
    </h1>
    <iframe class="w-full h-96" src="https://www.youtube.com/embed/wyXNXbqFdAs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
</div>

<div class="my-10">
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
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
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

    <?php require_once "../components/pageBottom.component.php"; ?>