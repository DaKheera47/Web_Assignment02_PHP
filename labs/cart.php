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
                Cart Items
            </h1>
        </div>
    </main>

    <!-- footer -->
    <?php
    include './src/components/footer.component.php';
    createFooter();
    ?>
</body>

</html>