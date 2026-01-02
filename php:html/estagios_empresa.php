<html>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<head>
<title>Aluno</title>
</head>
<body>

<?php
require("bd.php");
$estagios = new Empresas;
$estagios->Empresas();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $estagios->listarEstagiosDeEmpresa($_POST["empresa"]);
}

$estagios->fecharBDEmpresas();
?>
</body>
</html>
