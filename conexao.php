
<?php

$host = "127.0.0.1"; //endereco do seu servidor MySQL
$database = "PetLivre"; //preencha com o nome do BD que contem a tabela que criamos
$login_db = "web"; //login usado para acessar seu BD
$senha_db = ""; //senha usada para acessar seu BD

// nao altere mais nada abixo desta linha

$connection = mysqli_connect($host, $login_db, $senha_db, $database) 
    or die ("Nao foi possivel conectar ao servidor.");
    
//$db = mysqli_select_db($database, $host)
   //or die("Nao foi possivel selecionar o banco de dados.");
//$conexao = mysqli_connect($host, $login_db, $senha_db, $database) or die("não conectou"); 

?>
