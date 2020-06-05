<?php include ROOT . '/views/layouts/header.php'; ?>

<section class="section-inner">
    <div class="container text-center" >
        <!-- Page navigation -->
        <p>Страница:<?php echo $pagination->get(); ?> </p>
        <p><a href="/catalog/sorting=name/page=1" class="btn btn-default">Сортировать по названию</a> <a href="/catalog/sorting=price/page=1" class="btn btn-default">Сортировать по цене</a></p>
        <div class="row">
            <div class="col-md-12">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Все товары</h2>
                    <?php foreach ($productsByName as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
                                        <h2>$<?php echo $product['price']; ?></h2>
                                        <h2>
                                            <a href="/product/<?php echo $product['id']; ?>">
                                                <?php echo $product['name']; ?>
                                            </a>
                                        </h2>
                                        <p><b>Наличие:</b> <?php echo Product::getAvailabilityText($product['availability']); ?></p>
                                        <a href="/cart/addAjax/<?php echo $product['id']; ?>" 
                                           data-id="<?php echo $product['id']; ?>"
                                           class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину 
                                        </a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>$<?php echo $product['price']; ?></h2>
                                            <h2><a href="/product/<?php echo $product['id']; ?>">
                                                    <?php echo $product['name']; ?>
                                                </a></h2>
                                            <p><b>Наличие:</b> <?php echo Product::getAvailabilityText($product['availability']); ?></p>
                                            <a href="/cart/addAjax/<?php echo $product['id']; ?>" 
                                               data-id="<?php echo $product['id']; ?>"
                                               class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>В корзину 
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>                   
                </div><!--features_items-->
            </div>
        </div>
        <!-- Page navigation -->
        <p>Страница:<?php echo $pagination->get(); ?> </p>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>