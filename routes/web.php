<?php

return array(
    // Product:
    'product/([1-9][0-9]?)' => 'product/view/$1', 
    // Catalog:
    'catalog/sorting=([\w]+)/page=([1-6])' => 'catalog/index/$1/$2',
    // Cart:
    'cart/deleteAjax/([0-9]+)' => 'cart/deleteAjax/$1',   
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', 
    'cart' => 'cart/index', 
    //About:
    'about' => 'site/about',
    // Main page, redirection:
    'index' => 'site/index', 
    '.+' => 'site/index', 
    '' => 'site/index', 
);
