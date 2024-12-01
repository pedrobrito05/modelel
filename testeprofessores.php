<?php
session_start();
include_once "config.php";

// Selecionando usuários onde o valor da coluna 'coluna_desejada' é igual a "professor"
//$resultado = mysqli_query($conn, "SELECT * FROM users WHERE cargo = 'Professor'");

// Iniciando loop while
$resultado = mysqli_query($conn, "SELECT COUNT(*) FROM users WHERE cargo = 'Professor'");
$num_linhas = mysqli_fetch_array($resultado)[0];
// Fechando a conexão com o banco de dados
echo $num_linhas
?>