#1 Passo

Clone o projeto
```
git clone https://github.com/thiagovictor/MiniSite.git
```
Após clonar, execute os script para criar o banco de dados /script_sql/dump.sql.
Depois altere as variáveis de conexão com o banco de dados na classe /classes/conexao.class.php

Rodando a aplicação:
Entre no diretório clonado com o comando
```
cd MiniSite
```
Agora, iniciar o servidor PHP Built-in Server na pasta public
```
php -S localhost:8181 -t public
```

Populando com dados de teste. Digite no Browser.
```
http://localhost:8181/fixture
```


**Pronto, aplicação pronta para uso**