<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="section-inner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>
                    <?php if ($productsInCart): ?>
                        <p>Выбранные товары:</p>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Название</th>
                                <th>Стомость, $</th>
                                <th>Количество, шт</th>
                                <th>Наличие</th>
                                <th>Удалить 1 шт.</th>
                            </tr>
                            <?php foreach ($products as $product): ?>
                                <tr class="<?php echo $product['id']; ?>">
                                    <td><a href="/product/<?php echo $product['id']; ?>">
                                            <?php echo $product['name']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $product['price']; ?></td>
                                    <td class="<?php echo $product['id']; ?>"> <?php echo Cart::getProductAmount($product['id']); ?></td> 
                                    <td><?php echo Product::getAvailabilityText($product['availability']); ?></td>

                                    <td><a href="/cart/deleteAjax/<?php echo $product['id']; ?>"
                                           data-id="<?php echo $product['id']; ?>"
                                           class="delete-from-cart"> 
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="4">Общая стоимость, $:</td>
                                <td id="total"><?php echo $totalPrice; ?></td>
                            </tr>
                        </table>
                    <?php else: ?>
                        <p>Корзина пуста</p>
                        <a class="btn btn-default checkout" href="/"><i class="fa fa-shopping-cart"></i> Вернуться к покупкам</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>