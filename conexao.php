<?php
# Informa qual o conjunto de caracteres será usado.
header('Content-Type: text/html; charset=utf-8');

# Conecta ao banco de dados
// or die - Equivalente/abreviatura a exit() || imprime uma mensagem e sai do script atual
$link = mysqli_connect('example.com:3307', 'mysql_user', 'mysql_password');
$conectar = mysqli_connect("q7cxv1zwcdlw7699.chr7pe7iynqr.eu-west-1.rds.amazonaws.com:3307","g555luqjip1sjv1a","ly2zjwy3gtwut8b4") or die ("Erro na conexão");
mysqli_select_db("sff7jou3nc27mma2")or die ("Base de dados não encontrada");

# Codificacao 
mysqli_query("SET NAMES 'utf8'");
mysqli_query('SET character_set_connection=utf8');
mysqli_query('SET character_set_client=utf8');
mysqli_query('SET character_set_results=utf8');

?>
