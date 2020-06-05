<?php

/**
 * Class Cart
 * Model for working with cart
 */
class Cart {

    /**
     * Add product in cart (session)
     * @param integer $id product id
     * @return integer products in cart amount
     */
    public static function addProduct($id) {

        $id = intval($id);

        $productsInCart = array();

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++;
        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItems();
    }

    /**
     * Get total amount of products in cart (in session)
     * @return integer products in cart amount
     */
    public static function countItems() {

        if (isset($_SESSION['products'])) {

            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }

    /**
     * Return id and amount of products in cart
     * @return mixed boolean or array
     */
    public static function getProducts() {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return false;
    }
    
    /**
     * Return amount of product (id) in cart
     * @param integer $id product id
     * @return mixed 0 or array
     */
    public static function getProductAmount($id) {
        
         $id = intval($id);

         $productsInCart = self::getProducts();

        if (array_key_exists($id, $productsInCart)) {
            return $productsInCart[$id];
        }
        return 0;
    }

    /**
     * Get total price of products in cart
     * @param array $products array with products info
     * @return integer total price of products in cart
     */
    public static function getTotalPrice($products) {

        $productsInCart = self::getProducts();

        $total = 0;
        if ($productsInCart) {
            foreach ($products as $item) {
                $total += $item['price'] * $productsInCart[$item['id']];
            }
        }
        return $total;
    }


    /**
     * Delete product (by id) from cart
     * @param integer $id product id
     * @return integer products in cart amount
     */
    public static function deleteProduct($id) {

         $id = intval($id);

         $productsInCart = self::getProducts();

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] --;
        }
        if ($productsInCart[$id] <= 0) {
            unset ($productsInCart[$id]);
        }
        $_SESSION['products'] = $productsInCart;
        return self::countItems();
    }

}
