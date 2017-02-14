<?php

$toolbar = $GLOBALS['WITHOUT_TOOLBAR'] ? '?toolbar=false' : '';

if (!function_exists("getChild")) {

    function getChild($parent, $inNavigation = 1) {
        return array_filter($GLOBALS['PAGES'], function($obj) use ($parent, $inNavigation) {
            return isset($obj->parent) && $obj->parent->id === $parent->id && $obj->show_in_navigation === $inNavigation ? true : false;
        });
    }

}

$root_pages = array_filter($GLOBALS['PAGES'], function($obj) {
    return isset($obj->parent) || $obj->show_in_navigation !== 1 ? false : true;
});

echo '<ul class="main-navigation">';
echo '<div class="col-md-5">';

foreach ($root_pages as $key => $n_page) {
    $active = $n_page->name === $GLOBALS['page']->name ? 'active' : '';
    echo '<li><a href="/' . $n_page->name . $toolbar . '" class="' . $active . '">' . $n_page->navigation . '</a>';

    if (count(getChild($n_page))) {
        echo '<ul>';
        foreach (getChild($n_page) as $s_page) {
            echo '<li><a href="/' . $s_page->name . $toolbar . '">' . $s_page->navigation . '</a></li>';
        }
        echo '</ul>';
        echo '</li>';
    }

    if ($key === (count($root_pages) / 2)) {
        echo '</div>';
        echo '<div class="col-md-2 logo-container">';
        echo '<a href="/' . $toolbar . '"><img src="/np-assets/images/logo.png" alt="Hotel City Savoy" /></a>';
        echo '<span class="logo_mask"></span>';
        echo '</div>';
        echo '<div class="col-md-5">';
    }
}

echo '</div>';
echo '</ul>';
