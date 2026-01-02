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

<?php
require("bd.php");
$empresas = new Empresas;
$empresas->Empresas();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $empresas->listarEmpresas($_POST["localidade"], $_POST["ramo"]);
}
$empresas->fecharBDEmpresas();
?>

</center>
</body>
</html>
