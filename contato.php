<br><br>
<h1>Contato</h1>
<hr>
<?php if(isset($_POST['nome'])):?>
    <p>Dados enviados com sucesso, abaixo seguem os dados que você enviou:</p>
    <p>Nome: <?php echo $_POST['nome'];?></p>
    <p>Email: <?php echo $_POST['email'];?></p>
    <p>Assunto: <?php echo $_POST['assunto'];?></p>
    <p>Mensagem: <?php echo $_POST['mensagem'];?></p>
<?php else :?>
    <form method="POST" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="nome" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
                <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
                <input name="email" type="email" class="form-control" id="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="assunto" class="col-sm-2 control-label">Assunto</label>
            <div class="col-sm-10">
                <input name="assunto" type="text" class="form-control" id="assunto" placeholder="Assunto">
            </div>
        </div>
        <div class="form-group">
            <label for="mensagem" class="col-sm-2 control-label">Mensagem</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="mensagem" id="mensagem"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Enviar</button>
            </div>
        </div>
    </form>
<?php endif;

