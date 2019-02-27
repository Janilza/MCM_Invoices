<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("conexao.php");
?>
	
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Inicial">
    <meta name="author" content="Cristiana">

    <title>Produtos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>

  <body role="document">
<?php
	include_once("menu_Pagina_Inicial.php");	
	$id = $_GET['id'];
	//Executa consulta
	$result = mysql_query("SELECT * FROM produtos WHERE idProdutos = '$id'");
	$resultado = mysql_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Produto</h1>
	</div>
	
	 <div class="row">
		<div class="pull-right">
			<a href='produtos_Listar.php'><img src="imagens/list.png" width="30px" title="Listar"></a></a>
			<a href="#" onclick="javascript: if (confirm('Deseja remover este registo?'))location.href='produtos_Eliminar.php?id=<?php echo $resultado['idProdutos']; ?>'"><img src='imagens/edit_delete.png' width='30px' title="Eliminar"></a>
		</div>
	</div> 
	
	<div class="row">
		<div class="col-md-12">
				<div>
				<b>Id:</b>
				<?php echo $resultado['idProdutos']; ?>
			</div>
			<br>
			
			<div>
				<b>Nome:</b>
			<?php echo $resultado['Nome']; ?>
			</div>
			<br>
			
			<div>
				<b>Marca:</b>
			<?php echo $resultado['Marca']; ?>
			</div>
			<br>
			
			
			<div>
				<b>Preço:</b>
			<?php echo $resultado['Preco']; ?> <font>€</font>
			
			</div>
			<br>
			
			<p><h4>---FATURA---</h4></p>
			<br>
			<div>
				<b>NºFatura:</b>
			
			<?php
				$result_cat =mysql_query("SELECT NFatura FROM Faturas INNER JOIN 
							produtos ON faturas.idFaturas = produtos.Faturas_idFaturas where produtos.idProdutos= ".$resultado['idProdutos'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['NFatura']."</td>";
				}
			?>
			<br><br>
			
			<div>
				<b>Data de Emissão:</b>
			
			<?php
				$result_cat =mysql_query("SELECT DataEmissao FROM Faturas INNER JOIN 
							produtos ON faturas.idFaturas = produtos.Faturas_idFaturas where produtos.idProdutos= ".$resultado['idProdutos'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['DataEmissao']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
				<b>Data de Vencimento:</b>
			
			<?php
				$result_cat =mysql_query("SELECT DataVencimento FROM Faturas INNER JOIN 
							produtos ON faturas.idFaturas = produtos.Faturas_idFaturas where produtos.idProdutos= ".$resultado['idProdutos'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['DataVencimento']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
			<b>Término da Garantia:</b>
			<?php
			
				//Data de sistema
				$data_sistema = date("Y-m-d");  
				
				//Data de Vencimento
				$result_cat =mysql_query("SELECT DataVencimento FROM Faturas INNER JOIN 
							produtos ON faturas.idFaturas = produtos.Faturas_idFaturas where produtos.idProdutos= ".$resultado['idProdutos'].";");
				while($dataVencimento = mysql_fetch_assoc($result_cat)){
				
				
				
				if($dataVencimento['DataVencimento'] >= $data_sistema){
					// Calcula a diferença em segundos entre as datas
					$diferenca = strtotime($dataVencimento['DataVencimento']) - strtotime($data_sistema);
					
					//Calcula a diferença em dias
					$dias = floor($diferenca / (60 * 60 * 24));
					echo "Faltam <b>$dias</b> dias para terminar a sua garantia do produto ";?> <?php echo $resultado['Nome']; ?>
			<?php
				}else{
					echo "<font color='red'>A Garantia terminou.</font>";
				}
			
				
				}
				
			?>
				
			</div>
			<br>
			
			<div>
				<b>Sitio da Compra:</b>
			
			<?php
				$result_cat =mysql_query("SELECT OndeComprou FROM Faturas INNER JOIN 
							produtos ON faturas.idFaturas = produtos.Faturas_idFaturas where produtos.idProdutos= ".$resultado['idProdutos'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['OndeComprou']."</td>";
				}
			?>
			</div>
			<br>
			
			<div><b>Cópia da Fatura:</b>
			
			<?php
				$id = $_GET["id"];

				//$query ="SELECT ImportFatura FROM faturas WHERE ImportFatura = '".$id."'";  
				$query =("SELECT ImportFatura FROM Faturas INNER JOIN 
							produtos ON faturas.idFaturas = produtos.Faturas_idFaturas where produtos.idProdutos= ".$resultado['idProdutos'].";");
				
				$resultado = mysql_query($query);  
				$linhas = mysql_fetch_array($resultado);
				
				if($linhas['ImportFatura'] == NULL){
					//echo "sem foto";
					 echo "Sem Cópia da Fatura.";
				}else{
					echo "Pode visualizar a cópia da fatura na pasta <b><i>Anexos</i></b> 
					com o seguinte nome: <b><i>".$linhas['ImportFatura']." </i></b>";
				
				}
			?>
			</div>
			<br>
			
			
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

