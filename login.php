<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

session_start();

include("conexao.php");
include("include/func_data.php");

$login = $_POST['login'];
$senha_postada = $_POST['senha'];


$sql = mysqli_query($connection, "SELECT * FROM acesso WHERE login='$login' AND senha=md5('$senha_postada')") or die("erro ao selecionar ");

if( $linha = mysqli_fetch_array($sql)) {
 
  $cod = $linha['codigo'];
  $nome = $linha['nome'];
  $login = $linha['login'];
  $senha = $linha['senha'];
  $nivel = $linha['nivel'];
  $url_db = $linha['pag_inicial'];

  $_SESSION["sessao_login"] = $login;
  $_SESSION["sessao_cod"] = $cod;
  $_SESSION["sessao_nivel"] = $nivel;
  $_SESSION["envia_email"] = 0;


$h_H=date("H");
$h_H = $h_H+1;

if ($h_H == 25){$h_H = 01;}

$date1 =date("$h_H:i");



if(date("w") ==0){

// VERIFICA SE USUARIO TEM PERMISS�O DE ACESSO AOS DOMINGOS
//$sql_config_dias = mysqli_query("SELECT login_dia_semana FROM tab_config_user WHERE id_user='$cod'") or die("erro ao selecionar: tab_config_user");

	if($linha_config_dias = mysqli_fetch_array($sql_config_dias)){

	$login_dia_semana_db = $linha_config_dias['login_dia_semana'];
	}


if(empty($login_dia_semana_db)){

echo '<script>
alert ("                             Aten��o !\n\nAcesso n�o autorizado!\n\nContate o administrador do sistema.\n\n") 
window.location = "negado.php";

</script>';

}
}
header("Location: $url_db");


}else {
 header("Location: negado.php");
} 


?>