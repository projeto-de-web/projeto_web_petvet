<?
session_start();

require_once("../../../../conexao.php");

$usuario = $_SESSION["sessao_login"];
$checa_retorno = $_SESSION["checa_retorno"];

// VARI�VEIS POSTADAS 
$txt_nome_clie = $_POST["txt_nome_clie"];
$sel_sexo = $_POST["sel_sexo"];
$txt_end_clie = $_POST["txt_end_clie"];
$txt_cep_clie = $_POST["txt_cep_clie"];
$txt_bairro_clie = $_POST["txt_bairro_clie"];
$txt_cidade_clie = $_POST["txt_cidade_clie"];
$txt_uf = $_POST["txt_uf"];
$txt_ddd_tel_clie = $_POST["txt_ddd_tel_clie"];
$txt_tel_clie = $_POST["txt_tel_clie"];
$txt_ddd_cel_clie = $_POST["txt_ddd_cel_clie"];
$txt_cel_clie = $_POST["txt_cel_clie"];
$txt_rg_clie = $_POST["txt_rg_clie"];
$txt_data_nasc_clie = $_POST["txt_data_nasc_clie"];
$txt_obs_clie = $_POST["txt_obs_clie"];
$dados_check_clie=0;



include("checa_cad_temp.php");


if ($txt_nome_clie =="" or $txt_nome_clie ==" "){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (NOME).\n\n");</script>';
echo '<script>window.location = "../cad_clie_banho.php";</script>';}

if ($txt_end_clie =="" or $txt_end_clie ==" "){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (ENDERE�O).\n\n");</script>';
echo '<script>window.location = "../cad_clie_banho.php";</script>';}

if ($txt_bairro_clie =="" or $txt_bairro_clie ==" "){echo '<script>alert("                   Aten��o!\n\n� necess�rio selecionar o campo (BAIRRO).\n\n");</script>';
echo '<script>window.location = "../cad_clie_banho.php";</script>';}

if ($txt_cidade_clie =="" or $txt_cidade_clie ==" "){echo '<script>alert("                   Aten��o!\n\n� necess�rio selecionar o campo (CIDADE).\n\n");</script>';
echo '<script>window.location = "../cad_clie_banho.php";</script>';}

if (($txt_tel_clie =="" or $txt_tel_clie ==" ") and ($txt_cel_clie =="" or $txt_cel_clie ==" ")){echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher pelo menos 01(um) dos Telefones.\n\n");</script>';
echo '<script>window.location = "../cad_clie_banho.php";</script>';}

if ($txt_tel_clie <>""){
if ($txt_ddd_tel_clie =="" or $txt_ddd_tel_clie ==" "){
echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (DDD-TEL).\n\n");</script>';
echo '<script>window.location = "../cad_clie_banho.php";</script>';}

if (strlen($txt_tel_clie) < 9){
echo '<script>alert("                   Aten��o!\n\nO Telefone inserido � invalido ou tem poucos caracteres.\n\n");</script>';
echo '<script>window.location = "../cad_clie_banho.php";</script>';}
}

if ($txt_cel_clie <>""){
if ($txt_ddd_cel_clie =="" or $txt_ddd_cel_clie ==" "){
echo '<script>alert("                   Aten��o!\n\n� necess�rio preencher o campo (DDD-CEL).\n\n");</script>';
echo '<script>window.location = "../cad_clie_banho.php";</script>';}

if (strlen($txt_cel_clie) < 9){
echo '<script>alert("                   Aten��o!\n\nO Telefone inserido � invalido ou tem poucos caracteres.\n\n");</script>';
echo '<script>window.location = "../cad_clie_banho.php";</script>';}
}

header ("location: cadastro_clie_sucesso.php");

?>