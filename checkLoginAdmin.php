<?php
if (!empty($_SESSION["user_status"])) {
    if ($_SESSION["user_status"] != "admin") {
        header("location: logout.php");
    }
} else {
    header("location: logout.php");
}
