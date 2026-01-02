<html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
<title>Aluno</title>
</head>
<body>
<center>
Portal Aluno
<br>
<br>

<form method="post" action="listar_empresas.php">
    <label for="localidade">Localidade:</label><br/>
    <input type="text" name="localidade" size="20" maxlength="20">
    <br>
    <label for="ramo">Ramo de atividade:</label><br/>
    <input type="text" name="ramo" size="40" maxlength="40">
    <br>
    <br>
    <input type="submit" name="Submit" value="Filtrar">
</form>
<br>

<?php
require("bd.php");
$empresas = new Empresas;
$empresas->Empresas();
$empresas->listarEmpresas("", "");
$empresas->fecharBDEmpresas();
?>

</center>
</body>
</html>
