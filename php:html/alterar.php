<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>BD Loja - Alterar</title>
</head>
<?php
require('bd.php');
$estagios = new Estagios;
$estagios->Estagios();
?>
<body bgcolor="#FFFFFF">
<p><h3>Alterar um produto:</h3></p>
<form method="post" action="efetua_alteracao.php">
  <label for="empresa">Empresa ID:</label>
  <input type=text name="empresa" value=<?php echo $_POST["empresa"]; ?>>
  <br/><br/>
  <label for="estabelecimento">Estabelecimento ID:</label>
  <input type=text name="estabelecimento" value=<?php echo $_POST["estabelecimento"]; ?>>
  <br/><br/>
  <label for="aluno">Aluno ID:</label>
  <input type=text name="aluno" value=<?php echo $_POST["aluno"]; ?>>
  <br/><br/>
  <label for="formador">Formador ID:</label>
  <input type=text name="formador" value=<?php echo $estagios->devolveCampo($_POST["empresa"], $_POST["estabelecimento"], $_POST["aluno"], "formador_id"); ?>>
  <br/><br/>
  <label for="data_inicio">Data Inicio:</label>
  <input type=text name="data_inicio" value=<?php echo $estagios->devolveCampo($_POST["empresa"], $_POST["estabelecimento"], $_POST["aluno"], "data_inicio"); ?>>
  <br/><br/>

  <?php $estagios->fecharBDEstagios(); ?>

  <input type="submit" name="Submit" value="Alterar">
	<input type="reset" name="Submit2" value="Limpar">
</form>
</body>
</html>