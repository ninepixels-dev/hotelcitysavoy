<?php

// Main Navigation
echo '<ul class="main-navigation">';
echo '<div class="col-md-5">';

$args = array(
    'table' => 'pages',
    'ident' => array('page_inNavigation' => '1', 'page_parent' => 'IS NULL')
);
$i = 0;
$result = get_content($args);
while ($row = $result->fetch_assoc()) {
    if ($i === ($result->num_rows / 2)) {
        echo '</div>';
        echo '<div class="col-md-2 logo-container">';
        echo '<img src="assets/images/logo.png" alt="Hotel City Savoy" />';
        echo '<span class="logo_mask"></span>';
        echo '</div>';
        echo '<div class="col-md-5">';
    }
    $i++;
    echo '<li><a href="' . $row['page_name'] . '">' . $row['page_navName'] . '</a>';
    $args = array('table' => 'pages', 'ident' => 'page_parent', 'identValue' => $row['page_id']);
    $subNavigation = get_content($args);
    if ($subNavigation->num_rows !== 0) {
        echo '<ul>';
        while ($sub = $subNavigation->fetch_assoc()) {
            echo '<li><a href="' . $sub['page_name'] . '">' . $sub['page_navName'] . '</a></li>';
        }
        echo '</ul>';
    }
    echo '</li>';
}
echo '</div>';
echo '</ul>';
