<?php
    if (!isset($_SESSION['ruser'])) exit();

    $con = ConnectDB();
    echo '<form action="index.php?page=5" method="post" enctype="multipart/form-data" class="inputgroup">';
    echo '<input type="hidden" name="MAX_FILE_SIZE" value="500000"/>';
    echo '<input type="file" name="file" accept="image/*">';
    echo '<input type="submit" name="saveavatar" value="Add" class="btn btn-sm btn-info">';
    echo '</form>';

    if (isset($_POST['saveavatar'])) {
        $userid = $_SESSION['id'];
        $fn = $_FILES['file']['tmp_name'];
        $file = fopen($fn, 'rb');
        $img = fread($file, filesize($fn));
        fclose($file);
        $img = addslashes($img);
        $add = 'update users set avatar="' . $img . '" where id=' . $userid . ';';
        mysqli_query($con, $add);
        $error = mysqli_errno($con);
        echo $error;
    }

    $sel = 'select * from users where roleid=2 order by login;';
    $res = mysqli_query($con, $sel);
    echo '<table class="table table-striped">';

    while ($row = mysqli_fetch_array($res)) {
        echo '<tr>';
        echo '<td>' . $row[1] . '</td>';
        $img = base64_encode($row[5]);
        echo '<td><img height="100px" src="data:images/jpeg; base64,' . $img . '"/></td></tr>';
    }
    mysqli_free_result($res);
    echo '</table>';
?>