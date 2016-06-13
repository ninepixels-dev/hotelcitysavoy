<?php

// Main Navigation
echo '<ul class="main-navigation">';
$args = array(
    'table' => 'pages',
    'ident' => array('page_inNavigation' => '1', 'page_parent' => 'IS NULL')
);
$result = get_content($args);
while ($row = $result->fetch_assoc()) {
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
echo '</ul>';

// Meta Navigation
echo '<ul class="meta-navigation">';
$args = array('table' => 'pages', 'ident' => 'page_parent', 'identValue' => '7');
$result = get_content($args);
while ($row = $result->fetch_assoc()) {
    echo '<li><a href="' . $row['page_name'] . '">' . $row['page_navName'] . '</a></li>';
}
echo '</ul>';
