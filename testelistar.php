<?php

 $usuario = 'login';
$senha = 'Benfica05';
$database = 'login';
$host = 'localhost';
$conn = mysqli_connect($host, $usuario, $senha, $database);


if(!$conn) {
	die("Falha ao conectar ao banco de dados: ");
}
$resultado = mysqli_query($conn, "SELECT * FROM usuarios");
if ($resultado === false) {
    die("Erro na consulta: " . mysqli_error($conn));
}
while ($linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
    echo "ID: " . $linha['id'] . ", Email: " . $linha['email'] . ", Password: " . $linha['senha'] . "<br>";
}

mysqli_close($conn);

?>