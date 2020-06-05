<?php

/**
 * Class CatalogController
 * Class for products catalog manage
 */
class CatalogController {

    /**
     * Action for "Catalog" main page
     * @param string $sort name/price sorting
     * @param int $page [optional] current page number
     */
    public function actionIndex($sort, $page = 1) {

        $productsByName = Product::getProductsListSorting($sort, $page);

        $total = Product::getTotalProducts();

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page=');
        
        require_once(ROOT . '/views/catalog/index.php');
        return true;
    }
}
