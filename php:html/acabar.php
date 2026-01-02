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
<p><h3>Acabar o estágio:</h3></p>
<form method="post" action="acaba_estagio.php">
  <label for="nota_empresa">nota_empresa:</label>
  <input type=text name="nota_empresa" value=<?php echo $estagios->devolveCampo($_POST["empresa"], $_POST["estabelecimento"], $_POST["aluno"], "nota_empresa"); ?>>
  <br/><br/>
  <label for="nota_escola">nota_escola:</label>
  <input type=text name="nota_escola" value=<?php echo $estagios->devolveCampo($_POST["empresa"], $_POST["estabelecimento"], $_POST["aluno"], "nota_escola"); ?>>
  <br/><br/>
  <label for="nota_relatorio">nota_relatorio:</label>
  <input type=text name="nota_relatorio" value=<?php echo $estagios->devolveCampo($_POST["empresa"], $_POST["estabelecimento"], $_POST["aluno"], "nota_relatorio"); ?>>
  <br/><br/>
  <label for="nota_procura">nota_procura:</label>
  <input type=text name="nota_procura" value=<?php echo $estagios->devolveCampo($_POST["empresa"], $_POST["estabelecimento"], $_POST["aluno"], "nota_procura"); ?>>
  <br/><br/>

  <?php 
    $estagios->fecharBDEstagios(); 
  ?>

        <input type='hidden' name='empresa' value=<?php echo $_POST["empresa"]?>>
        <input type='hidden' name='estabelecimento' value=<?php echo $_POST["estabelecimento"]?>>
        <input type='hidden' name='aluno' value=<?php echo $_POST["aluno"]?>>
  <input type="submit" name="Submit" value="Alterar">
<input type="reset" name="Submit2" value="Limpar">
</form>
</body>
</html>