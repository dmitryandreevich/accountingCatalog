 <header class="header">
        <div class="container">
            <div class="row justify-content-between align-items-center header-block">
                <div class="col-md-4">
                    <h2>ИП Галиев<br>Серебряный дождь</h2>
                </div>
                <div class="col-md-6 ">
                    <nav class="navigation">
                        <ul>
                            <li><a href="/">Главная</a></li>
                            <li><a href="/pages/catalog.php">Товары</a></li>
                            <li><a href="/pages/ads.php">Рекламное агенство</a></li>
                            <li>
                                <?php if(\core\AccountModule::isLogined()):?>
                                    <form action="" method="post">
                                        <input type="submit" value="<?= "Привет, {$_SESSION['login']}. Выйти"?>" class="btn btn-danger" name="logout">
                                    </form>
                                <?php else: ?>
                                    <a href="/admin/login.php">Войти</a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
