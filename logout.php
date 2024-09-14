    <?php

    if (isset($_GET['eid'])) {
        $email = base64_decode(urldecode($_GET['eid']));
        session_start();
        $_SESSION = array();
        // Check if the current session matches the session name you 
            session_unset(); // Unset session variables
            session_destroy(); // Destroy the session
        if (isset($_COOKIE['email']) && $_COOKIE['email'] === $email) {
            setcookie("email", "", time() - 3600, "/");
            if (isset($_COOKIE['pass'])) {
                setcookie("pass", "", time() - 3600, "/");
            }
        }
        header("Location: login1.php?message=Your session has expired!! please login again");
        exit();
    }
?>