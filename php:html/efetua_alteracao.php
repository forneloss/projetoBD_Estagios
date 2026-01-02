<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title>BD Loja - Alterar</title>
</head>
<body bgcolor="#FFFFFF">

<?php
require('bd.php');
$estagios = new Estagios;
$estagios->Estagios();
$estagios->alterarEstagio(
    $_POST["empresa"], 
    $_POST["estabelecimento"],
    $_POST["aluno"], 
    $_POST["formador"], 
    $_POST["data_inicio"], 
);
$estagios->fecharBDEstagios();
?>
<br>
<p>Alteração efetuada com sucesso!</p>
<br>
<br>
<a href="listar_estagio.php">voltar</a> | <a href="menu_administrador.html">voltar ao menu</a>
</body>
</html>