<form action="index.php?page=3" method="POST">
    <input class="form-control w-100 m-1" type="text" name="userLogin" placeholder="Input Login" />
    <input class="form-control w-100 m-1" type="password" name="userPassword1" placeholder="Input Password">
    <input class="form-control w-100 m-1" type="password" name="userPassword2" placeholder="Input Password again">
    <input class="form-control w-100 m-1" type="email" name="userEmail" placeholder="Input Mail">
    <input class="btn btn-success w-100 m-1" type="submit" name="ClickRegistration" value="Create Account">
</form>

<?php
if (isset($_POST['ClickRegistration'])) {
    if (Registration($_POST['userLogin'], $_POST['userPassword1'], $_POST['userPassword2'], $_POST['userEmail'])) {
        echo "<div style='color:green;'> Sucssesful </div>";
    }
}
?>