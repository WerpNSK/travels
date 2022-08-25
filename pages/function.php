<?php
    function ConnectDB()
    {
        $login = "admin";
        $pass = "admin";
        $db_name = "travels";
        $host = "localhost";
        $con = mysqli_connect($host, $login, $pass, $db_name);
        return $con;
    }

    function Registration($l, $p1, $p2, $e)
    {
        echo "qweqweewwq";
        $login = trim(htmlspecialchars($l));
        $password1 = md5(trim(htmlspecialchars($p1)));
        $password2 = md5(trim(htmlspecialchars($p2)));
        $email = trim(htmlspecialchars($e));

        if ($password1 != $password2) {
            echo "<div style='color:red;'> Password in correct </div>";
            return false;
        }

        if (strlen($login) < 3 || strlen($login) > 15) {
            echo "<div style='color:red;'> Your login >3 and <15 </div>";
            return false;
        }

        if (strlen($password1) < 3 || strlen($password2) > 15) {
            echo "<div style='color:red;'> Your password >3 and <15 </div>";
            return false;
        }
        $password1 = md5($password1);
        $con = ConnectDB();
        $add = "insert into users(login, pass, email, roleid) values('$login', '$password1', '$email', 2);";
        mysqli_query($con, $add);
        $error = mysqli_errno($con);
        if ($error == 1062) {
            echo "<div style='color:red;'>Login uzhe est </div>";
            return false;
        } else if ($error != 0) {
            echo "Code error =" . $error;
            return false;
        }
        return true;
    }

    function Login($log, $pass)
    {
        $log = trim(htmlspecialchars($log));
        $pass = trim(htmlspecialchars($pass));

        if ($log == '' || $pass == '') {
            echo "<h3><span style='color:red;'>Fill All Required!</span></h3>";
            return false;
        }

        if (strlen($log)<3 || strlen($log)>15 || strlen($pass)<3 || strlen($pass)>15)
        {
            echo "<h3><span style='color:red;'>Value Length Must Be Between 3 and 15</span></h3>";
            return false;
        }
        //$pass = md5($pass);
        $con = ConnectDB();
        $select = 'select * from users where login ="'.$log.'" and pass="'.$pass.'";';
        $res = mysqli_query($con, $select);

        if ($row=mysqli_fetch_array($res))
        {
            $_SESSION['ruser'] = $log;
            if ($row[6]==1)
            {
                $_SESSION['radmin']=$log;
            }
            return true;
        }
        else
        {
            echo "<h3><span style='color:red;'>No Such User!</span></h3>";
            return false;
        }
    }
    ?>
