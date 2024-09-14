<?php
// Include config file
include('config.php');

if (!$link) {
    die("Database connection failed.");
}
$encodedEmail = $_GET['eid'];
$email = base64_decode(urldecode($encodedEmail));

if($email == "r1@gmail.com"){
    echo "owner1";
    $sql = "SELECT * FROM r1";
}
else if($email == "r2@gmail.com"){
    echo "owner2";
    $sql = "SELECT * FROM r2";
}
else if($email == "r3@gmail.com"){
    echo "owner3";
    $sql = "SELECT * FROM r3";
}
else if($email == "r4@gmail.com"){
    echo "owner4";
    $sql = "SELECT * FROM r4";
}
else if($email == "r5@gmail.com"){
    echo "owner5";
    $sql = "SELECT * FROM r5";
}
else if($email == "r6@gmail.com"){
    echo "owner6";
    $sql = "SELECT * FROM r6";
}

// Attempt select query execution
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Table</th>";
        echo "<th>Is Booked</th>";
        echo "<th>Email Id</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['value'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>";
            echo "<a href='update.php?eid=$email&id=$id' class='btn'>Update Record</a>";
            echo "&nbsp;";
            echo "</td>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "</tr>";
        echo "</tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<em>No records were found.</em>';
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

// Close connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="shortcut icon"
        href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmUUSo7THCDrJG629AyXKTeQr1Cl-CpU6jgQ4WD63gmZYyrvU6SrKx17XxiIH7D8z7M_w&usqp=CAU">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color:black;
        }

        .logout {
            margin-top: 20px;
        }

        .logout a {
            padding: 10px 20px;
            font-size: 20px;
            color: white;
            background-color: rgb(0,100,200);
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout a:hover {
            background-color: white;
            color:rgb(0,100,200);
            border:2px solid rgb(0,100,200);
            font-weight:bold;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
            color:white;
        }

        table th, table td {
            padding: 12px 15px;
        }

        table thead tr {
            background-color: rgb(0,100,200);
            color: white;
            text-align: left;
            font-weight: bold;
        }

        table tbody tr {
            border-bottom: 1px solid white;
        }

        table tbody tr:hover {
            background-color: rgb(150,150,150,0.075);
        }

        a {
            text-decoration: none;
            color: #009879;
        }

        a:hover {
            color: rgb(0,100,200);
        }

    </style>
</head>

<body>

<div class="logout">
    <a href="logout.php?eid=<?php echo $_GET['eid']; ?>" name="logout">Log Out</a>
</div>

</body>

</html>
