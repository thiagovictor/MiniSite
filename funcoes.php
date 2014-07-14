<?php

function limpaRota($rota) {
    return substr($rota["path"], 1);
}

function query($sql, array $bindValues = array()) {
    require_once './classes/conexao.class.php';
    $conexao = new conexao();
    $stmt = $conexao->getConn()->prepare($sql);

    foreach ($bindValues as $bindValue) {
        $stmt->bindValue($bindValue["indice"], $bindValue["valor"], $bindValue["param"]);
    }
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function rotinas($rota) {
    switch ($rota) {
        case "contato":
            if (isset($_POST['nome'])) {
                echo " <p>Dados enviados com sucesso, abaixo seguem os dados que você enviou:</p>
                       <p>Nome:{$_POST['nome']}</p>
                       <p>Email: {$_POST['email']}</p>
                       <p>Assunto: {$_POST['assunto']}</p>
                       <p>Mensagem: {$_POST['mensagem']}</p>";
            }
            break;
        case "pesquisa":
            if (isset($_POST['pesquisa'])) {
                $paginas = query("select * from tb_paginas where conteudo like :pesquisa or nome like :pesquisa", array(array("indice" => "pesquisa", "valor" => "%" . $_POST['pesquisa'] . "%", "param" => PDO::PARAM_STR)));
                foreach ($paginas as $pagina) {
                    echo "<li><a href='/{$pagina["nome"]}'>{$pagina["nome"]}</a></li><br>";
                }
            }
            break;
        case "fixture":
            query("delete from tb_paginas where id > 0");
            query("INSERT INTO tb_paginas VALUES (1,'fixture','Preenchendo com dados de teste')");
            query("INSERT INTO tb_paginas VALUES (2,'home','Esta e a pagina home da empresa. Nela voce encontrara um descritivo inicial.')");  
            query("INSERT INTO tb_paginas VALUES (3,'empresa','Nesta pagina sera colocado as informacoes que falem um pouco da empresa.')");
            query("INSERT INTO tb_paginas VALUES (4,'produtos','Aqui sera descrito os produtos produzidos pela empresa.')");
            query("INSERT INTO tb_paginas VALUES (5,'servicos','Esta pagina tera os servicos prestados por esta empresa.')");
            query("INSERT INTO tb_paginas VALUES (6,'contato','<form method=\"POST\" class=\"form-horizontal\" role=\"form\">\r         <div class=\"form-group\">\r             <label for=\"nome\" class=\"col-sm-2 control-label\">Nome</label>\r             <div class=\"col-sm-10\">\r                 <input name=\"nome\" type=\"text\" class=\"form-control\" id=\"nome\" placeholder=\"Nome\">\r             </div>\r         </div>\r         <div class=\"form-group\">\r             <label for=\"email\" class=\"col-sm-2 control-label\">Email</label>\r             <div class=\"col-sm-10\">\r                 <input name=\"email\" type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Email\">\r             </div>\r         </div>\r         <div class=\"form-group\">\r             <label for=\"assunto\" class=\"col-sm-2 control-label\">Assunto</label>\r             <div class=\"col-sm-10\">\r                 <input name=\"assunto\" type=\"text\" class=\"form-control\" id=\"assunto\" placeholder=\"Assunto\">\r             </div>\r         </div>\r         <div class=\"form-group\">\r             <label for=\"mensagem\" class=\"col-sm-2 control-label\">Mensagem</label>\r             <div class=\"col-sm-10\">\r                 <textarea class=\"form-control\" rows=\"3\" name=\"mensagem\" id=\"mensagem\"></textarea>\r             </div>\r         </div>\r         <div class=\"form-group\">\r             <div class=\"col-sm-offset-2 col-sm-10\">\r                 <button type=\"submit\" class=\"btn btn-default\">Enviar</button>\r             </div>\r         </div>\r     </form>')");
            query("INSERT INTO tb_paginas VALUES (7,'pesquisa','Resultados da busca: ')");
            break;
    }
}

function checaRota($rota) {
    $paginas = query("select * from tb_paginas");
    $rota["validador"] = true;
    foreach ($paginas as $pagina) {
        if ($pagina["nome"] === limpaRota($rota)) {
            $rota["validador"] = false;
            echo "<br><br><h1>" . strtoupper($pagina["nome"]) . "</h1><hr>";

            echo ($pagina["conteudo"]);
            rotinas(limpaRota($rota));
        }
    }
    if ($rota["validador"]) {
        header('HTTP/1.1 404 Not Found');
        require_once("/error/404.php");
    }
}
