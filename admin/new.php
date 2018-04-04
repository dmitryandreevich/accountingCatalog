<?php
    require_once __DIR__.'/../core/CatalogModule.php';
    include __DIR__.'/../layouts/head.php';
    $catalog = new core\CatalogModule();

    $catalog->postListener();
?>

<div class="container">
    <?php \core\includeHeader(); ?>

    <main>
        <div class="row">
            <div class="col-md-12">
                <h3>Добавление нового товара</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="create-new-product">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" id="name" name="name" class="form-control" class="name">
                            <label for="price">Цена</label>
                            <input type="number" id="price" class="form-control" name="price">
                            <label for="count">Количество</label>
                            <input type="number" class="form-control" id="count" name="count">
                            <label for="productType">Тип</label>
                            <select name="productType" id="productType" class="form-control">
                                <option value="new">Новый товар</option>
                                <option value="old">Б/У</option>
                            </select>
                            <input type="submit" class="btn btn-success form-control" value="Создать" name="addProduct"></div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <?php \core\includeFooter(); ?>




</div>
