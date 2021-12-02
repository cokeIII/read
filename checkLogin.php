<?php
if (!empty($_SESSION["user_status"])) {
    if ($_SESSION["user_status"] != "student") {
        header("location: logout.php");
    }
} else {
    header("location: logout.php");
}
