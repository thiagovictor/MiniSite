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
    $stmt->execute() or die("erro");
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
        case "logout":
            unset($_SESSION["autenticado"]);
            unset($_SESSION["user"]);
            header("Location: /administracao");
            break;
        case "administracao":
            if(isset($_POST["username"])){
                $options = array(
                    array("indice" => "nome", "valor" => $_POST["username"], "param" => PDO::PARAM_STR)
                );
                $result = query("select * from tb_users where nome = :nome and ativo = 1", $options);
                
                if(array_key_exists("password", $result[0])){
                    if(password_verify($_POST["password"], $result[0]["password"])){
                        $_SESSION["autenticado"] = 1;
                        $_SESSION["user"] = $result[0]["nome"];
                        header("Location: /".$rota);
                    }
                }
               
            }
            if(!isset($_SESSION["autenticado"])){
                    
                    echo '
                    <form method="POST" class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="nome" class="col-sm-2 control-label">Usuário:</label>
                            <div class="col-sm-3">
                                <input name="username" type="text" class="form-control" id="nome">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="assunto" class="col-sm-2 control-label">Senha:</label>
                            <div class="col-sm-3">
                                <input name="password" type="password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-3">
                                <button type="submit" class="btn btn-default">Enviar</button>
                            </div>
                        </div>
                    </form>';
            }else if(isset($_GET["e"])){
                if(isset($_POST["conteudo"])){
                $options = array(
                    array("indice" => "nome", "valor" => $_POST["pagina"], "param" => PDO::PARAM_STR),
                    array("indice" => "conteudo", "valor" => $_POST["conteudo"], "param" => PDO::PARAM_STR),
                    array("indice" => "id", "valor" => $_POST["id"], "param" => PDO::PARAM_INT)
                );
                query("update tb_paginas set conteudo = :conteudo, nome = :nome where id = :id", $options);
                }
                $pagina = query("select * from tb_paginas where id = :id", array(array("indice" => "id", "valor" => $_GET['e'], "param" => PDO::PARAM_INT)));
                echo '	<form method="post">
                            <div class="col-sm-3">
                                <input name="pagina" type="text" class="form-control" value="'.$pagina[0]["nome"].'" id="pagina">
                            </div><br><br>                        
                        <p>
                        <input type="hidden" name="id" value="'.$_GET["e"].'">
			<textarea id="conteudo" name="conteudo">'.$pagina[0]["conteudo"].'</textarea>
                        <script type="text/javascript">
				CKEDITOR.replace( "conteudo" );
			</script>
                        </p>
                        <p>
			<button type="submit" class="btn btn-default btn-lg active">Salvar</button>
                        <a href="/administracao" class="btn btn-default btn-lg active" role="button">Cancelar</a>
                        </p>
                        </form>';
            }else{
                if(isset($_GET["d"])){
                    query("delete from tb_paginas where id = :id", array(array("indice" => "id", "valor" => $_GET['d'], "param" => PDO::PARAM_INT)));
                }
                $paginas = query("select * from tb_paginas");
               
                echo '<table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Pagina</th>
                        <th>Editar</th>
                        <th>excluir</th>
                      </tr>
                    </thead>
                    <tbody>';
                foreach ($paginas as $pagina) {
                    echo "<tr>
                            <td>{$pagina["id"]}</td>
                            <td>{$pagina["nome"]}</td>
                            <td><a href='/{$rota}?e={$pagina["id"]}'><img src='/img/alterar.png'></a></td>
                            <td><a href='/{$rota}?d={$pagina["id"]}'><img src='/img/excluir.png'></a></td>
                          </tr>";
                }     

                echo '</tbody>
                </table>';
            }
            break;
    }
}

function checaRota($rota) {
    $paginas = query("select * from tb_paginas");
    $rota["validador"] = true;
    if ($rota["path"] === "/") {
        $rota["path"] = "/home";
    }
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
