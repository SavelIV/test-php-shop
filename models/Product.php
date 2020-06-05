<?php

/**
 * Class Product 
 * Model for working with products
 */
class Product {

    // products amount displayed on current page by default
    const SHOW_BY_DEFAULT = 10;

    /**
     * Returns latest products array for main page
     * @param int $count [optional] products amount on current page
     * @return array array with products([product]=>[amount])
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM product '
                . 'ORDER BY availability DESC, id DESC '
                . 'LIMIT :count';

        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['availability'] = $row['availability'];
            $productsList[$i]['description'] = $row['description'];
            $i++;
        }
        return $productsList;
    }

    /**
     * Returns product list sorting by name/price
     * @param string $sort name/price sorting
     * @param int $page [optional] current page number
     * @return array array with products
     */
    public static function getProductsListSorting($sort, $page = 1) {
        
        $limit = self::SHOW_BY_DEFAULT;
        
        $offset = ($page - 1) * $limit;

        $db = Db::getConnection();

        $sql = 'SELECT id, name, price, availability FROM product '
                . 'ORDER BY availability DESC, '. $sort . ' ASC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['availability'] = $row['availability'];
            $i++;
        }
        return $products;
    }

    /**
     * Returns product info by id
     * @param integer $id product id
     * @return mixed array with product info/false
     */
    public static function getProductById($id) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM product WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Returns total products amount
     * @return mixed integer(products amount in category)/false
     */
    public static function getTotalProducts() {
        $db = Db::getConnection();

        $sql = 'SELECT count(id) AS count FROM product';

        $result = $db->prepare($sql);
        $result->execute();

        $row = $result->fetch();
        return $row['count'];
    }

    /**
     * Returns array of products depending on their ids
     * @param array $idsArray array with product ids
     * @return array array with products list
     */
    public static function getProduсtsByIds($idsArray) {
        $db = Db::getConnection();

        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE id IN ($idsString)";

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['availability'] = $row['availability'];
            $i++;
        }
        return $products;
    }

   
    /**
     * Returns all products array
     * @return array array with products
     */
    public static function getProductsList() {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, name, price, availability FROM product ORDER BY id ASC');
        $productsList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['availability'] = $row['availability'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }
        return $productsList;
    }


    /**
     * Returns text about product availability status:
     * 0 - to order, 1 - available
     * @param integer $availability status
     * @return string text
     */
    public static function getAvailabilityText($availability) {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
        }
    }

    /**
     * Returns image path
     * @param integer $id product id (image id)
     * @return string path to image
     */
    public static function getImage($id) {

        $noImage = 'no-image.jpg';

        $path = '/template/images/products/';

        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {

            return $pathToProductImage;
        }

        return $path . $noImage;
    }

}
