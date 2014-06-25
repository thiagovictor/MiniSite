<!DOCTYPE html>
<html>
    <?php require_once('head.php'); ?>
    <body>
        <?php require_once('menu.php'); ?>
        <div class="container">
            <?php if (isset($_GET["pagina"])): ?>
                <?php $paginaSolicitada = $_GET["pagina"]; ?>
                <?php foreach ($permitidas as $pagina): ?>
                    <?php if ($paginaSolicitada . '.php' === $pagina): ?>
                        <?php require_once($pagina); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php require_once('footer.php'); ?>
        </div>
    </body>
</html>
