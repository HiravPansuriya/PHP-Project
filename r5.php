<?php
  session_start();
  include('config.php');
  if (!isset($_GET['email'])) {
    header("Location: login1.php?message=You Need To Login First");
    exit();
}
include('config.php');
$alertMessage = '';
$alertType = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $encodedEmail = $_GET['email'];
    $email = base64_decode(urldecode($encodedEmail));

    if (isset($_POST["option"]) && !empty($_POST["option"])) {
        $selectedOptions = $_POST["option"];
        foreach ($selectedOptions as $option) {
            $sql = "SELECT value, email FROM r5 WHERE id=?";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $param_id);
                $param_id = $option;
                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    mysqli_stmt_bind_result($stmt, $value, $db_email);
                    mysqli_stmt_fetch($stmt);

                    // Booking a table
                    if (isset($_POST["book"])) {
                        if ($value == 1) {
                            $alertMessage = "Table $option is already booked. Please select another table.";
                            $alertType = "danger";
                        } else {
                            $sql_update = "UPDATE r5 SET value=1, email=? WHERE id=?";
                            if ($stmt_update = mysqli_prepare($link, $sql_update)) {
                                mysqli_stmt_bind_param($stmt_update, "ss", $email, $option);
                                if (mysqli_stmt_execute($stmt_update)) {
                                    $alertMessage = "$option has been successfully booked.";
                                    $alertType = "success";
                                } else {
                                    $alertMessage = "Error booking table $option.";
                                    $alertType = "danger";
                                }
                            }
                        }
                    }

                    // Unbooking a table
                    elseif (isset($_POST["unbook"])) {
                        if ($value == 0) {
                            $alertMessage = "$option is not currently booked.";
                            $alertType = "danger";
                        } elseif ($db_email != $email) {
                            $alertMessage = "You can only unbook tables that you have booked.";
                            $alertType = "danger";
                        } else {
                            $sql_update = "UPDATE r5 SET value=0, email=NULL WHERE id=?";
                            if ($stmt_update = mysqli_prepare($link, $sql_update)) {
                                mysqli_stmt_bind_param($stmt_update, "s", $option);
                                if (mysqli_stmt_execute($stmt_update)) {
                                    $alertMessage = "$option has been successfully unbooked.";
                                    $alertType = "success";
                                } else {
                                    $alertMessage = "Error unbooking table $option.";
                                    $alertType = "danger";
                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
        $alertMessage = "Please select at least one option.";
        $alertType = "warning";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant 5</title>
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmUUSo7THCDrJG629AyXKTeQr1Cl-CpU6jgQ4WD63gmZYyrvU6SrKx17XxiIH7D8z7M_w&usqp=CAU">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    
</head>

<body>

    <div class="heading">Restaurant 5</div>
    <div class="container">
    <?php if ($alertMessage): ?>
            <div class="alert alert-<?php echo $alertType; ?>" role="alert">
                <?php echo $alertMessage; ?>
            </div>
        <?php endif; ?>
        <div class="container_1">
            <div class="container1">
                <div class="box" id="box1">1</div>
                <div class="box" id="box2">2</div>
                <div class="boxs" id="box3">Table 1</div>
                <div class="box" id="box4">3</div>
                <div class="box" id="box5">4</div>
            </div>

            <div class="container2">
                <div class="box" id="box1">1</div>
                <div class="box" id="box2">2</div>
                <div class="box" id="box3">3</div>
                <div class="boxs" id="box4">Table 2</div>
                <div class="box" id="box5">4</div>
                <div class="box" id="box6">5</div>
                <div class="box" id="box7">6</div>
            </div>
            <div class="container3">
                <div class="box" id="box1">1</div>
                <div class="box" id="box2">2</div>
                <div class="box" id="box3">3</div>
                <div class="box" id="box4">4</div>
                <div class="boxs" id="box5">Table 3</div>
                <div class="box" id="box6">5</div>
                <div class="box" id="box7">6</div>
                <div class="box" id="box8">7</div>
                <div class="box" id="box9">8</div>
            </div>
        </div>

        <div class="container_2">
            <div class="container1">
                <div class="box" id="box1">1</div>
                <div class="box" id="box2">2</div>
                <div class="boxs" id="box3">Table 4</div>
                <div class="box" id="box4">3</div>
                <div class="box" id="box5">4</div>
            </div>
            <div class="container2">
                <div class="box" id="box1">1</div>
                <div class="box" id="box2">2</div>
                <div class="box" id="box3">3</div>
                <div class="boxs" id="box4">Table 5</div>
                <div class="box" id="box5">4</div>
                <div class="box" id="box6">5</div>
                <div class="box" id="box7">6</div>
            </div>
            <div class="container3">
                <div class="box" id="box1">1</div>
                <div class="box" id="box2">2</div>
                <div class="box" id="box3">3</div>
                <div class="box" id="box4">4</div>
                <div class="boxs" id="box5">Table 6</div>
                <div class="box" id="box6">5</div>
                <div class="box" id="box7">6</div>
                <div class="box" id="box8">7</div>
                <div class="box" id="box9">8</div>
            </div>
        </div>
    </div>

    <div class="form-container">
        <form method="POST" action="r5.php?email=<?php echo $_GET['email']?>">
        <div class="checkboxes">
            <label for="Table1"> Table 1 </label>
            <input type="checkbox" name="option[]" id="Table1" value="Table1"><br>
            <label for="Table2"> Table 2 </label>
            <input type="checkbox" name="option[]" id="Table2" value="Table2"><br>
            <label for="Table3"> Table 3 </label>
            <input type="checkbox" name="option[]" id="Table3" value="Table3"><br>
            <label for="Table4"> Table 4 </label>
            <input type="checkbox" name="option[]" id="Table4" value="Table4"><br>
            <label for="Table5"> Table 5 </label>
            <input type="checkbox" name="option[]" id="Table5" value="Table5"><br>
            <label for="Table6"> Table 6 </label>
            <input type="checkbox" name="option[]" id="Table6" value="Table6"><br>
        </div>
            <div class="btn-container">
                <div class="book">
                    <input type="submit" class="btns"name="book" value="Book Table">
                </div>
                <div class="unbook">
                    <input type="submit" class="btns"name="unbook" value="Unbook Table">
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.j Table 1 sdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>