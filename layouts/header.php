<?php
    if(isset($_POST['logout']))
    {
        session_destroy();
    }
?>
<header class="header">
    <div class="row justify-content-between align-items-center header-block">
        <div class="col-md-4">
            <h2>Сайт того-то того</h2>
        </div>
        <div class="col-md-6 ">
            <nav class="navigation">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <li><a href="/pages/catalog.php">Товары</a></li>
                    <li><a href="/pages/ads.php">Рекламное агенство</a></li>
                    <li><a href="/admin/login.php">Админ-панель</a></li>
                    <li>
                        <form action="" method="post">
                            <input type="submit" value="<?= "Привет, {$_SESSION['login']}. Выйти"?>" class="btn btn-danger" name="logout">
                        </form></li>
                </ul>
            </nav>
        </div>
    </div>
</header>