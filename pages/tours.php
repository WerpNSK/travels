<form action="index.php?page=1" method="post">
    <select name="countryid" class="col-sm-3 col-md-3 col-lg-3">

        <?php
            $con = ConnectDB();
            $sel = "select * from countries order by country;";
            $res = mysqli_query($con, $sel);

            echo '<option value = "0">Выбери страну...</option>';
            while ($arr = mysqli_fetch_array($res)) {
                echo '<option value="' . $arr[0] . '">' . $arr[1] . '</option>';
            }
            echo '</select>';
        ?>
        <input type="submit" name="selectcountry" value="Выбор страны" class="btn btn-xs btn-primary">

        <?php
            if (isset($_POST['selectcountry'])) {
                echo '<br>';
                $id = $_POST['countryid'];
                echo '<select name="cityid" class="col-3">';
                $sel = 'select * from cities where countryid=' . $id . ';';
                $res = mysqli_query($con, $sel);
                echo '<option value="0">Выбери город...</option>';

                while ($arr = mysqli_fetch_array($res)) {
                    echo '<option value="' . $arr[0] . '">' . $arr[2] . '</option>';
                }
                echo "</select>";
                echo '<input type="submit" name="selectcity" value="Выбор города" class="btn btn-xs btn-primary">';
            }
            echo '</form>';
        ?>

        <?php
            if (isset($_POST['selectcity']))
            {
            $cityid = $_POST['cityid'];
            $sel = "select countries.country, cities.city, hotel, hotels.cost, hotels.stars, hotels.id
        from countries join cities on countries.id = cities.countryid join hotels on cities.id = hotels.cityid
        where cities.id=" . $cityid . ";";
            $q = mysqli_query($con, $sel);
        ?>
        <table class="table table-dark">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Отель</th>
                <th scope="col">Страна</th>
                <th scope="col">Город</th>
                <th scope="col">Звезды</th>
                <th scope="col">Цена</th>
                <th scope="col">Ссылка</th>
            </tr>
            </thead>
            <tbody>
<?php
    while ($res = mysqli_fetch_array($q)) {
        echo '<tr><td>' . $res[2] . '</td>';
        echo '<td>' . $res[0] . '</td>';
        echo '<td>' . $res[1] . '</td>';
        echo '<td>' . $res[4] . '</td>';
        echo '<td>' . $res[3] . '</td>';
        echo '<td><a href="hotelinf.php?hotel=' . $res[5] . '" target="_blank">Ссылка</a></td></tr>';
    }
    echo '</tbody>';
    echo '</table>';
    }
?>