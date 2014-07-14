#1 Passo

Clone o projeto
```
git clone https://github.com/thiagovictor/MiniSite.git
```
Após clonar, altere as variáveis de conexão com o banco de dados na classe /classes/conexao.class.php

Populando o sistema com dados com dados de teste:
Entre no diretório clonado com o comando
```
cd MiniSite
```
Agora digite o comando.
```
php fixture.php
```
Pronto. Agora, vamos iniciar o servidor PHP Built-in Server na pasta public
```
php -S localhost:8181 -t public
```
**Pronto, aplicação pronta para uso**