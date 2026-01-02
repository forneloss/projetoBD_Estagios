<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Apagar</title></head>
<body background=#ffffff>
<p><h3>Apagar estágios</h3></p>
<?php
require('bd.php');
$estagios = new Estagios;
$estagios->Estagios();
$estagios->apagarEstagio($_POST["empresa"], $_POST["estabelecimento"], $_POST["aluno"]);
$estagios->fecharBDEstagios();
?>
<br>
<a href="listar_estagio.php">voltar</a> | <a href="menu_administrador.html">voltar ao menu</a>
</body>
</html>