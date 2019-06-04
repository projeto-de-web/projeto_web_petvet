
//<?php

$host = 'localhost'; //endereco do seu servidor MySQL
$database = 'PetLivre'; //preencha com o nome do BD que contem a tabela que criamos
$login_db = 'root'; //login usado para acessar seu BD
$senha_db = 'devolper'; //senha usada para acessar seu BD

// nao altere mais nada abixo desta linha

$connection = mysql_connect("localhot","root","devolper") 
    or die ("Nao foi possivel conectar ao servidor.");
    
$db = mysql_select_db("PetLivre", 'localhost')
   or die("Nao foi possivel selecionar o banco de dados.");

//define('HOST','localhost');
//define('Usuario', 'root');
//define('senha', 'devolper');
//define('DB', 'PetLivre');

//$connection = mysqli_connect(HOST, Usuario, senha, DB) or die("Não foi possivel conectar");
//$db = mysql_select_db("$database", $connection);
?> 
