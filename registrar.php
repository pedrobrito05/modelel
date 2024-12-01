<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $usuario = 'login';
$senha = 'Benfica05';
$database = 'login';
$host = 'localhost';
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
//echo "password: " . $password;
//echo "email: " . $email;
$conn = mysqli_connect($host, $usuario, $senha, $database);
if(!$conn) {
	die("Falha ao conectar ao banco de dados: ");
}
if ($password==$password2){
	if(strlen($email)!=0 || strlen($password)!=0 || strlen($password2)!=0){
		$resultado = mysqli_query($conn, "SELECT COUNT(*) FROM usuarios WHERE email = '$email'");
		$registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
		$contagem=$registro['COUNT(*)'];
		if($contagem==0){
		$sql = "INSERT INTO usuarios (email, senha) VALUES ('$email', '$password')";
			if (mysqli_query($conn, $sql)) {
				echo "Dados inseridos com sucesso!";
			} else {
			echo "Erro ao inserir dados: " . mysqli_error($conn);
			}
	}else{
	echo "Este email já está a ser usado";
}
}else{
	echo "Todos os campos têm de estar preenchidos";
}
}else{
	echo "As duas passwords têm de coincidir";
}
mysqli_close($conn);



}
?>