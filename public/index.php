<?php chdir(dirname(__DIR__)); ?>
<!DOCTYPE html>
<html>
    <?php require_once('head.php'); ?>
    <body>
        <?php require_once('menu.php'); ?>
        <?php require_once('config.php'); ?>
        <?php require_once('funcoes.php'); ?>
        
        
        <?php
            $rota = parse_url("http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]); 
        ?>
        
        <div class="container">
            <?php checaRota($rota, $rotasPermitidas) ?>          
            <?php require_once('footer.php'); ?>
        </div>
    </body>
</html>
