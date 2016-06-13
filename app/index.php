<?php require_once 'assets/globals/config.php' ?>
<!DOCTYPE html>
<html ng-app="ninepixels" page-id="<?php echo $GLOBALS['page']['page_id'] ?>">
    <head>
        <?php include 'assets/globals/meta.php' ?>
        <?php include 'assets/globals/integration.php' ?>
    </head>
    <body class="<?php echo $GLOBALS['page']['page_name'] . '-page ' . str_replace('.php', '', $GLOBALS['page']['page_template']) ?>" ng-class="'editing'">

        <div class="site-controller" np-site-controller></div>

        <?php include 'templates/header.php' ?>

        <?php include $GLOBALS['content'] ?>

        <?php include 'templates/footer.php' ?>

    </body>
</html>