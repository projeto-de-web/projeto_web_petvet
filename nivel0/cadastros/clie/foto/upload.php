<?php
session_start();

include("../../../../include/arruma_link.php");
include($pontos."conexao.php");
include($pontos."include/mostra_erros.php");


/*
 ******************************************************************************
 **                                                                          **
 **               MARCELO DE SOUZA TADIM                WebMaster            **
 **                                                                          **
 **                                                                          **
 **                                                                          **
 **                      Data de cria��o:  Dez 2007                          **
 **										                                     **
 ******************************************************************************
*/

$usuario = $_SESSION["sessao_login"];
$checa_retorno = $_SESSION["checa_retorno"];
$rad_sel_visl = $_SESSION["rad_sel_visl"];

//  PARTE DA FOTO  


// *********************    APAGA PRIMEIRO A FOTO ANTERIOR  ***************************


$sql_excl = mysqli_query($connection, "SELECT * FROM `tab_temp_clie` WHERE user_cadastro='$usuario'") or die("Erro ao selecionar   -   Selecionar User_cadastro inicial  SQL");

if ($linha_excl = mysqli_fetch_array($sql_excl)){
$txt_caminho_foto = $linha_excl['caminho_foto'];
}

if(isset($txt_caminho_foto)){unlink("$txt_caminho_foto");}
//if ($txt_caminho_foto<>""){unlink("$txt_caminho_foto");}

// *********************    FINAL DA INSTRU��O ************************************

$config = 262144; //tamanho m�ximo

// sem imagens

if ( !isset($_FILES['balizador']['name']) || empty($_FILES['balizador']['name']) )

{ $name = "sem_imagem.gif";}

else { //abre else

// verifica tamanho
if (filesize($_FILES['balizador']['tmp_name']) > $config )
{ $erro[] = "Erro[Enviar imagem]: O Tamanho m�ximo do arquivo de imagem deve ser de 256 Kb."; }
// verifica tipo
if (substr($_FILES['balizador']['type'],-3) !="jpg" && substr($_FILES['balizador']['type'],-3) !="gif"&& substr($_FILES['balizador']['type'],-3) !="JPG" && substr($_FILES['balizador']['type'],-3) !="GIF"&& substr($_FILES['balizador']['type'],-4) !="jpeg" && substr($_FILES['balizador']['type'],-4) !="JPEG")
{ $erro[] = "Erro[Enviar imagem]: S� s�o permitidos arquivos de imagem do tipo JPG, JPEG."; }
// validando foto
//if (ereg("[][><}{)(:;,!?*%&#@]", $_FILES['balizador']['name']))
if (preg_match("/[][><}{)(:;,!?*%&#@]/", $_FILES['balizador']['name']))

{ $erro[] = "Erro[Enviar imagem]: O arquivo cont�m caracteres inv�lidos."; }

if(isset($erro))
{ echo "<ul>";
for($i=0;$i<count($erro);$i++) { echo "<li>".$erro[$i]."</li>"; }
echo("<a href=javascript:history.go(-1)><br><br>voltar</a>");
echo "</ul>";
mysqli_close();
exit; }

else { $imagemenviada = "1";

//envia o arquivo modificando
$dir_path="uploads/";//Grava na foto 
$dir_mov="uploads/backup/";//caminho para onde vai as imagens 
$num = time();
$file=$_FILES['balizador']['name'];
$f =explode (".", $file);
$ext = end ($f);
$h = getdate(); //variavel recebe a data
$data_foto = $hoje = $h['mday']."_".$mes = $h['mon']."_".$ano = $h['year'];

$name=$dir_mov.$num."_".$data_foto.".".$ext;
$caminho = $dir_mov.$num."_".$data_foto.".".$ext;

if(move_uploaded_file($_FILES['balizador']['tmp_name'],$name))
{
list($largura,$altura,$tipo)=getimagesize($name);
//$imagem = $caminho1;
//echo $largura.$altura.$tipo;
}

//$up=move_uploaded_file($_FILES['balizador']['tmp_name'], $name);

}

} //fecha else

$sql_1 = mysqli_query($connection, "SELECT * FROM `tab_temp_clie` WHERE user_cadastro='$usuario'") or die("erro ao selecionar1 - TELA UPLOAD");

if ($linha = mysqli_fetch_array($sql_1)){

$sql_2 = mysqli_query($connection, "UPDATE `tab_temp_clie` SET caminho_foto ='$caminho' WHERE user_cadastro='$usuario'") or die (mysqli_error($connection));

}else{

$sql_3 = mysqli_query($connection, "INSERT INTO `tab_temp_clie` (`caminho_foto`, `user_cadastro`)VALUES('$caminho', '$usuario')") or die (mysqli_error($connection));

}

/*
window.opener.location ="../checagem/grava_variaveis_bd.php";

window.opener.document.form.action="checagem/grava_variaveis_bd.php";
window.opener.document.form.target="_self";
window.opener.document.form.submit();
window.opener.document.form.action="checagem/grava_variaveis_bd.php";
window.opener.location = "../cad_clie.php";
window.opener.document.form.submit();
//header("Location: ../checagem/grava_variaveis_bd.php");
*/

echo'
<script>

window.opener.document.forms[0].action="checagem/grava_variaveis_bd.php";
window.opener.document.forms[0].target="_self";
window.opener.document.forms[0].submit();
self.close();
</script>';
?>