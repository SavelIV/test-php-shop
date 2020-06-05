<?php

/**
 * Class ProductController
 * Class for product manage
 */
class ProductController {

    /**
     * Action for "Product view" page
     * @param integer $productId product id
     */
    public function actionView($productId) {

        $product = Product::getProductById($productId);

        require_once(ROOT . '/views/product/view.php');
        return true;
    }

}
