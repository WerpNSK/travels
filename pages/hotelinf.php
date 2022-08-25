<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php
    include_once("function.php");
    if (isset($_GET['hotel'])) {
        $id = $_GET['hotel'];
        $select = "select * from hotels where id = " . $id . ";";
        $con = ConnectDB();
        $r = mysqli_query($con, $select);
        $res = mysqli_fetch_array($r);
        $id = $res[0];
        $hotel = $res[1];
        $cityid = $res[2];
        $countryid = $res[3];
        $stars = $res[4];
        $costr = $res[5];
        $info = $res[6];

        echo '<h1>' . $hotel . '</h1>';
        echo '<div>' . $info;
        for ($i = 0; $i < $stars; $i++) {
            echo '<img height="30" width="30" src="../images/star.jpg">';
        }
        echo '</div>';
        echo '<div class="row"><div class="col-md-6 texrcenter">';
        echo '<ul id="gallery">';
        $select = 'select imagepath from images where hotelid = ' . $id . ";";
        $q = mysqli_query($con, $select);
        while ($arr = mysqli_fetch_array($q)) {
            echo '<li><img height="200" width="200" src="../' . $arr[0] . '"></li>';
        }
        echo '</></div></div>';
    }
    ?>
</body>

</html>