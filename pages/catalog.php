<?php
    require __DIR__ . '/../core/CatalogModule.php';
    require_once __DIR__.'/../core/AccountModule.php';

    $catalog = new core\CatalogModule();


    $catalog->postListener();
    include __DIR__.'/../layouts/head.php';

?>
<?php \core\includeHeader(); ?>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <main>
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <form action="" method="post">
                            <input type="submit" name="all" class="btn btn-success" value="Все товары">
                            <input type="submit" name="new" class="btn btn-success" value="Новые товары">
                            <input type="submit" name="old" class="btn btn-success" value="Б/У товары">
                        </form>
                    </div>
                    <div class="col-md-4 ">
                        <?php if(\core\AccountModule::isLogined()): ?>
                        <a href="/admin/new.php" class="btn btn-primary float-right">Добавить новый товар</a>
                        <?php endif; ?>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Имя</th>
                        <th>Количество</th>
                        <?php if(\core\AccountModule::isLogined()): ?>
                         <th>Операции</th>
                        <?php endif; ?>
                    </tr>
                    <?php
                       $products = $catalog->getProducts();
                       foreach ($products as $product):
                    ?>
                       <tr>
                           <td><?= $product['id'] ?></td>
                           <td><?= $product['name'] ?></td>
                           <td><?= $product['count'] ?></td>
                           <?php if(\core\AccountModule::isLogined()): ?>
                           <td>
                               <form action="" method="post">
                                   <div class="form-group">
                                       <button type="submit" name="update" value="<?= $product['id'] ?>" class="btn btn-danger">
                                           <i class="fas fa-wrench"></i>
                                       </button>
                                       <button type="submit" name="delete" value="<?= $product['id'] ?>" class="btn btn-danger">
                                           <i class="fas fa-trash-alt"></i>
                                       </button>
                                   </div>

                               </form>
                           </td>
                           <?php endif; ?>
                       </tr>
                    <?php endforeach; ?>
                </table>

            </main>
        </div>
    </div>
</div>
<?php \core\includeFooter(); ?>
