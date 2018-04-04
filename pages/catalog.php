<?php
    include __DIR__.'/../layouts/head.php';
    require __DIR__ . '/../core/CatalogModule.php';

    $catalog = new core\CatalogModule();

    if(isset($_POST['new'])) // если была нажата кнопка только для всех товаров
        $catalog->setProductsQuality('new'); // устанавливаем тип продукта для выборки из базы
    elseif(isset($_POST['old']))
        $catalog->setProductsQuality('old');
?>
<div class="container">
    <?php \core\includeHeader(); ?>

    <div class="row">
        <div class="col-md-12">
            <main>
                <div class="row justify-content-between">
                    <div class="col-md-12">
                        <form action="" method="post">
                            <input type="submit" name="all" class="btn btn-success" value="Все товары">
                            <input type="submit" name="new" class="btn btn-success" value="Новые товары">
                            <input type="submit" name="old" class="btn btn-success" value="Б/У товары">
                        </form>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Количество</th>
                    </tr>
                    <?php
                       $products = $catalog->getProducts();
                       foreach ($products as $product):
                    ?>
                       <tr>
                           <td><?= $product['id'] ?></td>
                           <td><?= $product['name'] ?></td>
                           <td><?= $product['count'] ?></td>
                       </tr>
                    <?php endforeach; ?>
                </table>

            </main>
        </div>
    </div>

    <?php \core\includeFooter(); ?>
</div>
