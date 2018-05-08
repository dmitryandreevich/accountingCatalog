<?php
    require_once __DIR__.'/../core/CatalogModule.php'; // подключение файла
    include __DIR__.'/../layouts/head.php'; // вставка head
    $catalog = new core\CatalogModule(); // создание объекта класса CatalogModule

    $catalog->postListener(); // прослушка пост запросов

    \core\includeHeader(); // вставка шапки
?>
<!-- Админская страница для редактирования продукта -->
<div class="container">
    <?php
        $product = $catalog->getProductById($_GET['id']);
        if(empty($product))
            die('Ошибка при получении продукта!');
    ?>

    <main>
        <div class="row">
            <div class="col-md-12">
                <h3>Обновление продукта "<?= $product['name'] ?>"</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="create-new-product">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="id">Номер</label>
                            <input type="number" value="<?= $product['id'] ?>" id="id" name="id" class="form-control">
                            <label for="name">Название</label>
                            <input type="text" id="name" name="name" class="form-control" class="name" value="<?= $product['name'] ?>">
                            <label for="price">Цена</label>
                            <input type="number" id="price" class="form-control" name="price" value="<?= $product['price'] ?>">
                            <label for="count">Количество</label>
                            <input type="number" class="form-control" id="count" name="count" value="<?= $product['count'] ?>">
                            <label for="productType">Тип</label>
                            <select name="productType" id="productType" class="form-control">
                                <option value="new">Новый товар</option>
                                <option value="old">Б/У</option>
                            </select>
                            <input type="submit" class="btn btn-success form-control" value="Обновить" name="updateProduct"></div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
<?php \core\includeFooter(); ?>
