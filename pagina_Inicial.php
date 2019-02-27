<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("conexao.php");
include_once("menu_Pagina_Inicial.php");
 // $connect = mysqli_connect("localhost", "root", "", "testing");  
 $query ="SELECT * FROM faturas ORDER BY idFaturas DESC";  
 $resultado = mysql_query($query);  
?>
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Inicial">
    <meta name="author" content="Cristiana">

    <title>Página Inicial</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>

  <body role="document">
	<?php
		include_once("menu_Pagina_Inicial.php");
	?>	
 
	  <div class="container">  
            <div>
			<!--<div class="page-header">-->
				<h2><i>Faturas</i>
				&nbsp
				<a href="fatura_Inserir_Formulario.php"><img src="imagens/add1.ico" width="30px" title="Adicionar Fatura"></a>
			
				</h2>
					
				
				
			</div> 
            <div class="table-responsive">  
                <table id="tecnico_data" class="table table-striped table-bordered">  
                     <thead>  
                         <tr>  
							<th>Nº da Fatura</th>
							<th>Data de Emissão</th>
							<th>Data de Vencimento</th>
							<th>Término (em dias)</th>
                        </tr>  
                    </thead>  
					
				  <?php 
					while($linhas = mysql_fetch_array($resultado)){
						echo "<tr>";
							echo "<td>".$linhas['NFatura']."</td>";
							echo "<td>".$linhas['DataEmissao']."</td>";
							echo "<td>".$linhas['DataVencimento']."</td>";
							
						//Data de sistema
						$data_sistema = date("Y-m-d");  
						
						//Data de Vencimento
				
						if($linhas['DataVencimento'] >= $data_sistema){
							// Calcula a diferença em segundos entre as datas
							$diferenca = strtotime($linhas['DataVencimento']) - strtotime($data_sistema);
							
							//Calcula a diferença em dias
							$dias = floor($diferenca / (60 * 60 * 24));
							echo "<td><font color='green'>Faltam ".$dias." dias</font></td>";
				
						}else{
							echo "<td><font color='red'>A Garantia terminou</font></td>";
							
						}	
							
				?>
									
							<?php
						echo "</tr>";
					}
				?>
                     </table>  
                </div>  
           </div> 
 

 </body>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>


	
	<!-- Script do spinner
    ================================================== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="js/spinner.js"></script>
	<script src="js/spinner_Function.js"></script>
	<!--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>    -->        
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
	
 </html>
 
 <!-- Script da função do spinner-->
 <script>  
 $(document).ready(function(){  
      $('#tecnico_data').DataTable();  
 });  
 </script>  
