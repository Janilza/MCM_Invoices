<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Inicial">
    <meta name="author" content="Cristiana">

    <title>Produtos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script->
	
  </head>

  <body role="document">
	<?php
		include_once("menu_Pagina_Inicial.php");	
	  
		if(isset($_SESSION['post_data'])){
			$_POST 			= $_SESSION['post_data'];
			$nome			= $_POST["nome"];
			$marca			= $_POST["marca"];
			$modelo 		= $_POST["modelo"];
			$preco 			= $_POST["preco"];
			$idFaturas		= $_POST["idFaturas"];
		}
		

	?>	
    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h2>Associar um Produto a uma fatura</h2>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="produtos_Inserir.php"> 
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nome do produto<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="nome" placeholder="Nome do produto" value="<?php if(isset($_POST["nome"])){ echo $_POST["nome"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Marca<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="marca" placeholder="Marca do produto" value="<?php if(isset($_POST["marca"])){ echo $_POST["marca"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Modelo<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="modelo" placeholder="Modelo do produto" value="<?php if(isset($_POST["modelo"])){ echo $_POST["modelo"];} ?>">
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Preço<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="preco" placeholder="Preço do produto" value="<?php if(isset($_POST["preco"])){ echo $_POST["preco"];} ?>">
				</div>
			  </div>
			  
			<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Associar Fatura<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <select class="form-control" name="idFaturas">
				 <option value="">Selecione a Fatura associada ao Produto</option>
				  <?php 
						#seleciona os dados da tabela tipo requerente	
						$resultado =mysql_query("SELECT idFaturas, Descricao  FROM faturas;");
						while($dados = mysql_fetch_assoc($resultado)){
							#preencher o select com dados
							?>
								<option value="<?php echo $dados["idFaturas"];?>"><?php echo $dados["Descricao"]; ?></option>
							<?php
						}
					?>
				</select>
			</div>
		  </div>
			  
			  
			<!--
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Anexo (jpg,png)</label>
				<div class="col-sm-10">
					<input type="file" name="p"/>
				</div>
			</div>-->
			  
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success">Inserir</button>
				</div>
			  </div>
			</form>
        </div>
		</div>
    </div> <!-- /container -->

	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>


