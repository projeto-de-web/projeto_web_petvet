<?php
session_start();

include("../../../include/arruma_link.php");
include($pontos."barra.php");
include($pontos."conexao.php");

/*
 ******************************************************************************
 **                                                                          **
 **                                                                          **
 **          MARCELO DE SOUZA TADIM           -         WebMaster            **
 **                                                                          **
 **                                                                          **
 **                                                                          **
 **                      Data de cria��o:  Dez 2007                          **
 **										                                     **
 ******************************************************************************
*/

$txt_rad_sel = $_POST["rad_sel"];



$sql = "DELETE FROM `tab_produto` WHERE `codigo` = '$txt_rad_sel'";
$resultado = mysqli_query($connection,$sql) or die ("Problema na Consulta");



header("Location: cad_produto.php");    


?>