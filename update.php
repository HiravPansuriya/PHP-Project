<?php
// Include config file
require_once "config.php";

$id = $_GET['id'];
$email = $_GET['eid'];

if($email == "r1@gmail.com"){
    $sql = "UPDATE r1 SET value=? , email=? WHERE id=?";
}
else if($email == "r2@gmail.com"){
    $sql = "UPDATE r2 SET value=? , email=? WHERE id=?";
}
else if($email == "r3@gmail.com"){
    $sql = "UPDATE r3 SET value=? , email=? WHERE id=?";
}
else if($email == "r4@gmail.com"){
    $sql = "UPDATE r4 SET value=? , email=? WHERE id=?";
}
else if($email == "r5@gmail.com"){
    $sql = "UPDATE r5 SET value=? , email=? WHERE id=?";
}
else if($email == "r6@gmail.com"){
    $sql = "UPDATE r6 SET value=? , email=? WHERE id=?";
}


if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "iss", $param_value, $param_email, $param_id);

    // Set parameters
    $param_value = 0;
    $param_email = "null";
    $param_id = $id;

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Records updated successfully. Redirect to landing page
        header("Location: admin.php?eid=" . urlencode(base64_encode($email) ) . "&msg=Your Record Updated");
        exit();
    } else {
        echo "Something went wrong. Please try again later.";
    }
} 
    // Close connection
    mysqli_close($link);

?>