<html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head><title>Introduzir</title>
</head>
<body background=#ffffff>
<?php
require('bd.php');

$estagios = new Estagios;
$estagios->Estagios();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $estagios->novoEstagio(
        $_POST["estabelecimento"],
        $_POST["empresa"],
        $_POST["datainicio"],
        $_POST["aluno"],
        $_POST["formador"]
    );
}
$estagios->fecharBDEstagios();
?>
<br>
<a href="menu_administrador.html">voltar ao menu</a>
</body>
</html>