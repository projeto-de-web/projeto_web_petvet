<?php
session_start();

include("../../../include/arruma_link.php");
include($pontos."barra.php");
include($pontos."conexao.php");

$checa_retorno = $_SESSION["checa_retorno"];
$rad_sel_visl = $_SESSION["rad_sel_visl"];
$retorno = $_SESSION["retorno"];

//pagina��o
$total_reg = "10"; 

$pagina = $_GET["pagina"];

if(!$pagina) {
$pc = "1";
} else {
$pc = $pagina;
}

$numero_links = "8";
// intevalo revebe o valor da variavel numero_links
$intervalo = $numero_links;
// inicio recebe pc - 1 para montamos o sql
$inicio = $pc-1;
$inicio = $inicio*$total_reg;
// fazemos a conex�o

?>
<html>
<head>
<script type="text/javascript" src="<?=$pontos;?>js/func_caixa.js"></script>
</head>
<title>Pet Livre  (Cadastro de materials) </title>

<?
echo "<body bgcolor='#FFFFFF' onUnload='javascript:this.opener.location=\"../saida_caixa.php\";
window.setInterval(\"self.close();window.opener.focus();\",1000);'>";


?>
<table width="430" height="174" border="0" align="center" cellpadding="1" cellspacing="1">
  
  <tr> 
    <td width="468" height="172" align="center"> 
      <form name="frmAjax"  method="post">
        <div align="center"> 
          <table width="350" height="164" border="0" align="center" cellpadding="1" cellspacing="1">
            <tr> 
              <td width="535" height="168" colspan="4" valign="middle"><table width="430" border="1" cellpadding="1" cellspacing="1">
                <tr>
                  <td height="30" colspan="4" bordercolor="#CC0000" bgcolor="#CC0000"><div align="center"><strong><font color="#FFFFFF">Material</font></strong></div></td>
                </tr>
                <tr>
                  <td height="50" colspan="4"><div align="center">
                    <table width="430" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="215"><strong><em><b><font size="2" face="Times New Roman, Times, serif">Material</font></b><font face="Times New Roman, Times, serif"><b><font size="2">:</font></b></font>
                                <input name="txt_material" type="text" id="txt_material" style="visibility:visible" size="20" maxlength="25">
                        </em></strong></td>
                        <td width="215"><strong><em><b><font size="2" face="Times New Roman, Times, serif">Categoria:</font></b>
                                <?
$sql_2 = mysqli_query($connection, "select codigo, categoria_mat from combo_categoria ORDER BY categoria_mat ASC") or print("Erro ao ler a tabela:
".mysqli_error($connection));
echo "<select name='sel_categoria' tabindex='1' id='sel_categoria'>";
echo "<option>"."</option>";
while($pega = mysqli_fetch_array($sql_2)){
echo "<option value='".$pega['categoria_mat']."'>".$pega['categoria_mat']."</option>";
}
echo "</select>";

@mysql_close($sql_2);
?>
&nbsp;<a href="javascript:gravar_material();"><img src="<?=$pontos;?>imagens/cad_clie/gravar.gif" width="31" height="37" border="0" align="absmiddle" alt="Gravar" title="Gravar"></a></em></strong></td>
                      </tr>
                    </table>
                    </div></td>
                </tr>
                <tr>
                  <td width="50" bgcolor="#CCCCCC"><div align="center"><font color="#000000"><b><font size="2">C�digo</font></b></font></div></td>
                  <td width="263" bgcolor="#CCCCCC"><div align="center"><font color="#000000"><b><font size="2">Materiais
                             cadastrados</font></b></font></div></td>
                  <td width="263" bgcolor="#CCCCCC"><div align="center"><font size="2" color="#000000"><b>Categoria
                             </b></font></div></td>
                  <td width="109"><div align="center"><font size="2" color="#000000">
                      <input type="button" name="btn_alterar" value="Alterar" onClick="javascript:alterar_material();">
                  </font></div></td>
                </tr>
     
                  <?
				  
 // Faz o Select pegando o registro inicial at&eacute; a quantidade de registros para p&aacute;gina
    $sql_registros = mysqli_query($connection, "SELECT * FROM tab_material ORDER BY material ASC LIMIT $inicio, $total_reg");

// Serve para contar quantos registros voc&ecirc; tem na seua tabela para fazer a pagina&ccedil;&atilde;o
    $sql_conta = mysqli_query($connection, "SELECT * FROM tab_material");
    
    $quantreg = mysqli_num_rows($sql_conta); // Quantidade de registros pra pagina&ccedil;&atilde;o
    
 $tp = ceil($quantreg/$total_reg);    
   
$cor="#FFFFFF";
while($linha_ref = mysqli_fetch_array($sql_registros)) {
				  
$codigo = $linha_ref['codigo'];
$material = $linha_ref['material'];
$categoria = $linha_ref['categoria'];

$cor=($cor=="#E6E6E6") ? "#FFFFFF": "#E6E6E6"; 

?>
           <tr bgcolor="<?=($cor=="#E6E6E6") ? "#FFFFFF": "#E6E6E6"; 
?>" class="info" onMouseOver="this.style.backgroundColor='#66FF66'" onMouseOut="this.style.backgroundColor='<?=($cor=="#FFFFFF") ? "#E6E6E6": "#FFFFFF"; 
?>'">
                  <td width="50"><div align="center">&nbsp; <?php echo $codigo; ?> </div></td>
                  <td width="263"><div align="center">&nbsp; <?php echo $material; ?> </div></td>
                  <td width="263"><div align="center">&nbsp; <?php echo $categoria; ?> </div></td>
                  <td width="109"><div align="center">
                      <input type="radio" name="rad_sel" value="<?php echo $codigo; ?>">
                  </div></td>
                </tr>
                <?
}


 @mysql_close($sql);

?>
                <tr>
                  <td colspan="3"><div align="center">
                    <?php // Chama o arquivo que monta a pagina&ccedil;&atilde;o
if ($quantreg >5){include("paginacao.php");}
?>
</div>                    </td>
                  <td width="109"><div align="center"><font size="2">
                      <input type="button" name="btn_excluir" value="Excluir" onClick="javascript:excluir_material();">
                  </font></div></td>
                </tr>
              </table></td>
            </tr>
          </table>
        </div>
      </form>    </td>
  </tr>
</table>
</body>
</html>