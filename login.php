<?php
	session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
?>
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página para realizar login">
    <meta name="author" content="Cristiana">

    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>

  </head>


  <style type="text/css" media="screen">  
@import url(https://fonts.googleapis.com/css?family=Roboto:300);
.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FAFAFA;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #D8D8D8;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #FACC2E;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #2E2E2E;
  font-size: 16px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.form .register-form {
  display: none;
}

body {
  background: white; /* fallback for old browsers */
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}
  
  
  </style >
  
  <body>
	<?php
		include_once("menu_Login.php");
		unset($_SESSION['utilizadorIdTecnico'], 			
			  $_SESSION['utilizadorNome'], 				
			  $_SESSION['utilizadorApelido'], 				
			  $_SESSION['utilizadorNumero_Funcionario'], 	
			  $_SESSION['utilizadorEmail'], 				
			  $_SESSION['utilizadorContacto'], 			
			  $_SESSION['utilizadorFuncao'], 				
			  $_SESSION['utilizadorUser'],			
			  $_SESSION['utilizadorPassword']);
	?>
	<br><br><br>
   
	<div class="row">
		<div class="col-lg-12 text-center">
			<h2 class="section-heading text-uppercase"><i>Login</i></h2>
			<h3 class="section-subheading text-muted"><font color="#585858">
			Para aceder à Plataforma Digital tem de ter um Login válido, caso não tenha, registe-se.</font></h3>
	</div>
	<br><br>
	<div class="login-page">
	  <div class="form">
		<form class="form-signin" method="POST" action="valida_login.php">
		  <input type="text" name="utilizador"  placeholder="Utilizador"  required autofocus/>
		  <input type="password"  name="password"  placeholder="Password" required/>
		   <button class="btn btn btn-primary btn-block" type="submit">Login</button>
		 
		</form>	
		<p class="text-center text-danger">
			<?php
				if(isset($_SESSION['loginErro'])){
					echo $_SESSION['loginErro'];
					unset($_SESSION['loginErro']);
				}
			?>
		</p>
		
			<p class="message">Não está registado? <a href="utilizador_Inserir_Formulario.php">Criar Conta</a></p>
		
	  </div>
	  
	</div>
	
	
	<script>
		$('.message a').click(function(){
			$('form').animate({height: "toggle", opacity: "toggle"}, "slow");
		});
	</script>

  </body>
</html>