<?php
$tab_title = "Welcome to UCLan Student Shop - Home Page";
require_once "../components/pageTop.component.php";
?>

<div class="mt-10 children:my-3">
    <h1 class="heading mb-4">
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
    <h1 class="heading mb-4">
        Our Open Day!
    </h1>
    <iframe class="w-full h-96" src="https://www.youtube.com/embed/wyXNXbqFdAs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
</div>

<div class="my-10">
    <h1 class="heading mb-4">
        Currently Running Offers
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php
        require_once("../components/connection.component.php");

        $q = "SELECT * FROM tbl_offers";
        $res = mysqli_query($conn, $q);

        while ($row = mysqli_fetch_array($res)) {
            echo '
<div class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg dark:bg-slate-700 bg-blue-50 dark:text-blue-400 dark:border-blue-800">
    <h3 class="text-lg font-medium capitalize">' . $row["offer_title"] . '</h3>
    <span class="my-2 text-sm dark:text-white">' . $row["offer_dec"] . '</span>
</div>';
        }
        ?>
    </div>
</div>

<?php require_once "../components/pageBottom.component.php"; ?>