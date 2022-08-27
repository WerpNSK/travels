<ul class="nav">
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="index.php?page=1">Туры</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?page=2">Комменты</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="index.php?page=3">Регистрация</a>
    </li>

    <?php
        if (isset($_SESSION['radmin'])) {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=4">Админка</a>
            </li>
            <?php
        }
    ?>

    <?php
        if (isset($_SESSION['ruser'])) {
            echo '<li class="active">
                    <a class="nav-link" href="index.php?page=5">PRIVATE</a>
                  </li>';
        }
    ?>
</ul>