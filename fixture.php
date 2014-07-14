<?php

require_once './funcoes.php';

query("DROP TABLE IF EXISTS tb_paginas");
query("CREATE TABLE tb_paginas (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `conteudo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8");

query("INSERT INTO tb_paginas VALUES (null,'home','Esta e a pagina home da empresa. Nela voce encontrara um descritivo inicial.')");
query("INSERT INTO tb_paginas VALUES (null,'empresa','Nesta pagina sera colocado as informacoes que falem um pouco da empresa.')");
query("INSERT INTO tb_paginas VALUES (null,'produtos','Aqui sera descrito os produtos produzidos pela empresa.')");
query("INSERT INTO tb_paginas VALUES (null,'servicos','Esta pagina tera os servicos prestados por esta empresa.')");
query("INSERT INTO tb_paginas VALUES (null,'contato','<form method=\"POST\" class=\"form-horizontal\" role=\"form\">\r         <div class=\"form-group\">\r             <label for=\"nome\" class=\"col-sm-2 control-label\">Nome</label>\r             <div class=\"col-sm-10\">\r                 <input name=\"nome\" type=\"text\" class=\"form-control\" id=\"nome\" placeholder=\"Nome\">\r             </div>\r         </div>\r         <div class=\"form-group\">\r             <label for=\"email\" class=\"col-sm-2 control-label\">Email</label>\r             <div class=\"col-sm-10\">\r                 <input name=\"email\" type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Email\">\r             </div>\r         </div>\r         <div class=\"form-group\">\r             <label for=\"assunto\" class=\"col-sm-2 control-label\">Assunto</label>\r             <div class=\"col-sm-10\">\r                 <input name=\"assunto\" type=\"text\" class=\"form-control\" id=\"assunto\" placeholder=\"Assunto\">\r             </div>\r         </div>\r         <div class=\"form-group\">\r             <label for=\"mensagem\" class=\"col-sm-2 control-label\">Mensagem</label>\r             <div class=\"col-sm-10\">\r                 <textarea class=\"form-control\" rows=\"3\" name=\"mensagem\" id=\"mensagem\"></textarea>\r             </div>\r         </div>\r         <div class=\"form-group\">\r             <div class=\"col-sm-offset-2 col-sm-10\">\r                 <button type=\"submit\" class=\"btn btn-default\">Enviar</button>\r             </div>\r         </div>\r     </form>')");
query("INSERT INTO tb_paginas VALUES (null,'pesquisa','Resultados da busca: ')");

