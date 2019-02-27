<?php
	session_start();
	include_once("conexao.php");

	$id = $_GET["id"];

	$query ="SELECT ImportFatura FROM faturas WHERE idFaturas = '".$id."'";  
	$resultado = mysql_query($query);  
	$linhas = mysql_fetch_array($resultado);
	
	
		
		$result_req =mysql_query("SELECT Faturas_idFaturas FROM produtos WHERE Faturas_idFaturas ='$id'");
		
		$dados = mysql_fetch_assoc($result_req);
		$var_id_fatura = $dados['Faturas_idFaturas'];	
		
		if ($var_id_fatura > 0){ 
				  
			echo "
				<script type=\"text/javascript\">
					alert('Não pode eliminar esta fatura porque existem produtos associados a ela.'); 
					window.location.replace('faturas_Listar.php'); </script>
				</script>
			";	
		} 
	
	
	// Verifica se foi selecionado cópia da fatura 
	if(($linhas['ImportFatura'] == NULL)){
		//echo "sem pdf e zip";
			
		$query_Delete = mysql_query("DELETE FROM faturas WHERE idFaturas = $id");
		echo "
			<script type=\"text/javascript\">
				alert('Fatura removida sucesso!'); 
				window.location.replace('faturas_Listar.php'); </script>
			</script>
		";
	
	}else{
		
		
		$sql = mysql_query("SELECT ImportFatura FROM faturas WHERE idFaturas = '".$id."'");
		$img = mysql_fetch_object($sql);
			 
		// Remove o registo da base de dados
		$sql = mysql_query("DELETE FROM faturas WHERE idFaturas = '".$id."'");
		
		 
		if(($linhas['ImportFatura'] != NULL)){
			unlink("Anexos/".$img->ImportFatura."");
		}
		 
		echo "
			<script type=\"text/javascript\">
			alert('Removida com sucesso!'); 
			window.location.replace('faturas_Listar.php'); </script>
			</script>
		";
	}
	
?>