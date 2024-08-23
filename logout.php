<?php
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to account page with a message
header("Location: account.html?message=loggedout");
exit();
?>
