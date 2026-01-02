<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>Listar estagios</title></head>
<body background=#ffffff>
<p><h3>Listagem de estagios</h3></p>
<?php
require('bd.php');

$estagios = new Estagios;
$estagios->Estagios();
$estagios->listarEstagios();
$estagios->fecharBDEstagios();
?>
<br>
<a href="menu_administrador.html">voltar ao menu</a>
</body>
</html>