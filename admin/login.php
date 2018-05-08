<?php
    session_start();
    require_once __DIR__ . '/../core/AdminModule.php';
    require_once  __DIR__. '/../core/AccountModule.php';
    $account = new core\AccountModule();
   // $account->addNewAdmin('root','123');

    if(!$account->isLogined())
        $account->postListener();

    include __DIR__.'/../layouts/head.php'; // подключаем общий head
?>
<?php \core\includeHeader(); ?>

<div class="container">

    <main>
        <div class="row">
            <div class="col-md-12">
                <h3 style="text-align: center">Вход</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="login" class="text-center">Имя пользователя:</label>
                        <input type="text" class="form-control" name="login" id="login">
                        <label for="password">Пароль:</label>
                        <input type="password" class="form-control" name="password" id="password"><br>
                        <input type="submit" name="sendLogin" value="Войти" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
<?php \core\includeFooter(); ?>
