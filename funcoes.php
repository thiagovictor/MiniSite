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
