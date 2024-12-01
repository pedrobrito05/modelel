<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
	<h1>Register</h1>
	<?php
		// Check if the user has submitted the registration form
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Get the user's input from the registration form
			$p_nome = $_POST["p_nome"];
			$u_nome = $_POST["u_nome"];
			$username = $_POST["username"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$telemovel = $_POST["telemovel"];
			$nome_empresa = $_POST["nome_empresa"];
			
			// Connect to the database
			
			
			
  
			$servername = "localhost";
			$dbusername = "clientes";
			$dbpassword = "PLfMF6pJcNpmG6kM*";
			$dbname = "clientes";
			$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
			
			// Check if the connection was successful
			if ($conn->connect_error) {
				die("NEPIA DRED: " . $conn->connect_error);
			}
			
			// Prepare and execute an INSERT statement to add the user to the database
			$insert_query = mysqli_query($conn,"INSERT INTO clientes (p_nome, u_nome, username, email, password, telemovel, nome_empresa) VALUES ('{$p_nome}','{$u_nome}','{$username}', '{$email}', '{$password}', '{$telemovel}', '{$nome_empresa}')");
			//$stmt->bind_param("ss", $p_nome, $u_nome, $username, $email, $password, $telemovel, $nome_empresa);
			//$stmt->execute();
			
			// Close the database connection
			$stmt->close();
			$conn->close();
			
			// Display a success message
			echo "Registration successful. Click <a href='login.php'>here</a> to login.";
		}
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="p_nome">primeiro nome:</label>
		<input type="text" id="p_nome" name="p_nome"><br><br>
		
		<label for="u_nome">ultimo nome:</label>
		<input type="text" id="u_nome" name="u_nome"><br><br>
		

		<label for="username">Username:</label>		
		<input type="text" id="username" name="username"><br><br>	
		
		<label for="email">email:</label>		
		<input type="text" id="email" name="email"><br><br>
		
		<label for="password">Password:</label>		
		<input type="password" id="password" name="password"><br><br>

		<label for="telemovel">telemovel:</label>		
		<input type="text" id="telemovel" name="telemovel"><br><br>
		
		<label for="nome_empresa">nome empresa:</label>		
		<input type="text" id="nome_emoresa" name="nome_empresa"><br><br>
		
		<input type="submit" value="Register">
	</form>
</body>
</html>