<?php
if (isset($_GET['eid']) || isset($_SESSION['id'])) {
    $email = base64_decode(urldecode($_GET['eid']));
    session_start(); // Start the session
} else {
    header("Location: login1.php?message=Please Login First!!");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmUUSo7THCDrJG629AyXKTeQr1Cl-CpU6jgQ4WD63gmZYyrvU6SrKx17XxiIH7D8z7M_w&usqp=CAU">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body {
            /* background-color: rgb(232, 229, 229); */
            background-color: black;
            min-height: 100vh;
        }

        .navbar a {
            font-size: 25px;
            text-decoration: none;
        }

        .signup,
        .login,
        .about,
        .logout {
            list-style: none;
            padding: 0px 15px;
        }

        .icon {
            margin-right: auto;
            margin-left: -10px;
        }

        .navbar {
            display: flex;
            box-sizing: border-box;
            background-color: black;
            box-shadow: 1px 1px 10px black;
            backdrop-filter: blur(20px);
            height: 70px;
            margin: -10px -7px 0px -10px;
            padding-right: 20px;
            padding-top: 5px;
            width: 100%;
            justify-content: end;
            align-items: center;
            position: fixed;
        }

        .navbar a:hover {
            cursor: pointer;
        }

        .navbar i {
            font-size: 30px;
            display: flex;
        }

        .heading {
            color: rgb(0, 150, 200);
            font-size: 60px;
            display: grid;
            grid-template-columns: 1fr;
            text-align: center;
            font-weight: bolder;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-decoration: underline;
        }

        p {
            margin-top: 100px;
        }

        .restaurant {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            text-align: center;
            grid-column-gap: 100px;
            grid-row-gap: 10px;
            margin: -20px 50px 50px 50px;
        }

        .box {
            height: 70px;
            background-color: black;
            margin-bottom: 80px;
            display: grid;
            grid-template-columns: 3fr 1fr;
            align-items: center;
            color: white;
        }

        .boxs {
            height: 350px;
            background-color: white;
            color: white;
            box-shadow:0 0 10px white;
        }

        .box .name {
            font-size: 25px;
            color: white;
            font-weight: bolder;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .logout {
            border: none;
            box-shadow: 0 0 0 white;
            background-color: black;
            padding: 0px 15px;
            text-decoration: none;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-size: 25px;
        }

        .logout a {
            color: white;
            transition: background-color 0.3s ease;
            border-radius: 10px;
            padding: 3px;
            /* border:2px solid white; */
        }

        .logout a:hover {
            color: black;
            background-color: white;
        }

        button {
            border: 3px solid black;
            background-color: rgb(100, 250, 140);
            color: black;
            height: 52px;
            transition: all 0.3s ease;
            border-radius: 10px;
            padding: 3px;
        }

        button a {
            text-decoration: none;
            font-size: 20px;
            padding: 20px;
            color: black;
            font-weight: bolder;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .button:hover {
            border: 2px solid rgb(100, 250, 140);
            background-color: black;
        }

        .button a:hover {
            color: rgb(100, 250, 140);
        }

        .icon img {
            height: 50px;
            width: 50px;
            border-radius: 50%;
        }
        #box1{
            background:url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cmVzdGF1cmFudHxlbnwwfHwwfHx8MA%3D%3D') no-repeat center center/cover;
        }
        #box2{
            background:url('https://t3.ftcdn.net/jpg/03/24/73/92/360_F_324739203_keeq8udvv0P2h1MLYJ0GLSlTBagoXS48.jpg') no-repeat center center/cover;
        }
        #box3{
            background:url('https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8cmVzdGF1cmFudHxlbnwwfHwwfHx8MA%3D%3D') no-repeat center center/cover;
        }
        #box7{
            background:url('https://assets3.thrillist.com/v1/image/3079884/750x500/flatten;crop;webp=auto;jpeg_quality=50.jpg') no-repeat center center/cover;
        }
        #box8{
            background:url('https://cdn.vox-cdn.com/thumbor/5d_RtADj8ncnVqh-afV3mU-XQv0=/0x0:1600x1067/1200x900/filters:focal(672x406:928x662)/cdn.vox-cdn.com/uploads/chorus_image/image/57698831/51951042270_78ea1e8590_h.7.jpg') no-repeat center center/cover;
        }
        #box9{
            background:url('https://toohotel.com/wp-content/uploads/2022/09/TOO_restaurant_Panoramique_vue_Paris_nuit_v2-scaled.jpg') no-repeat center center/cover;
        }
    </style>
</head>

<body>
    <div class="container1">
        <ul class="navbar">
            <div class="icon">
                <a href=""><img src="logo.jpg"></a>
            </div>
            <div class="logout">
                <a href="logout.php?eid=<?php echo $_GET['eid']; ?>" name="logout">Log Out</a>
            </div>

        </ul>
    </div>

    <div class="heading">
        <p>Restaurants</p>
    </div>
    <div class="restaurant">

        <div class="boxs" id="box1"></div>
        <div class="boxs" id="box2"></div>
        <div class="boxs" id="box3"></div>
        <div class="box" id="box4">
            <div class="name">Restaurant 1</div><button type="submit" class="button" name="submit"><a href="r1.php?email=<?php echo $_GET["eid"] ?>">GO</a></button>
        </div>
        <div class="box" id="box5">
            <div class="name">Restaurant 2</div><button type="submit" class="button" name="submit"><a href="r2.php?email=<?php echo $_GET["eid"] ?>">GO</a></button>
        </div>
        <div class="box" id="box6">
            <div class="name">Restaurant 3</div><button type="submit" class="button" name="submit"><a href="r3.php?email=<?php echo $_GET["eid"] ?>">GO</a></button>
        </div>
        <div class="boxs" id="box7"></div>
        <div class="boxs" id="box8"></div>
        <div class="boxs" id="box9"></div>
        <div class="box" id="box10">
            <div class="name">Restaurant 4</div><button type="submit" class="button" name="submit"><a href="r4.php?email=<?php echo $_GET["eid"] ?>">GO</a></button>
        </div>
        <div class="box" id="box11">
            <div class="name">Restaurant 5</div><button type="submit" class="button" name="submit"><a href="r5.php?email=<?php echo $_GET["eid"] ?>">GO</a></button>
        </div>
        <div class="box" id="box12">
            <div class="name">Restaurant 6</div><button type="submit" class="button" name="submit"><a href="r6.php?email=<?php echo $_GET["eid"] ?>">GO</a></button>
        </div>
    </div>
</body>

</html>