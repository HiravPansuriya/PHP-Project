<?php
    $link = mysqli_connect("127.0.0.1", "root", "", "registered users");
    if ($link === false) {
        die("ERROR : - connection to this database failed due to" . mysqli_connect_error());
    }
?>