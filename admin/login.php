<?php
    session_start();
    require_once __DIR__.'/../core/AdminModule.php';
    $admin = new core\AdminModule();
   // $admin->addNewAdmin('root','123');
    //$admin->login('root','1232');
    if(!$admin->isLogined())
        $admin->postListener();
    else
    {
        header('Location: http://'. $_SERVER['HTTP_HOST'].'/admin/dashboard.php');
        exit;
    }

    include __DIR__.'/../layouts/head.php'; // подключаем общий head
?>
<div class="container">
    <?php \core\includeHeader(); ?>

    <main>
        <div class="row">
            <div class="col-md-12">
                <h3 style="text-align: center">Вход в админ-панель</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="login" class="text-center">Имя пользователя:</label>
                        <input type="text" class="form-control" name="login" id="login">
                        <label for="password">Пароль:</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <input type="submit" name="sendLogin" value="Войти" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>


    </main>

    <?php \core\includeFooter(); ?>
</div>
