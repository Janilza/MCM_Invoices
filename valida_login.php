<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
$utilizadort = $_POST['utilizador'];
$passwordt = $_POST['password'];
include_once("conexao.php");

$result = mysql_query("SELECT * FROM Utilizador WHERE user ='$utilizadort' AND password='$passwordt'");
$resultado = mysql_fetch_assoc($result);
//echo "utilizador: ".$resultado['nome'];
if(empty($resultado)){
	//Mensagem de Erro
	$_SESSION['loginErro'] = "Utilizador ou Password Inválido";
	
	//Manda o utilizador para a tela de login
	header("Location: login.php");
}else{
	//Define os valores atribuidos na sessao do utilizador
	$_SESSION['utilizadorIdUtilizador'] 				= $resultado['idUtilizador'];
	$_SESSION['utilizadorNome'] 						= $resultado['Nome'];
	$_SESSION['utilizadorApelido'] 						= $resultado['Apelido'];
	$_SESSION['utilizadorEmail'] 						= $resultado['Email'];
	$_SESSION['utilizadorContacto'] 					= $resultado['Contacto'];
	$_SESSION['utilizadorUser'] 						= $resultado['User'];
	$_SESSION['utilizadorPassword'] 					= $resultado['Password'];
	
	header("Location: pagina_Inicial.php");
}
?>