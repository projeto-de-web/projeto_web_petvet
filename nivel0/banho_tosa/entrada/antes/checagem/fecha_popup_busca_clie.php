<?
session_start();
$sel_tipo_pesq = $_POST["sel_tipo_pesq"];
$txt_descricao_pesq = $_POST["txt_descricao_pesq"];

$_SESSION["tipo_pesq"] = $sel_tipo_pesq;
$_SESSION["descricao_pesq"] = $txt_descricao_pesq;
?>
<script>
window.opener.location = "../resultado_busca_cad_clie.php";
window.opener.focus();
self.close();
</script>