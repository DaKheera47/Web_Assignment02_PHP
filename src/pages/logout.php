<?php
session_start();

if (isset($_POST["action"]) && $_POST["action"] == "logout") {
    session_destroy();
}

header("Location: index.php");
