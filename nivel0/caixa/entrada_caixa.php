<?php
session_start();

include("../../include/arruma_link.php");
include($pontos."barra.php");
include($pontos."conexao.php");
include("checagem/check_finaliza_caixa.php");

$usuario = $_SESSION["sessao_login"];
$nivel = $_SESSION["sessao_nivel"];

if ($nivel ==1){$nivel_conv="Usu�rio";}
if ($nivel ==2){$nivel_conv="Gerente";}
if ($nivel ==3){$nivel_conv="Administrador";}

include("checagem/variaveis_tab_temp_caixa.php");

if ($txt_cod_prod > 10 or empty($txt_cod_prod)) {
//$x = "display ='none';";
$x = "visibility:hidden";
unset($txt_pet);
}else{
$x = "visibility:visible";
}

$select = 2;
?>
<html>
<head>
<title>PetLivre - Sistema para Gerenciamento de Petshop  </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="<?=$pontos;?>css/config.css" type="text/css">
<script type="text/javascript" src="../../js/func_caixa.js"></script>
</head>
<body>
  <table width="740" height="671" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td height="102" colspan="2" valign="top"><?php include($pontos."include/titulo_cima.php"); ?></td>
    </tr>
    <tr>
      <td width="150" height="280" rowspan="2" valign="top"><?php include ($pontos."include/menu.php"); ?></td>
      <td width="589" height="20" valign="top"><div align="center">
	  <?php  include($pontos."include/menu_caixa.php"); ?>
        </div>
      </td>
    </tr>
    <tr>
      <td valign="top"><div align="center">
          <?php include("form_cad_caixa.php"); ?>
        </div></td>
    </tr>
    <tr>
    <td height="20" colspan="2" valign="top"><div align="center">
      <?php include ($pontos."include/rodape.php"); ?>
    </div></td>
    </tr>
</table>
</body>
</html>
