<?php
session_start();

include("../../../include/arruma_link.php");
include($pontos."barra.php");
include($pontos."conexao.php");

$usuario = $_SESSION["sessao_login"];
$nivel = $_SESSION["sessao_nivel"];

if ($nivel ==1){$nivel_conv="Usu�rio";}
if ($nivel ==2){$nivel_conv="Gerente";}
if ($nivel ==3){$nivel_conv="Administrador";}


include ("form_cad_banho.php");
?>
