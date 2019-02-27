<?php
session_start();
include_once("conexao.php");

$nome 					= $_POST["nome"];
$apelido 				= $_POST["apelido"];
$email 					= $_POST["email"];
$contacto 				= $_POST["contacto"];
$user 					= $_POST["user"];
$password 				= $_POST["password"];
$passwordc  			= $_POST['passwordc'];



if($nome == "" || $apelido == "" || $email == "" || $contacto == "" ||$user == "" || $password == "" || $passwordc == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('utilizador_Inserir_Formulario.php'); </script>";  
	return;
}

	
	
//************Verificar se as password coincidem*************************************	
if($password != $passwordc){
	$_SESSION['post_data'] = $_POST;

	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		  alert('As password não coincidem!'); 
		  window.location.replace('utilizador_Inserir_Formulario.php'); </script>";
}else{

	//********Verificar se já existe o user escolhido*******************************
	$sql = "select * from utilizador where user='$user' ";//selecionar tudo da tabela quando user for igual ao $user
	$query = mysql_query($sql); //executa o query
	$pesquisa = mysql_num_rows($query); //o total das linhas encontradas

	if (($pesquisa)=='0'){
		//pois se foi 0, não encontrou nenhum registro igual - FAZ O INSERT  
		
		try
		{
			//insere na BD
			//trim — Retira espaço no ínicio e final de uma string
			$sql = "INSERT INTO utilizador (nome, apelido, email, contacto, user, password) VALUES
			('".trim($nome)."', '".trim($apelido)."', '".trim($email)."', '".trim($contacto)."', '".trim($user)."', '".trim($password)."')";
			
			$result = mysql_query($sql) or die(mysql_error());
	 
			//retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
			//echo "1";
			
			$_SESSION['post_data']=NULL;
			//session_destroy();
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
			  alert('Utilizador inserido com sucesso!'); 
			  window.location.replace('login.php'); </script>";

		} 
		catch (Exception $ex)
		{
			//retorna 0 para no sucesso do ajax saber que foi um erro
		   // echo "0";
		   
		   $_SESSION['post_data']=NULL;
		   //session_destroy();
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
			  alert('Utilizador não inserido!'); 
			  window.location.replace('index.php'); </script>";
		}
	} else {
		//echo "Já existe um utilizador a usar este LOGIN";
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
			  alert('Já existe um Utilizador com este Login!'); 
			  window.location.replace('utilizador_Inserir_Formulario.php'); </script>";
	}
}
?>