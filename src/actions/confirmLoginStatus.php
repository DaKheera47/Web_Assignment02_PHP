<?php
session_start();

// tell the front end if the user is logged in
echo json_encode(!!(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true));
