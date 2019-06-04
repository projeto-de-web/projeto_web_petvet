<?php
session_start();

include($pontos."barra.php");
include($pontos."conexao.php");

function Convert_Data_Ingl_Port2($entradata){
    $conv1 = explode("-",$entradata);
    $conv2 = array_reverse($conv1);
    $saidata = implode("/",$conv2);
    return $saidata;
}

$h1 = getdate();

$data_atual_2 = $hoje1 = $h1['mday']."/".$mes1 = $h1['mon']."/".$ano1 = $h1['year'];

// DISPARA BACKUP PELO EMAIL / 1X DIA
// BACKUP PET LIVRE

// This code was created by phpMyBackupPro v.2.1 
// http://www.phpMyBackupPro.net
$_POST['db']=array("maypet_petlivre", );
$_POST['tables']="on";
$_POST['data']="on";
$_POST['drop']="on";
$_POST['zip']="zip";
$period=(3600*24)*1;
$security_key="a19760a5a3385a407f76082c1f418f4c";
// This is the relative path to the phpMyBackupPro v.2.1 directory
@chdir("../phpmybackuppro/");
@include("backup.php");


// BACKUP MAYPET_LOJA / 1X M�S

// This code was created by phpMyBackupPro v.2.1
// http://www.phpMyBackupPro.net
$_POST['db']=array("maypet_loja", );
$_POST['tables']="on";
$_POST['data']="on";
$_POST['drop']="on";
$_POST['zip']="zip";
$period=(3600*24)*30;
$security_key="a19760a5a3385a407f76082c1f418f4c";
// This is the relative path to the phpMyBackupPro v.2.1 directory
@chdir("../phpmybackuppro/");
@include("backup.php");

// DISPARA EMAIL COM DADOS DE DEP�SITO DE CART�OS D�BITO E CR�DITO
if ($_SESSION["envia_email"] == 0){

// VERIFICA CART�O DE CR�DITO
$sql_cartao1 = mysqli_query($connection, "SELECT * FROM tab_cartao WHERE ref_cartao <4 && enviado_email = 0 && TO_DAYS(NOW()) - 30 = TO_DAYS(data_venda)") or die ("Erro na consulta: sql_cartao");

while ($linha1 = mysqli_fetch_array($sql_cartao1)){

	$ref_cartao_db = $linha1['ref_cartao'];
	$cartao_db = $linha1['cartao'];	
	$data1 = $linha1['data_venda'];
	$valor_db = $linha1['valor'];
	$data_venda_db = Convert_Data_Ingl_Port2($data1);
	
	
	//equivale ao desconto 
	$tx_credito = 3.5 / 100;
	
	//Aqui � atribuido � vari�vel $valor_descontado o resultado do $valor vezes o $desconto
	
	switch ($ref_cartao_db){
	
	case 2 : $valor_descontado = $valor_db * $tx_credito; break;
	case 3 : $valor_descontado = $valor_db * $tx_credito; break;		
	
	}// end switch	
	
	//Aqui � atribuido � vari�vel $valor_final o resultado da diferen�a entre o $valor e o 		$valor_descontado
	$valor_final = $valor_db - $valor_descontado;

	
	// DADOS DO EMAIL
	
	$assunto = "Maypet - Cr�dito em Conta Corrente";
	
	// Cabe�alho do E-Mail
	$headers = "From: PetLivre <maypet@maypet.com.br>\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$mensagem = "<html>\n";
	$mensagem .= "<font face=verdana size=2>";
	$mensagem .= "<br>Tipo de Cart�o: <b>$cartao_db</b><br>\n";
	$mensagem .= "<br>Data da Venda: <b>$data_venda_db</b><br>\n";
	$mensagem .= "<br>Valor da Venda: <b>".number_format($valor_db, 2, ',','.')."</b><br>\n";	
	$mensagem .= "<br>Data do cr�dito: <b>$data_atual_2</b><br>\n";
	$mensagem .= "<br>Valor do cr�dito: <b>".number_format($valor_final, 2, ',','.')."</b><br>\n";	
	$mensagem .= "</fonte></html>\n";

	mail("celostad@bol.com.br", $assunto, $mensagem, $headers);
	
	unset($cartao_db);
	unset($data1);	
	unset($data_venda_db);

	
	
} // end while ($linha1...

unset($sql_cartao);
unset($sql_cartao1);

$sql_cartao2 = mysqli_query($connection, "UPDATE `tab_cartao` SET  enviado_email=1 WHERE ref_cartao <4 && enviado_email = 0 && TO_DAYS(NOW()) - 30 = TO_DAYS(data_venda)") or die ("Erro na consulta: sql_cartao");




// VERIFICA CART�O DE D�BITO
$sql_cartao1 = mysqli_query($connection, "SELECT * FROM tab_cartao WHERE ref_cartao >3 && enviado_email = 0 && TO_DAYS(NOW()) - 3 = TO_DAYS(data_venda)") or die ("Erro na consulta: sql_cartao1");

while ($linha1 = mysqli_fetch_array($sql_cartao1)){

	$ref_cartao_db = $linha1['ref_cartao'];
	$cartao_db = $linha1['cartao'];	
	$data1 = $linha1['data_venda'];
	$valor_db = $linha1['valor'];
	$data_venda_db = Convert_Data_Ingl_Port2($data1);
	
	
	//equivale ao desconto 
	$tx_debito = 2.5 / 100;
	
	//Aqui � atribuido � vari�vel $valor_descontado o resultado do $valor vezes o $desconto
	
	switch ($ref_cartao_db){
	
	case 4 : $valor_descontado = $valor_db * $tx_debito; break;
	case 5 : $valor_descontado = $valor_db * $tx_debito; break;		
	
	}// end switch	
	
	//Aqui � atribuido � vari�vel $valor_final o resultado da diferen�a entre o $valor e o 		$valor_descontado
	$valor_final = $valor_db - $valor_descontado;

	
	// DADOS DO EMAIL
	
	$assunto = "Maypet - D�bito em Conta Corrente";
	
	// Cabe�alho do E-Mail
	$headers = "From: PetLivre <maypet@maypet.com.br>\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$mensagem = "<html>\n";
	$mensagem .= "<font face=verdana size=2>";
	$mensagem .= "<br>Tipo de Cart�o: <b>$cartao_db</b><br>\n";
	$mensagem .= "<br>Data da Venda: <b>$data_venda_db</b><br>\n";
	$mensagem .= "<br>Valor da Venda: <b>".number_format($valor_db, 2, ',','.')."</b><br>\n";	
	$mensagem .= "<br>Data do cr�dito: <b>$data_atual_2</b><br>\n";
	$mensagem .= "<br>Valor do cr�dito: <b>".number_format($valor_final, 2, ',','.')."</b><br>\n";	
	$mensagem .= "</fonte></html>\n";

	mail("celostad@bol.com.br", $assunto, $mensagem, $headers);
	
	unset($cartao_db);
	unset($data1);	
	unset($data_venda_db);

	
	
} // end while ($linha1...




$sql_cartao3 = mysqli_query($connection, "UPDATE `tab_cartao` SET  enviado_email=1 WHERE ref_cartao >3 && enviado_email = 0 && TO_DAYS(NOW()) - 3 = TO_DAYS(data_venda)") or die ("Erro na consulta: sql_cartao");





$_SESSION["envia_email"] = 1;
}// end if ($_SESSION["envia_email"]....

?>
