<?php

/*
 * $table {string} Table from whome to retrive content
 * $identify {string} Identifier for items content
 * $ident {string} Identifier of content
 * $identValue {string} Value of content identifier
 * $create {string} Create table if dont't exist
 */

function get_content($args) {
    $mysqli = $GLOBALS['mysqli'];

    if (isset($args['create'])) {
        createStructure($args['table'], $mysqli);
    }

    $sql = 'SELECT * FROM ' . $args['table'];

    if (isset($args['ident']) || isset($args['identify'])) {
        $sql .= ' WHERE ';
    }

    if (isset($args['identify'])) {
        $sql .= 'item_identifier = "' . $args['identify'] . '"';
        if (isset($args['ident'])) {
            $sql .= ' AND ';
        }
    }

    if (isset($args['gallery-identify'])) {
        $sql .= 'gallery_identifier = "' . $args['gallery-identify'] . '"';
        if (isset($args['ident'])) {
            $sql .= ' AND ';
        }
    }

    if (isset($args['ident']) && is_array($args['ident'])) {
        $identLength = count($args['ident']);
        $i = 0;
        foreach ($args['ident'] as $var => $val) {
            $val === 'IS NULL' ?
                            $sql .= $var . ' ' . $val :
                            $sql .= $var . ' = "' . $val . '"';

            if ($i !== $identLength - 1) {
                $sql .= ' AND ';
            }

            $i++;
        }
    } else if (isset($args['ident'])) {
        $sql .= $args['ident'] . ' = "' . $args['identValue'] . '"';
    }

    if (isset($args['order'])) {
        $sql .= ' ORDER BY ' . $args['order'];
    }

    $mysqli->query('SET NAMES utf8');

    if ($mysqli->query($sql)->num_rows === 0 && isset($args['identify'])) {
        echo '<div class="ninepixels_item_holder" np-editor data-identifier="' . $args['identify'] . '"></div>';
    }

    if (isset($args['gallery-identify'])) {
        echo '<div class="ninepixels_item_holder" np-editor data-identifier="' . $args['gallery-identify'] . '" data-type="gallery"></div>';
    }

    return $mysqli->query($sql);
}

function createStructure($table, $mysqli) {
    if ($table === 'users') {
        return false;
    }

    switch ($table) {
        case 'pages':
            $sql = "CREATE TABLE IF NOT EXISTS pages (
                page_id                 int(11) NOT NULL AUTO_INCREMENT,
                user_id                 int(11) NOT NULL,
                page_parent             int(11) DEFAULT NULL,
                page_name               varchar(64) NOT NULL,
                page_template           varchar(64) NOT NULL,
                page_navName            varchar(128) DEFAULT NULL,
                page_title              varchar(60) DEFAULT NULL,
                page_description        varchar(160) DEFAULT NULL,
                page_teaser             varchar(128) DEFAULT NULL,
                page_header             tinyint(1) NOT NULL DEFAULT '1',
                page_navigation         tinyint(1) NOT NULL DEFAULT '1',
                page_footer             tinyint(1) NOT NULL DEFAULT '1',
                page_inNavigation       tinyint(1) NOT NULL DEFAULT '1',
                page_active             tinyint(1) NOT NULL DEFAULT '1',
                page_order              int(11) DEFAULT 0,
                page_delete             int(11) DEFAULT 0,
                page_timestamp          timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (page_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            break;

        case 'gallery':
            $sql = "CREATE TABLE IF NOT EXISTS gallery (
                gallery_id              int(11) NOT NULL AUTO_INCREMENT,
                user_id                 int(11) NOT NULL,
                page_id                 int(11) DEFAULT NULL,
                gallery_identifier      varchar(32) CHARACTER SET utf8 NOT NULL,
                gallery_image           varchar(128) CHARACTER SET utf8 NOT NULL,
                gallery_video           varchar(128) CHARACTER SET utf8,
                gallery_preview         int(11) DEFAULT 0,
                gallery_editable        int(11) DEFAULT 1,
                gallery_delete          int(11) DEFAULT 0,
                gallery_timestamp       timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (gallery_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
            break;

        default:
            $sql = "CREATE TABLE IF NOT EXISTS " . $table . " (
                item_id                 int(11) NOT NULL AUTO_INCREMENT,
                user_id                 int(11) NOT NULL,
                page_id                 int(11) DEFAULT NULL,
                item_identifier         varchar(32) CHARACTER SET utf8 NOT NULL,
                item_structure          varchar(10960) CHARACTER SET utf8 NOT NULL,
                item_image              varchar(128) CHARACTER SET utf8 NOT NULL,
                item_video              varchar(128) CHARACTER SET utf8,
                item_class              varchar(64) CHARACTER SET utf8 NOT NULL,
                item_order              int(11) DEFAULT 0,
                item_editable           int(11) DEFAULT 1,
                item_delete             int(11) DEFAULT 0,
                item_timestamp          timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (item_id)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    }

    $mysqli->query($sql);
}
