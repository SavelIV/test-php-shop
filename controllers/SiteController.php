<?php

/**
 * Class SiteController
 * site main pages
 */
class SiteController {

    /**
     * Action for "index" site page 
     */
    public function actionIndex() {

        $latestProducts = Product::getLatestProducts();


        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    /**
     * Action for "about" site page
     */
    public function actionAbout() {
        require_once(ROOT . '/views/site/about.php');
        return true;
    }

}
