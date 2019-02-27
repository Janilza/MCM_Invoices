<?php
session_start();
include_once("conexao.php");

$nfatura				= $_POST["nfatura"];
$descricao				= $_POST["descricao"];
$data_emissao			= $_POST["data_emissao"];
$data_vencimento		= $_POST["data_vencimento"];
$onde_comprou			= $_POST["onde_comprou"];
$importar_fatura		= $_FILES["importar_fatura"];	


if($nfatura == "" || $descricao == "" || $data_emissao == "" || $data_vencimento == "" || $onde_comprou == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('fatura_Inserir_Formulario.php'); </script>";  
	return;
}

	//Copia da fatura - PDF
	$allowedExts = array("pdf");
	$temp = explode(".", $_FILES["importar_fatura"]["name"]);
	$extension = end($temp);
	
	
	// Verifica se foi selecionado cópia da fatura 
	if (!empty($importar_fatura["name"])){
		//echo "selecionado PDF";
		$_SESSION['post_data'] = $_POST;
		
		if(strstr('.pdf', $extension)){
			
			$_SESSION['post_data'] = $_POST;
			// Gera um nome único para o PDF
			$nome_pdf= md5(uniqid(time())) . "." . $extension;
		 
			// Caminho de onde ficará o PDF
			$caminho_pdf = "Anexos/" . $nome_pdf;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["importar_fatura"]["tmp_name"], $caminho_pdf);
			
			
			
		}else{
			 //echo"O arquivo possui extensão inválida, só permite <b>PDF<b>." ;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('A cópia da fatura possui extensão inválida, só permite PDF.'); 
						window.location.replace('fatura_Inserir_Formulario.php'); 
				</script>";
		}	
			$sql = "INSERT INTO faturas (
				NFatura, Descricao, DataEmissao, DataVencimento, OndeComprou, ImportFatura) VALUES
				('".trim($nfatura)."', '".trim($descricao)."', '".trim($data_emissao)."', '".trim($data_vencimento)."', '".trim($onde_comprou)."', '$nome_pdf')";
			
			$result = mysql_query($sql) or die(mysql_error());
			
				//if($sql){
					//echo "Data Submit Successful";
			$_SESSION['post_data']=NULL;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Fatura Inicializada!'); 
					window.location.replace('pagina_Inicial.php');
				</script>";
	}
		
		
		
	else if ((!empty($importar_fatura["name"]))) {
		//echo "selecionado PDf";
		$_SESSION['post_data'] = $_POST;
	
		//Verifica se a extensão é PDF
		if(strstr('.pdf', $extension)){
		
			// Gera um nome único para o PDF
			$nome_pdf= md5(uniqid(time())) . "." . $extension;
		 
			// Caminho de onde ficará o PDF
			$caminho_pdf = "Anexos/" . $nome_pdf;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["importar_fatura"]["tmp_name"], $caminho_pdf);
				
			//Insere na BD o nome do PDF
			$sql ="INSERT INTO faturas (
				NFatura, Descricao, DataEmissao, DataVencimento, OndeComprou, ImportFatura) VALUES
				('".trim($nfatura)."', '".trim($descricao)."', '".trim($data_emissao)."', '".trim($data_vencimento)."', '".trim($onde_comprou)."', '$nome_pdf')";
			
			
			$result = mysql_query($sql) or die(mysql_error());
			
				//if($sql){
					//echo "Data Submit Successful";
			$_SESSION['post_data']=NULL;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('Fatura Inicializada!'); 
					window.location.replace('pagina_Inicial.php');
				</script>";
		}
		else{
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Fatura Inicializada!'); 
				window.location.replace('pagina_Inicial.php');
				</script>";
		}
	}
	else{ 
			//echo "sem selecionados";
			try
			{
			
				$sql ="INSERT INTO faturas (
				NFatura, Descricao, DataEmissao, DataVencimento, OndeComprou) VALUES
				('".trim($nfatura)."', '".trim($descricao)."', '".trim($data_emissao)."', '".trim($data_vencimento)."', '".trim($onde_comprou)."')";
			
			
				$result = mysql_query($sql) or die(mysql_error());
		 
				
				$_SESSION['post_data']=NULL;
					echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Fatura Inicializada!'); 
					window.location.replace('pagina_Inicial.php');
				</script>";

			} 
			catch (Exception $ex)
			{
			   $_SESSION['post_data']=NULL;
					echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Fatura não Inicializada!'); 
					window.location.replace('pagina_Inicial.php');
				</script>";
			}
			
	}
	
?>