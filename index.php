<?php
session_start();
include_once('pages/function.php');
//include_once('pages/createdb.php');
//Create();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Travels</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
    <div class="container">
        <header class="col-sm-12 col-md-12 col-lg-12">
            <?php include_once("pages/login.php"); ?>
        </header>
        <div class="row">
            <div class="col-12">
                <?php include_once('pages/menu.php'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    if ($page == 1) include_once('pages/tours.php');
                    if ($page == 2) include_once('pages/comments.php');
                    if ($page == 3) include_once('pages/registration.php');
                    if ($page == 4) include_once('pages/admin.php');
                }

                ?>
            </div>
        </div>
    </div>
</body>

</html>