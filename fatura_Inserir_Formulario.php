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

	<title>Faturas</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script->
	
	<style type="text/css">
			.carregando{
				color:#FF0000;
				display:none;
			}
	</style>
  </head>

  <body role="document">
	<?php
		include_once("menu_Pagina_Inicial.php");	
	  
		if(isset($_SESSION['post_data'])){
			$_POST 					= $_SESSION['post_data'];
			$nfatura				= $_POST["nfatura"];
			$descricao				= $_POST["descricao"];
			$data_emissao			= $_POST["data_emissao"];
			$data_vencimento		= $_POST["data_vencimento"];
			$onde_comprou			= $_POST["onde_comprou"];
		}   
		    
	?>	   
	
	
<!--********************DATA***************************************************************-->
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>


    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Inicializar Fatura</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="fatura_Inserir.php" role="form" enctype="multipart/form-data"> 
			
			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Número da Fatura<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-2">
				  <input type="text" class="form-control" name="nfatura" placeholder="Número da Fatura" value="<?php if(isset($_POST["nfatura"])){ echo $_POST["nfatura"];} ?>">
				</div>
			  </div>
			  
			   <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Descrição<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="descricao" placeholder="Descrição" value="<?php if(isset($_POST["descricao"])){ echo $_POST["descricao"];} ?>">
				</div>
			  </div>
			
			<div class="form-group">
				<label class="control-label col-sm-2 requiredField" for="date">Data de Emissão<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar">
							</i>
						</div>
						<input class="form-control" onclick="func_data_emissao()" id="data_emissao" name="data_emissao" placeholder="YYYY/MM/DD" type="text" value="<?php if(isset($_POST["data_emissao"])){ echo $_POST["data_emissao"];} ?>"/>
					</div>
				</div>
			</div>
			
			
			  <div class="form-group">
				<label class="control-label col-sm-2 requiredField" for="date">Data de Vencimento<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar">
							</i>
						</div>
						<input class="form-control" onclick="func_data_vencimento()" id="data_vencimento" name="data_vencimento" placeholder="YYYY/MM/DD" type="text" value="<?php if(isset($_POST["data_vencimento"])){ echo $_POST["data_vencimento"];} ?>"/>
					</div>
				</div>
			</div>	
			
			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Onde Comprou<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="onde_comprou" placeholder="Onde foi comprado o produto" value="<?php if(isset($_POST["onde_comprou"])){ echo $_POST["onde_comprou"];} ?>">
				</div>
			  </div>
			
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Importar Fatura Original</label>
				<div class="col-sm-10">
					<input type="file" name="importar_fatura" id="importar_fatura" accept="application/pdf"/>
				</div>
			</div>
			  
		  
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success">Inserir</button>
				</div>
			  </div>
		
		
	
			</form>
        </div>
		</div>
    </div> <!-- /container -->

	
	
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		  google.load("jquery", "1.4.2");
		</script>
		
		<script type="text/javascript">
		
		$(function(){
			$('#idtipo_requerente').change(function(){
				if( $(this).val() ) {
					$('#idrequerente').hide();
					//$('.carregando').show();
					$.getJSON('posto_Trabalho_ComboBox.php?search=',{idtipo_requerente: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Selecione o Nome do Requerente</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].idRequerente + '">' + j[i].Nome_Requerente + '</option>';
						}	
						$('#idrequerente').html(options).show();
						//$('.carregando').hide();
					});
				} else {
					$('#idrequerente').html('<option value="">Selecione o Tipo de Requerente</option>');
				}
			});
		});
		</script>
	
	
	
	

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

<!--********************DATA***************************************************************-->
<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
	
	function func_data_emissao(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_emissao"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
	function func_data_vencimento(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_vencimento"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
	
</script>