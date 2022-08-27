<?php
    if (!isset($_SESSION['radmin']))
    {
        exit();
    }
?>
<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <?php
            $con = ConnectDB();
        ?>
        <form action="index.php?page=4" method="post">
            <table class="table table-dark">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Страна</th>
                    <th scope="col">Выбрать</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    //Вывод таблици стран
                    $select = mysqli_query($con, "select * from countries order by country asc");
                    while ($x = mysqli_fetch_array($select)) {
                        echo '<tr><td scope="col">' . $x[0] . "</td>";
                        echo '<td scope="col">' . $x[1] . "</td>";
                        echo '<td scope="col"><input type="checkbox" name = "delete' . $x[0] . '" /></td></tr>';
                    }
                    mysqli_close($con);
                    echo '</tbody>';
                    echo '</table>';
                ?>
                <input class="form-control" type="text" name="country">
                <input class="btn btn-sm btn-info" type="submit" name="add" value="Добавить">
                <input class="btn btn-sm btn-warning" type="submit" name="delete" value="Удалить">
        </form>
        <?php
            if (isset($_POST['add'])) {
                if ($_POST['country'] != "") {
                    $con = ConnectDB();
                    $insert = 'insert into countries(country) values ("' . $_POST['country'] . '");';
                    mysqli_query($con, $insert);
                    $err = mysqli_errno($con);
                    if ($err == 0) {
                        echo '<script>';
                        echo 'window.location = document.URL;';
                        echo '</script>';
                    } else {
                        echo "<h1>Ошибка добавлениея</h1>";
                    }
                    mysqli_close($con);
                }
            }

            if (isset($_POST['delete'])) {
                $con = ConnectDB();
                foreach ($_POST as $key => $value) {
                    if (substr($key, 0, 6) == "delete") {
                        $id = substr($key, 6);
                        $delete = "delete from countries where id=" . $id . ";";
                        mysqli_query($con, $delete);
                        $err = mysqli_errno($con);
                        if ($err) {
                            echo "<h1>Ошибка удаления</h1>";
                        } else {
                            echo '<script>';
                            echo 'window.location = document.URL;';
                            echo '</script>';
                        }
                    }
                }
                mysqli_close($con);
            }
        ?>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 right">
        <form action="index.php?page=4" method="post">
            <table class="table table-dark">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Страна</th>
                    <th scope="col">Город</th>
                    <th scope="col">Удалить</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $con = ConnectDB();
                    $select = "select cities.id, country, city from countries join cities on countries.id = cities.countryid;";
                    $res = mysqli_query($con, $select);

                    while ($result = mysqli_fetch_array($res)) {
                        echo '<tr><td scope="col">' . $result[0] . "</td>";
                        echo '<td scope="col">' . $result[1] . "</td>";
                        echo '<td scope="col">' . $result[2] . "</td>";
                        echo '<td scope="col"><input type="checkbox" name = "dcity' . $result[0] . '" /></td></tr>';
                    }
                    echo "</tbody>";
                    echo '</table>';

                    $select = "select * from countries;";
                    $res = mysqli_query($con, $select);
                    echo '<select name="countryname" class="form-control">';
                    while ($result = mysqli_fetch_array($res)) {
                        echo '<option value="' . $result[0] . '">' . $result[1] . '</option>';
                    }
                    mysqli_close($con);
                ?>
                </select>
                <input class="form-control" type="text" name="city">
                <input class="btn btn-sm btn-info" type="submit" name="addCity" value="Добавить">
                <input class="btn btn-sm btn-warning" type="submit" name="deleteCity" value="Удалить">
        </form>

        <?php
            if (isset($_POST['addCity'])) {
                $con = ConnectDB();
                $city = trim(htmlspecialchars($_POST['city']));
                if ($city == '') exit();
                $insertinto = 'insert into cities (city, countryid) values ("' . $city . '","' . $_POST["countryname"] . '");';
                mysqli_query($con, $insertinto);
                $errorcod = mysqli_errno($con);
                if ($errorcod) {
                    echo "<h3>Error cod:$errorcod</h3>";
                    exit();
                }
                echo '<script>';
                echo 'window.location = document.URL;';
                echo '</script>';
                mysqli_close($con);
            }

            if (isset($_POST['deleteCity'])) {
                foreach ($_POST as $key => $value) {
                    $id = substr($key, 5);
                    $delete = "delete from cities where id = $id;";
                    $con = ConnectDB();
                    mysqli_query($con, $delete);
                    $error = mysqli_errno($con);
                    if ($error) {
                        echo $error;
                        exit();
                    }
                    echo '<script>';
                    echo 'window.location = document.URL;';
                    echo '</script>';
                }
                mysqli_close($con);
            }
        ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 left">
        <form action="index.php?page=4" method="post">
            <table class="table table-dark">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Страна/Город</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Звезды</th>
                    <th scope="col">Удалить</th>
                </tr>
                </thead>
                <?php
                    $con = ConnectDB();
                    $select = "select country, city, hotel, stars, hotels.id
                    from hotels join cities on hotels.cityid = cities.id
                    join countries on countries.id = cities.countryid;";
                    $res = mysqli_query($con, $select);
                    echo '<tbody class="thead-dark">';
                    while ($ar = mysqli_fetch_array($res)) {
                        echo '<tr><td scope="col">' . $ar[4] . '</td>';
                        echo '<td scope="col">' . $ar[0] . '</td>';
                        echo '<td scope="col">' . $ar[2] . '</td>';
                        echo '<td scope="col">' . $ar[3] . '</td>';
                        echo '<td scope="col"><input type="checkbox" name="dhotel' . $ar[4] . '"/></td></tr>';
                    }
                ?>
                </tbody>
            </table>
            <p>Страна/город
                <select name="countrycity" class="form-control">
                    <?php
                        $con = ConnectDB();
                        $select = "select country, city, cities.id
                    from countries join cities on countries.id = cities.countryid;";
                        $res = mysqli_query($con, $select);
                        while ($result = mysqli_fetch_array($res)) {
                            echo '<option value="' . $result[2] . '">' . $result[0] . '/' . $result[1] . '</option>';
                        }
                        mysqli_close($con);
                    ?>
                </select>
            </p>
            <p>Hotel name:
                <input class="form-control" type="text" name="hotelName">
            </p>
            <p>Цена:
                <input class="form-control" type="number" name="hotelCost">
            </p>
            <p> Звезды:
                <input class="form-control" type="number" max="5" min="0" name="hotelStars">
            </p>
            <p> Информвция:
                <textarea name="hotelInform" id="" cols="30" rows="10"></textarea>
            </p>
            <div>
                <input class="btn btn-sm btn-info" type="submit" name="addHotel" value="Добавить">
                <input class="btn btn-sm btn-warning" type="submit" name="deleteHotel" value="Удалить">
            </div>
        </form>
        <?php
            if (isset($_POST['addHotel'])) {
                $con = ConnectDB();
                $select = "select countryid from cities where id = " . $_POST['countrycity'] . ";";
                $query = mysqli_query($con, $select);
                $countryid = mysqli_fetch_array($query);

                $hotel = $_POST['hotelName'];
                $idcity = $_POST['countrycity'];
                $idcountry = $countryid[0];
                $sta = $_POST['hotelStars'];
                $cost = $_POST['hotelCost'];
                $info = $_POST['hotelInform'];

                $add = "insert into hotels(hotel, cityid, countryid, stars, cost, info)
                        values('$hotel', $idcity, $idcountry, $sta, $cost, '$info');";
                mysqli_query($con, $add);
                $err = mysqli_errno($con);
                if ($err) {
                    echo $err;
                    exit();
                }
                mysqli_close($con);
                echo '<script>';
                echo 'window.location = document.URL;';
                echo '</script>';
            }

            if (isset($_POST['deleteHotel'])) {
                $con = ConnectDB();
                foreach ($_POST as $key => $value) {
                    if (substr($key, 0, 6) == 'dhotel') {
                        $id = substr($key, 6);
                        $del = "delete from hotels where id = " . $id . ";";
                        mysqli_query($con, $del);
                    }
                }
                mysqli_close($con);
                echo '<script>';
                echo 'window.location = document.URL;';
                echo '</script>';
            }
        ?>
    </div>
    <div class="col-sm-6 col-md-6 col-lg-6 right">
        <?php
            $con = ConnectDB();
            echo '<form action="index.php?page=4" method="post" enctype="multipart/form-data" >';
            echo '<select name="hotelid">';
            $sel = 'select hotels.id, countries.country, cities.city, hotels.hotel
            from countries, cities, hotels
            where countries.id = hotels.countryid and cities.id = hotels.cityid;';
            $res = mysqli_query($con, $sel);

            while ($row = mysqli_fetch_array($res)) {
                echo '<option value="' . $row[0] . '">';
                echo $row[1] . '/' . $row[2] . '/' . $row[3] . '</option>';
            }
            echo '<input type="file" name="file[]" multiple accept="image/*">';
            echo '<input type="submit" name="addimage" value="Add" class="btn btn-sm btn-info">';
            echo '</select>';
            echo "</form>";
        ?>

        <?php
            if (isset($_REQUEST['addimage'])) {
                $con = ConnectDB();
                foreach ($_FILES['file']['name'] as $k => $v) {
                    if ($_FILES['file']['error'][$k] != 0) {
                        echo '<script>alert("Upload file error:' . $v . '")</script>';
                    }
                    move_uploaded_file($_FILES['file']['tmp_name'][$k], './images/' . $v);
                    $ins = 'insert into images(hotelid, imagepath) values(' . $_REQUEST['hotelid'] . ',"./images/' . $v . '")';
                    mysqli_query($con, $ins);
                    $err = mysqli_errno($con);
                    echo $err;

                }
            }
        ?>
    </div>
</div>
