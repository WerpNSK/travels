<?php
if (isset($_SESSION['ruser'])) {
    echo '<form action="index.php';
    if (isset($_GET['page'])) {
        echo '?page=' . $_GET['page'];
    }

    echo '"class=form-inline pull-right" method="POST">';
    echo '<h4>Hello, ' . $_SESSION['ruser'];
    echo '<input type="submit" value="Exit" id="ex" name="ex" class="btn btn-default btn-xs"></h4>';
    echo '</form>';
    if (isset($_POST['ex'])) {
        unset($_SESSION['ruser']);
        unset($_SESSION['radmin']);
        echo '<script>window.location.reload()</script>';
    }
} else {
    if (isset($_POST['press'])) {
        if (Login($_POST['login'], $_POST['pass'])) {
            echo '<script>window.location.reload()</script>';
        }
    } else {
        echo '<form action="index.php';
        if (isset($_GET['page'])) echo '?page=' . $_GET['page'];

        echo '" class="input-group input-group-sm pull-right" method="POST">';
        echo '<input type="text" name="login" size="10" placeholder="login">
            <input type="password" name="pass" size="10" placeholder="password">
            <input type="submit" id="press" value="Login" class="btn btn-default btn-xs" name="press">
            </form>';
    }
}
