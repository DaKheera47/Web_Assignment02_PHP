<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <link rel="stylesheet" href="./output.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vite App</title>
</head>

<body>
    <!-- navbar -->
    <?php
    include './src/components/navbar.component.php';
    createNav();
    ?>

    <main class="w-4/5 max-w-6xl mx-auto">
        <div class="mt-10 children:my-3">
            <h1 class="text-3xl text-uclan-blue font-bold capitalize mb-3">
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
            <h1 class="text-uclan-blue font-bold text-3xl capitalize my-6">
                Our Open Day!
            </h1>
            <iframe class="w-full h-96" src="https://www.youtube.com/embed/wyXNXbqFdAs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        </div>
    </main>

    <!-- footer -->
    <?php
    include './src/components/footer.component.php';
    createFooter();
    ?>
</body>

</html>