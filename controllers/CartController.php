<?php

/**
 * Class CartController
 * Class for cart manage
 */
class CartController {

    /**
     * Action for "Cart" main page
     */
    public function actionIndex() {

        $productsInCart = Cart::getProducts();

        if ($productsInCart) {

            $productsIds = array_keys($productsInCart);

            $products = Product::getProduсtsByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    /**
     * Action for add product in cart by asynchronous request(ajax)
     * @param integer $id product id
     */
    public function actionAddAjax($id) {
        echo Cart::addProduct($id);
        return true;
    }

    /**
     * Action for delete product from cart by asynchronous request(ajax)
     * @param integer $id product id
     */
    public function actionDeleteAjax($id) {

        $items = Cart::deleteProduct($id);

        $amount = Cart::getProductAmount($id);

        $totalPrice = 0;

        $productsInCart = Cart::getProducts();

        if ($productsInCart) {

            $productsIds = array_keys($productsInCart);

            $products = Product::getProduсtsByIds($productsIds);

            $totalPrice = Cart::getTotalPrice($products);
        }

        echo json_encode(array("items" => $items,
            "amount" => $amount,
            "price" => $totalPrice));

        return true;
    }

}
