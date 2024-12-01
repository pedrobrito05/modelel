<?php
session_start();
include_once "config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: https://esa.ib6.pt");
  }
						
  $resultado = mysqli_query($conn, "SELECT * FROM users WHERE cargo = 'Professor'");
  
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if(mysqli_num_rows($sql) > 0){
$row = mysqli_fetch_assoc($sql);
	}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Register - HRMS admin template</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				
				<div class="container">
				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="index.php"><img src="assets/img/logo.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Registrar</h3>
							<p class="account-subtitle">Acesse o nosso painel</p>
							
							<!-- Account Form -->
							<form method="POST" enctype="multipart/form-data">
								
								<div class="form-group">
									
									<label>Email</label>
									<input class="form-control" type="email" name="email" id="email">
								</div>
								<div class="form-group">
									
									<label>Primeiro nome</label>
									<input class="form-control" type="fname" name="fname" id="fname">
								</div>
								<div class="form-group">
									
									<label>Ultimo nome</label>
									<input class="form-control" type="lname" name="lname" id="lname">
								</div>
                                <div class="form-group">
									
									<label>Sexo</label>
									<select name="sexo" class="form-control" type="sexo" id="sexo">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                    </select >
								</div>
                                <div class="form-group">
									
									<label>Morada</label>
									<input class="form-control" type="morada" name="morada" id="morada">
								</div>
                                <div class="form-group">
									
									<label>Número de telefone</label>
									<input class="form-control" type="n_telefone" name="n_telefone" id="n_telefone">
                                    
								</div>
                                <div class="form-group">
									
									<label>Nacionalidade</label>
									<input class="form-control" type="nac" name="nacionalidade" id="data_nas">
                                    
								</div>
                                <div class="form-group">
									
									<label>Data de nasciemento</label>
									<input class="form-control" type="date" name="data_nas" id="data_nas">
                                    
								</div>
                                <div class="form-group">
									
									<label>Função: </label>
                                    <select name="cargo" class="form-control" type="text" id="cargo" onchange="habilitarSelect()">
                                    <option value="Aluno">Aluno</option>
                                    <option value="Professor">Professor</option>
                                    <?php if($row['cargo']=="Admin"): ?>
                                    <option value="Admin">Admin</option>
                                    <?php endif; ?>
                                    </select >
									
                                    
								</div>
                                <script>
                                function habilitarSelect() {
                                var opcao = document.getElementById("cargo").value;
                                if (opcao == "Professor") {
                                    document.getElementById("disciplina").disabled = false;
                                    document.getElementById("DT").disabled = false;
                                } else {
                                    document.getElementById("disciplina").disabled = true;
                                    document.getElementById("DT").disabled = false;
                                }
                                }
                                </script>
                                <div class="form-group">
									<label>Disciplina</label>
									<select name="disciplina" class="form-control" type="text" id="disciplina" disabled>
                                    <option value="Português">Português</option>
                                    <option value="Matemática">Matemática</option>
                                    <option value="Programação">Programação</option>
                                    <option value="Redes">Redes</option>
                                    <option value="Base de Dados">Base de Dados</option>
                                    <option value="Educação Física">Educação Física</option>
                                    </select >
								</div>
                                <div class="form-group">
									<label>DT?</label>
									<input class="form-control" type="DT" name="DT" id="DT">
								</div>
                                <div class="form-group">
									<label>Turma</label>
									<input class="form-control" type="turma" name="turma" id="turma">
								</div>
								<div class="form-group">
									<label>Password</label>
									<input class="form-control" type="password" name="password" id="password">
								</div>
								<div class="form-group">
									<label>Selecione imagem</label>
									<input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
								</div>
								
								<div class="form-group text-center">
									<button class="btn btn-primary account-btn" type="submit" name="submit">Registrar</button>
								</form>


								</div>
								<div class="account-footer">
									<p>Já tem uma conta? <a href="login.php">Login</a></p>
								</div>
							</form>
							<?php
    
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sexo = mysqli_real_escape_string($conn, $_POST['sexo']);
    $morada = mysqli_real_escape_string($conn, $_POST['morada']);
    $n_telefone = mysqli_real_escape_string($conn, $_POST['n_telefone']);
    $nacionalidade = mysqli_real_escape_string($conn, $_POST['nacionalidade']);
    $data_nas = mysqli_real_escape_string($conn, $_POST['data_nas']);
    $cargo = mysqli_real_escape_string($conn, $_POST['cargo']);
    $disciplina = mysqli_real_escape_string($conn, $_POST['disciplina']);
    $DT=mysqli_real_escape_string($conn, $_POST['DT']);
    $turma=mysqli_real_escape_string($conn, $_POST['turma']);
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                echo "$email - This email already exist!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"Teste/php/images/".$new_img_name)){
                                $ran_id = rand(time(), 100000000);
                                $status = "Active now";
                                $encrypt_pass = md5($password);


                                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status, sexo, morada, n_telefone, nacionalidade, data_nas, cargo, disciplina, DT, turma)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}', '{$sexo}', '{$morada}', '{$n_telefone}', '{$nacionalidade}','{$data_nas}', '{$cargo}', '{$disciplina}', '{$DT}', '{$turma}')");
                                if($insert_query){
                                    $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id'];
                                        echo "success";
                                    }else{
                                        echo "This email address not Exist!";
                                    }
                                }else{
                                    echo "Something went wrong. Please try again!";
                                }
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                }
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>
							<!-- /Account Form -->
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<!--<script src="Teste/javascript/pass-show-hide.js"></script>-->
  		<!--<script src="Teste/javascript/signup.js"></script>-->
        
		
		<!-- Custom JS -->
		<!--<script src="assets/js/app.js"></script>-->
		
    </body>
</html>