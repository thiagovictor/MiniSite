<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <ul class="nav navbar-nav">
            <li><a href="/home">Home</a></li>
            <li><a href="/empresa">Empresa</a></li>
            <li><a href="/produtos">Produtos</a></li>
            <li><a href="/servicos">Serviços</a></li>
            <li><a href="/contato">Contato</a></li>
            <?php if(isset($_SESSION["autenticado"])):?>
            <li><a href="/administracao">Administração</a></li>
            <li><a href="/logout">Sair(<?php echo $_SESSION["user"]?>)</a></li>
            <?php else:?>
            <li><a href="/administracao">Área restrita</a></li>
            <?php endif;?>
            <li>
                <form method="POST" action="/pesquisa" class="form-search">
                    <input type="text" name="pesquisa" class="input-medium search-query">
                    <button type="submit" class="btn">Search</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

