<?php
session_start();

include("../../include/arruma_link.php");
require($pontos."barra.php");
include($pontos."conexao.php");
include($pontos."include/func_data.php");

$usuario = $_SESSION["sessao_login"];
$nivel = $_SESSION["sessao_nivel"];
$checa_retorno = $_SESSION["checa_retorno"];

if ($nivel ==1){$nivel_conv="Usu�rio";}
if ($nivel ==2){$nivel_conv="Gerente";}
if ($nivel ==3){$nivel_conv="Administrador";}

// APAGA OS DADOS DAS VARI�VEIS

$_SESSION["rad_sel_visl"] ="";
$_SESSION["rad_animal_clie"] ="";
$_SESSION["checa_retorno"] ="";
$_SESSION["rad_clie"] ="";
$_SESSION["retorno"] ="";

//APAGA DADOS TAB_TEMP_CAIXA
$sql_apaga_temp_banho = mysqli_query($connection, "SELECT * FROM `tab_temp_banho` WHERE user_cadastro='$usuario'") or die("<b>Sql:</b> sql_apaga_temp_banho<br><b>Tabela:</b>  tab_temp_banho<br><b>Erro:</b> ".mysqli_error($connection));

if ($linha_apaga_temp_banho = mysqli_fetch_array($sql_apaga_temp_banho)) {
//APAGA DADOS TEMPORARIOS TABELA CLIENTE
$sql1 = "DELETE FROM `tab_temp_banho` WHERE `user_cadastro` = '$usuario'";
$resultado1 = mysql_query($sql1) or die ("<b>Sql:</b> sql1<br><b>Tabela:</b>  tab_temp_banho<br><b>Erro:</b> ".mysqli_error($connection));
}

?>
<html>
<head>
<title>PetLivre - Sistema para Gerenciamento de Petshop  </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="<?=$pontos;?>css/config.css" type="text/css">
</head>
<body>
  <table width="740" height="420" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td height="102" colspan="2" valign="top"><?php include($pontos."include/titulo_cima.php"); ?></td>
    </tr>
    <tr>
      <td width="150" height="280" valign="top"><?php include ($pontos."include/menu.php"); ?></td>
      <td width="589"  valign="top"><?php include("lista_banho.php");
 ?></td>
    </tr>
    <tr>
    <td height="20" colspan="2" valign="top"><div align="center">
      <?php include ($pontos."include/rodape.php"); ?>
    </div></td>
    </tr>
</table>
</body>
</html>
