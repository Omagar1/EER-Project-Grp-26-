<?php
//checks if not logged in 
if (!isset($_SESSION["loggedIn"]) and ($_SESSION["loggedIn"] != true)) {
    header("location: logout.php"); // if so redirects the user  to the logout page as to unset any sessions they may have set already. 
}
?>