<?php
    if(isset($_POST['sendAdApp'])){
        $adType = $_POST['service'];
        $email =$_POST['email'];
        $message = "$email хочет заказать $adType. Свяжитесь с ним!";
        mail($email,$email,$message);
    }

    include('../layouts/head.php');
?>
<?php \core\includeHeader(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <main>
                <p class="title">Услуги Рекламного Агенства</p>
                <ol>
                    <li>Разработка рекламных вывесок(примеру Объемными буквами)</li>
                    <li>Разработка визиток</li>
                    <li>Изготовление жалюзи(разных цвето)</li>
                    <li>Изготовление ролл шторы</li>
                    <li>Печать фотографий</li>
                    <li>Вывески для гос. Учереждений</li>
                    <li>Изготовление баннеров</li>
                </ol>

                Контактные данные агенства: С.Пресновка , Ул.шайкина 42 здание Казактелекома<br>

                <span class="phone">Телефон:</span><b>7-90-21</b><br>
                <span class="phone">Сотовый:</span><b>8-777-129-98-9</b>
                <br><br>
                <form action="" method="post">
                    <div>
                        <h3>Отправьте заявку на рекламу</h3>
                    </div>
                    <div class="form-group">
                        <label for="login" class="text-center">Введите ваш e-mail:</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <label for="password">Выберите услугу:</label>
                        <select name="service" id="service" class="form-control">

                            <option>Разработка рекламных вывесок(примеру Объемными буквами)</option>
                            <option>Разработка визиток</option>
                            <option>Изготовление жалюзи(разных цвето)</option>
                            <option>Изготовление ролл шторы</option>
                            <option>Печать фотографий</option>
                            <option>Вывески для гос. Учереждений</option>
                            <option>Изготовление баннеров</option>
                        </select><br>

                        <input type="submit" name="sendAdApp" value="Отправить заявку" class="btn btn-primary">
                    </div>
                </form>
            </main>
        </div>
    </div>

</div>
<?php \core\includeFooter(); ?>
