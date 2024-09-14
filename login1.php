<?php
$showError = false;
$emailError = false;
$passwordError = false;
$isValid = true;
$emailValue = "";
$passwordValue = "";

if (isset($_POST['email'])) {

    include('config.php');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $emailValue = $email;
    $passwordValue = $password;

    if (empty($email)) {
        $emailError = true;
        $isValid = false;
    }
    if (empty($password)) {
        $passwordError = true;
        $isValid = false;
    }
    if ($isValid) {
        if(isset($_SESSION['id'])){
            header("Location : index.php?eid=". urlencode(base64_encode($emailValue)) ."&msg=we remember you");
            exit();
        }
        session_start();
        if($email == "r1@gmail.com" || $email == "r2@gmail.com" || $email == "r3@gmail.com" || $email == "r4@gmail.com" || $email == "r5@gmail.com" || $email == "r6@gmail.com")
        {
                $stmt = mysqli_prepare($link, "SELECT * FROM `admin_user` WHERE email = ? AND `password` = ?");
                mysqli_stmt_bind_param($stmt, "ss", $email, $password);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) { //if user exist
            $row = mysqli_fetch_array($result);

            if (isset($_POST['remember'])) {
                setcookie("email", $row['email'], time() + (3600) , "/");
                setcookie("pass",  base64_encode($row['password']) , time() + (3600) , "/");
            }
            $_SESSION['id'] = $row['sno'];
            $encodedEmail = urlencode(base64_encode($email));
            header("Location: admin.php?eid=$encodedEmail");
            exit();
        } else {
            //User not exist in data base or entered wrong password
            $showError = true;
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        }

        else{
        $stmt = mysqli_prepare($link, "SELECT * FROM `registration` WHERE email = ? AND `password` = ?");
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) { //if user exist
            $row = mysqli_fetch_array($result);
            if (isset($_POST['remember'])) {
                setcookie("email", $row['email'], time() + (3600) , "/");
                setcookie("pass",  base64_encode($row['conf.password']) , time() + (3600) , "/");
            }
            $_SESSION['id'] = $row['sno'];
            $encodedEmail = urlencode(base64_encode($email));
            header("Location: index.php?eid=$encodedEmail");
            exit();
        } else {
            //User not exist in data base or entered wrong password
            $showError = true;
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);


    }
    }


} else {
    $_SESSION['message'] = "Please Login To Enter To Website";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Log In</title>
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmUUSo7THCDrJG629AyXKTeQr1Cl-CpU6jgQ4WD63gmZYyrvU6SrKx17XxiIH7D8z7M_w&usqp=CAU">
    <link rel="shortcut icon" href="signup favicon.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login1.css">
</head>

<body>
    <?php
    if ($showError) {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert" my-6>
        <strong>Error!!</strong>You Are Not Registered Yet Or You Entered Wrong Password!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    ?>
    <ul class="navbar">
        <div class="icon">
        <a href="home.html"><i class='bx bxs-home'></i></a>
        </div>
    </ul>
    </div>
    <div class="box">
        <div class="wrapper">
            <form action="login1.php" method="post">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Enter Your user email" value="<?php if (isset($_COOKIE["email"])) {
                                                                                                    echo $_COOKIE["email"];
                                                                                                } else echo $emailValue; ?>" autocomplete="off">
                    <?php
                    if ($emailError) {
                        echo '<strong style="color:red;margin-left:20px;">Email Is Required Field</strong>';
                    }
                    ?>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Enter Your Password" value="<?php echo $passwordValue; ?>" autocomplete="off">
                    <?php
                    if ($passwordError) {

                        echo '<strong style="color:red;margin-left:20px;">Password Is Required Field</strong>';
                    }
                    ?>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="remember" <?php if (isset($_COOKIE["email"]) && isset($_COOKIE["pass"])) {
                                                                        echo $_COOKIE["email"];
                                                                    } else echo $emailValue; ?>>Remember Me</label>
                </div>
                <button type="submit" class="btn" name="login" value="login">Login</button>
                <div class="register-link">
                    <p>Don't Have An Account?? <a href="signup1.php">Register</a></p>
                </div>
                <div class="login-error">
                    <?php
                    if (isset($_GET['message'])) {
                        echo $_GET['message'];
                        unset($_GET['message']);
                    }
                    else if(isset($_SESSION['message'])){
                        echo $_SESSION['message'];
                        unset($_SESSION['message']);
                    }
                    ?>
                </div>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>