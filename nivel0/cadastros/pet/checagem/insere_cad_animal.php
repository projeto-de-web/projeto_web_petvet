<?php
session_start();

include("../../../../include/arruma_link.php");
include($pontos."include/mostra_erros.php");
require_once($pontos."conexao.php");
include("func_data.php");

$usuario = $_SESSION["sessao_login"];

// VARI�VEIS POSTADAS 
$txt_nome_pet = $_POST["txt_nome_pet"];
$txt_raca = $_POST["txt_raca"];
$txt_sexo = $_POST["txt_sexo"];
$txt_porte = $_POST["txt_porte"];
$txt_cor = $_POST["txt_cor"];
$txt_especie = $_POST["txt_especie"];
$txt_data_nasc = $_POST["txt_data_nasc"];
$txt_mensal = $_POST["txt_mensal"];
$txt_chip = $_POST["txt_chip"];
$txt_rga = $_POST["txt_rga"];
$txt_cod_dono = $_POST["txt_cod_dono"];
$txt_obs_pet = $_POST["txt_obs_pet"];


//var_dump($_POST);

// PEGA O NOME DO DONO
$sql_dono = mysqli_query($connection, "SELECT codigo,nome FROM `tab_clie` WHERE codigo='$txt_cod_dono'") or die("Erro ao selecionar   -   Selecionar User_cadastro inicial  SQL");
if ($linha_dono = mysqli_fetch_array($sql_dono)){$txt_nome_dono = $linha_dono['nome'];}
//---------------------------

if (empty($txt_cod_dono)){$txt_cod_dono = 0;}


if (empty($txt_data_nasc)){$txt_data_nasc = "00/00/0000";}


//$entrada vc mudar por exemplo: Convert_Data_Port_Ingl($_POST[data])
$txt_data_nasc = Convert_Data_Port_Ingl($txt_data_nasc);

$data_atual = Convert_Data_Port_Ingl($data_atual2);


$sql = mysqli_query($connection, "SELECT * FROM `tab_temp_pet` WHERE user_cadastro='$usuario'") or die("Erro ao selecionar   -   Selecionar User_cadastro inicial  SQL");

if ($linha = mysqli_fetch_array($sql)){

	//  *******************  ATUALIZA AS VARI�VEIS NO BD TEMP *****************************************

	$sql1 = mysqli_query($connection, "UPDATE `tab_temp_pet` SET nome='$txt_nome_pet', sexo='$txt_sexo', cor='$txt_cor', dono='$txt_nome_dono', cod_dono='$txt_cod_dono', data_nasc ='$txt_data_nasc', especie='$txt_especie', raca ='$txt_raca', porte ='$txt_porte',
	mensalista = '$txt_mensal', chip='$txt_chip', rga='$txt_rga', obs= '$txt_obs_pet', data_cadastro  ='$data_atual' WHERE user_cadastro='$usuario'") or die (mysqli_error($connection));

//  -------------------------------------------------------------------------------------------

}else{
//  *******************  INSERE AS VARI�VEIS NO BD TEMP *****************************************

	$sql2 = mysqli_query($connection, "INSERT INTO `tab_temp_pet` (`codigo`, `nome`, `sexo`,`cor`, `dono`, `cod_dono`, `data_nasc`, `especie`, `raca`, `porte`, `mensalista`, `chip`, `rga`, `obs`, `user_cadastro`, `data_cadastro`) VALUES (NULL, '$txt_nome_pet', '$txt_sexo', '$txt_cor',
	'$txt_nome_dono', '$txt_cod_dono', '$txt_data_nasc', '$txt_especie', '$txt_raca', '$txt_porte', '$txt_mensal', '$txt_chip', '$txt_rga', '$txt_obs_pet', '$usuario', '$data_atual')") or die (mysqli_error($connection));

//  -------------------------------------------------------------------------------------------
}

//var_dump($_POST);


if (empty($txt_nome_pet)){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (NOME).\n\n");</script>';
echo '<script>window.location = "../cad_pet.php";</script>';}

if (empty($txt_raca)){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (RA�A).\n\n");</script>';
echo '<script>window.location = "../cad_pet.php";</script>';}

if (empty($txt_sexo)){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (SEXO).\n\n");</script>';
echo '<script>window.location = "../cad_pet.php";</script>';}

if (empty($txt_porte)){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (PORTE).\n\n");</script>';
echo '<script>window.location = "../cad_pet.php";</script>';}

if (empty($txt_cor)){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (COR).\n\n");</script>';
echo '<script>window.location = "../cad_pet.php";</script>';}

if (empty($txt_nome_dono)){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (PROPRIET�RIO(A)).\n\n");</script>';
echo '<script>window.location = "../cad_pet.php";</script>';}

if (strlen($txt_data_nasc) < 10){
echo '<script>alert("                   Aten��o!\n\nA data de nascimento inserida � invalida ou tem poucos caracteres.\n\n");</script>';
echo '<script>window.location = "../cad_pet.php";</script>';}




header ("location: cadastro_pet_sucesso.php");

?>