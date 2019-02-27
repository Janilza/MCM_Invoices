<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    
  <link rel="stylesheet" href="dist/css/bootstrap-submenu.css">
  <script src="dist/js/bootstrap-submenu.js" defer></script>
  

	<!--Rodapé-->
<style type="text/css" media="screen">
*  {
	margin:0;
	padding:0;
}

html, body {height:100%;}

.geral {
	min-height:100%;
	position:relative;
	width:800px;
}

.footer {
	position:fixed;
	bottom:0;
	width:100%;
}

.content {overflow:hidden;}
.aside {width:200px;}
.fleft {float:left;}
.fright {float:right;}
</style>
</head>

<!-- Inicio navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand js-scroll-trigger" href="pagina_Inicial.php"><font color="#FACC2E">INVOICES</font></a>  <!--Volta à pagina incial, não à de login -->
	</div>

	<div id="navbar" class="navbar-collapse collapse">
	  <ul class="nav navbar-nav">   

			<li>
				<a href="faturas_Listar.php"> Faturas</a>
			</li>
			
			<li>
				<a href="produtos_Listar.php"> Produtos</a>
			</li> 	  
			
			<li>
				<a href="sair.php">
				<img src="imagens/LOGOUT.png">&nbsp Sair</a>
			</li> 
	
	
		
	</div><!--/.nav-collapse -->
  </div>
</nav>
<!-- Fim navbar -->


  <!--Rodapé -->
<div class="content">
	<div class="footer">
	 <span class="copyright">&copy; <i>Cristiana&Janilza 2019 </i></span></div>
</div>
	
</html>