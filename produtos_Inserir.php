<?php
session_start();
include_once("conexao.php");

$nome 			= $_POST["nome"];
$marca			= $_POST["marca"];
$modelo 		= $_POST["modelo"];
$preco 			= $_POST["preco"];
$idFaturas		= $_POST["idFaturas"];


if($nome == "" || $marca == "" || $modelo == "" || $preco == "" || $idFaturas == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('produtos_Inserir_Formulario.php'); </script>";  
	return;
}

	try
    {
        //insere na BD
		$sql = "INSERT INTO produtos (nome, marca, modelo, preco, Faturas_idFaturas) VALUES 
		('".trim($nome)."', '".trim($marca)."', '".trim($modelo)."', '".trim($preco)."', '".trim($idFaturas)."')";
		
		$result = mysql_query($sql) or die(mysql_error());
 
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        //echo "1";
		
		$_SESSION['post_data']=NULL;
		//session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Produto associado à fatura com sucesso!'); 
				  window.location.replace('produtos_Listar.php');
			   </script>";

    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
	   
	   $_SESSION['post_data']=NULL;
	   //session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Produto não associado à fatura!'); 
				  window.location.replace('pagina_Inicial.php'); 
			 </script>";
    }
	

?>
