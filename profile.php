
<?php 

session_start();
include_once "config.php";
if(!isset($_SESSION['unique_id'])){
	header("location: https://esa.ib6.pt");
}
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
				if(mysqli_num_rows($sql) > 0){
				$row = mysqli_fetch_assoc($sql);
				}
				$fname=$row['fname'];
				$lname=$row['lname'];

				if (empty($_GET['id'])){
					$id=$_SESSION['unique_id'];
				  }
				 else{ 
				  $id = $_GET['id'];
				  }

if($row['cargo']=="Aluno"){
$turma=$row['turma'];
$sql8 = mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE turma='$turma' AND cargo='Aluno'");
if(mysqli_num_rows($sql8) > 0){
$row8 = mysqli_fetch_assoc($sql8);
	$count3 = $row8['count'];
} else {
	$count3 = 0;
}
}
else{
	
	$turma=$row['turma'];
	$n_turmas_prof=explode(",", $turma );
	$n_turmas_prof=count($n_turmas_prof);
}					



$sql7 = mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE cargo='Professor'");
if(mysqli_num_rows($sql7) > 0){
$row7 = mysqli_fetch_assoc($sql7);
	$count2 = $row7['count'];
} else {
	$count2 = 0;
}



$sql2 = mysqli_query($conn, "SELECT * FROM messages WHERE incoming_msg_id = {$_SESSION['unique_id']}");
if(mysqli_num_rows($sql2) > 0){
$row2 = mysqli_fetch_assoc($sql2);
	}


// Update the session variable for last activity time
$sql9 = mysqli_query($conn, "SELECT COUNT(*) as count FROM calendar_event_master");
if(mysqli_num_rows($sql9) > 0){
$row9 = mysqli_fetch_assoc($sql9);
	$count4 = $row9['count'];
} else {
	$count4 = 0;
}


$sql6 = mysqli_query($conn, "SELECT COUNT(*) as count FROM files WHERE uploader_fname = '$fname' AND uploader_lname = '$lname'");
if(mysqli_num_rows($sql6) > 0){
$row6 = mysqli_fetch_assoc($sql6);
$count = $row6['count'];
} else {
$count = 0;
}




$turma=$row['turma'];
if($row['cargo']=='Aluno'):
$resultado = mysqli_query($conn, "SELECT * FROM users WHERE DT = '$turma'");
else:
$resultado = mysqli_query($conn, "SELECT * FROM users WHERE DT != ''");
endif;
$resultado2 = mysqli_query($conn, "SELECT * FROM users WHERE cargo = 'Professor'");





$turmas=array();
$turmas=explode(",", $row['turma']);
$n=count($turmas);
if($row['disciplina']=="Portugês"){
$disciplina2="Portugues";
}elseif($row['disciplina']=="Matemática"){
$disciplina2="Matematica";
}elseif($row['disciplina']=="Base de Dados"){
$disciplina2="Base%20de%20Dados";
}elseif($row['disciplina']=="Redes"){
$disciplina2="Redes";
}elseif($row['disciplina']=="Educação Física"){
$disciplina2="Educacao%20Fisica";
}elseif($row['disciplina']=="Programação"){
$disciplina2="Programacao";
}	

if ($row['cargo']=="Aluno"){
$turma=$row['turma'];
$sql5 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turma'");
}
if($row['cargo']=="Professor"){
if($n==1){
$sql5 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]'");
}elseif($n==2){
$sql5 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]'");
}elseif($n==3){
$sql5 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]' OR turma='$turmas[2]'");
}elseif($n==4){
$sql5 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]' OR turma='$turmas[2]' OR turma='$turmas[3]'");
}elseif($n==5){
$sql5 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]' OR turma='$turmas[2]' OR turma='$turmas[3]' OR turma='$turmas[5]'");
}elseif($n==6){
$sql5 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]' OR turma='$turmas[2]' OR turma='$turmas[3]' OR turma='$turmas[5]' OR turma='$turmas[6]'");
}
}
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Perfil</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/css/select2.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Tagsinput CSS -->
		<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
	<style>
	.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
input[type=file]{
    color:transparent;
}
</style>
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
							  
								  <!-- Logo -->
								  <div class="header-left">
									  <a href="index3.php" class="logo">
										  <img src="assets/img/logo.png" width="140" height="50" alt="">
									  </a>
								  </div>
								  <!-- /Logo -->
								  
								  <a id="toggle_btn" href="javascript:void(0);">
									  <span class="bar-icon">
										  <span></span>
										  <span></span>
										  <span></span>
									  </span>
								  </a>
								  
								  <!-- Header Title -->
								  <div class="page-title-box">
									  <h3>Moodellel</h3>
								  </div>
								  <!-- /Header Title -->
								  
								  <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="la la-bars"></i></a>
								  
								  <!-- Header Menu -->
								  <ul class="nav user-menu">
								  
									  <!-- Search -->
									  <li class="nav-item">
										  <div class="top-nav-search">
											  <a href="javascript:void(0);" class="responsive-search">
												  <i class="la la-search"></i>
											 </a>
											  
										  </div>
									  </li>
									  <!-- /Search -->
								  
									 
					  				
					  					<?php 
										while($row5 = mysqli_fetch_assoc($sql5)){
											$rows[] = $row5;
											$num2=$num2+1;
											
										}
										
										?>
									  <!-- Notifications -->
									  <li class="nav-item dropdown">
										  <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
											  <i class="la la-bell-o"></i> <span class="badge badge-pill"><?php echo $num2?></span>
										  </a>
										  <div class="dropdown-menu notifications">
											  <div class="topnav-dropdown-header">
												  <span class="notification-title">Notificações</span>
												  <? $pagina_atual = $_SERVER['PHP_SELF'];
												  $pagina_atual=explode(".", $pagina_atual)
												  ?>
												  <a href="delete_not.php?pag=<?php echo $pagina_atual[0]?> " class="clear-noti"> Limpar tudo </a>
											  </div>
											  <div class="noti-content">
												  <ul class="notification-list">
												  <?php 
													if($rows!=NULL){
													 $rows_reversed = array_reverse($rows);
													 
													 foreach ($rows_reversed as $rows) : ?>
													 
														<li class="notification-message">
															<a href="eventos.php">
																<div class="media">
																	<span class="avatar">
																		<img alt="" src="exclamacao.jpg">
																	</span>
																	<div class="media-body">
																	<p  class="noti-details" ><span class="noti-title" style="color:red" >Alerta Evento</span></p>
																		<p class="noti-details"><span class="noti-title"><?php echo $rows['event_name'] ?></span></p>
																		<p class="noti-time"><span class="notification-time"><?php echo $rows['event_start_date'] ?></span></p>
																		<?php if($row['cargo']=="Professor"): ?> 
																		<p class="noti-time"><span class="notification-time">Turma: <?php echo $rows['turma'] ?></span></p>
																		  <?php endif; ?>
																	</div>
																</div>
															</a>
														</li>
														<?php endforeach; 
													}else{
														?>
														<li class="notification-message">
															
																<div class="media">
																	
																	<div class="media-body">
																	<p  class="noti-details" ><span class="noti-title" style="color:red" >Não há novos eventos</span></p>
																		
																		
																	</div>
																</div>
															
														</li>
													<?php
												}?>
												  </ul>
											  </div>
											  <div class="topnav-dropdown-footer">
												  <a href="activities.html">Ver todas as notificações</a>
												  
											  </div>
										  </div>
									  </li>
									  <!-- /Notifications -->
									  
									  <!-- Message Notifications -->
									  <li class="nav-item dropdown">
										<?php
										$rows = array(); // Definir o array fora do loop while
														  
										while ($row2 = mysqli_fetch_assoc($sql2)) {
											$rows[] = $row2; // Adicionar cada linha ao array
											$num=$num+1;
										}
										?>
										  <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
											  <i class="la la-comment-o"></i> <span class="badge badge-pill"><?php echo $num ?></span>
										  </a>
										  <div class="dropdown-menu notifications">
											  <div class="topnav-dropdown-header">
												  <span class="notification-title">Mensagens</span>
												  
											  </div>
											  <div class="noti-content">
												  <ul class="notification-list">
													  <li class="notification-message">
														  <?php
														  
														  
														  
														  $rows_reversed = array_reverse($rows); // Reverter a ordem do array
														  
														  foreach ($rows_reversed as $row):
															  $id_enviar = $row['outgoing_msg_id'];
															  $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = $id_enviar");
															  if (mysqli_num_rows($sql3) > 0) {
																  $row3 = mysqli_fetch_assoc($sql3);
															  }
														  ?>
															<a href="https://esa.ib6.pt/ChatLouco.php?unique_id=<?php echo $row['outgoing_msg_id'] ?>">
														 	
															
															  <div class="list-item">
																  <div class="list-left">
																	  <span class="avatar">
																		  <img alt="" src="Teste/php/images/<?php echo $row3['img']?>">
																	  </span>
																  </div>
																  <div class="list-body">
																	
																  
																 
																	
																	  <span class="message-author"><?php echo $row3['fname'] ?><?php $row3['lname'] ?> </span>
																	  
																	  <div class="clearfix"></div>
																	  <span class="message-content"><?php echo $row['msg'] ?></span>
																  </div>
															  </div>
														  </a>
														  <?php endforeach; ?>
													  </li>
													  
												  </ul>
											  </div>
											  <div class="topnav-dropdown-footer">
												  <a href="https://esa.ib6.pt/ChatLouco.php">Ver todas as notificações</a>
											  </div>
										  </div>
									  </li>
									  <!-- /Message Notifications -->
									  <?php
										  
										  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
					if(mysqli_num_rows($sql) > 0){
					$row = mysqli_fetch_assoc($sql);
						}
						
					
					?>
									  <li class="nav-item dropdown has-arrow main-drop">
										  <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
											  <span class="user-img"><img src="Teste/php/images/<?php echo $row['img'];?>" alt="">
											  <span class="status online"></span></span>
											  <?php $fname = $row['fname']; ?>
											  <span><?php echo $row['fname']; ?></span>
										  </a>
										  <div class="dropdown-menu" method="POST">
										  
											  <a class="dropdown-item" href="profile.php">Perfil</a>
											  
											  <a class="dropdown-item" href="logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
											  
											  
										  </div>
									  </li>
								  </ul>
								  <!-- /Header Menu -->
								  	

					  			<!-- Page Content -->
								  <div class="content container-fluid">
								  
								  </div>
				
				
				                      <!-- /Page Header ou seja a merda da parte onde ta o logo--> 
			
				


								  <!-- Mobile Menu -->
								  <div class="dropdown mobile-user-menu">
									  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="la la-ellipsis-v"></i></a>
									  <div class="dropdown-menu dropdown-menu-right">
										  <a class="dropdown-item" href="profile.html">My Profile</a>
										  <a class="dropdown-item" href="settings.html">Settings</a>
										  <a class="dropdown-item" href="login.php">Logout</a>
									  </div>
								  </div>
								  <!-- /Mobile Menu -->
								  
							  </div>
							  <!-- /Header -->
			
			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
										  <ul>
											  <li class="menu-title"> 
												  <span>Main</span>
											  </li>
											  <li> 
												  <a href="index3.php"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
											  </li>
											  <li> 
												  <a href="index.php"><i class="la la-home"></i> <span>Página Inicial</span></a>
											  </li>
											  <li class="menu-title"> 
												  <span>Apps</span>
												  <li> 
												  <a href="https://esa.ib6.pt/ChatLouco.php"><i class="la la-weixin"></i> <span>Chat</span></a>
											  	  </li>
													<li> 
												  <a href="https://esa.ib6.pt/jitsi.php"><i class="la la-video-camera"></i> <span>Chamadas de Vídeo</span></a>
											  	  </li>
													<li> 
												  <a href="https://esa.ib6.pt/CalendarioPodre/popiupcal.php"><i class="la la-calendar"></i> <span>Calendário</span></a>
											  	  </li>
													<li> 
												  <a href="contacts.php"><i class="la la-phone"></i> <span>Contactos</span></a>
											  	  </li>
													<li> 
												  <a href="https://esa.ib6.pt/inboxteste.php"><i class="la la-envelope"></i> <span>Email</span></a>
											  	  </li>
													</li>
													<?php if($row['cargo']=='Aluno'):?>
													  <li><a href="https://esa.ib6.pt/file-manager3.php?dir=uploads/<?php echo $row['turma']?>/Portugues"><i class="la la-file"></i><span>Ficheiros</span></a></li>
													  <?php endif; ?>
													  <?php if($row['cargo']=='Professor'):?>
													  <li><a href="https://esa.ib6.pt/file-manager3.php?dir=uploads/<?php echo $turmas[0]?>/<?php echo $disciplina2?>"><i class="la la-file"></i><span>Ficheiros</span></a></li>
													  <?php endif; ?>
													  
											  </li>
											  <li class="menu-title"> 
												  <span>Trabalhadores</span>
											  </li>
											  <li> 
												  <a href="employees.php"><i class="la la-users"></i> <span>Professores</span></a>
											  </li>
											  <li> 
											  <?php if($row['cargo']=="Aluno"): ?>
												  <a href="alunos.php?turma=<?php echo $row['turma']?>"><i class="la la-graduation-cap"></i> <span>Alunos</span></a>
												<?php else:?>
													<a href="turmas.php"><i class="la la-graduation-cap"></i> <span>Alunos</span></a>
												<?php endif; ?>
											  </li>
											  
											  
													  </li>
												  </ul>
											  </li>
										  </ul>
									  </div>
                </div>
            </div>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Perfil</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Perfil</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="card mb-0">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
										<div class="profile-img-wrap">
											<div class="profile-img">
											<?php
											$sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = $id");
												if(mysqli_num_rows($sql2) > 0){
												$row7 = mysqli_fetch_assoc($sql2);
											}
											?>
											
												<a href="#"><img alt="" src="Teste/php/images/<?php echo $row7['img'];?>"></a>
											</div>
										</div>
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
														<h3 class="user-name m-t-0 mb-0"><?php echo $row7['fname']; ?> <?php echo $row7['lname']; ?></h3>
														<h6 class="text-muted"><?php echo $row7['cargo']; ?></h6>
														<small class="text-muted"><?php echo $row7['turma']; ?></small>
														<div class="staff-id">Número escolar : <?php echo $row7['user_id']; ?></div>
														<?php if(!empty($row7['DT'])): ?>
														<div class="staff-id">DT : <?php echo $row7['DT']; ?></div>
														<?php endif;?>
														
																
														<!-- /Codigo implementar imagem-->
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<div class="title">Telefone:</div>
															<div class="text"><a href=""><?php echo $row7['n_telefone']; ?></a></div>
														</li>
														<li>
															<div class="title">Email:</div>
															<div class="text"><a href=""><?php echo $row7['email']; ?></a></div>
														</li>
														<li>
															<div class="title">Aniversario:</div>
															<div class="text"><?php echo $row7['data_nas']; ?></div>
														</li>
														<li>
															<div class="title">Morada:</div>
															<div class="text"><?php echo $row7['morada']; ?></div>
														</li>
														<li>
															<div class="title">Genero:</div>
															<div class="text"><?php echo $row7['sexo']; ?></div>
														</li>
														
													</ul>
												</div>
											</div>
										</div>
										<?php if($row['unique_id']==$row7['unique_id']): ?>
										<div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					
					<div class="tab-content">
					
						
						
						
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Profile Modal -->
				<div id="profile_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Informação do Perfil</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" enctype="multipart/form-data">
									<div class="row" >
										<div class="col-md-12">
											<div class="profile-img-wrap edit-img">
												<img class="inline-block" src="Teste/php/images/<?php echo $row['img'];?>" alt="user">
												<div class="fileupload btn">
													<span class="btn-text">editar</span>
													<input class="upload" type="file" name="nova_img" id="nova_img">
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Primeiro Nome</label>
														<input type="text" class="form-control" name="novo_pnome" id="novo_pnome" value="<?php echo $row['fname']; ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Último Nome</label>
														<input type="text" class="form-control" name="novo_unome" id="novo_unome" value="<?php echo $row['lname']; ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Date de Nascimento</label>
														<div class="cal-icon">
															<input class="form-control datetimepicker" type="text" name="nova_data" id="nova_data" value="<?php echo $row['data_nas']; ?>">
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Sexo</label>
														<select class="select form-control" name="novo_sexo" id="novo_sexo">
															<?php if($row['sexo']=="Masculino"): ?>
															<option value="Masculino">Masculino</option>
															<option value="Feminino">Feminino</option>
															<?php else: ?>
															<option value="Feminino">Feminino</option>
															<option value="Masculino">Masculino</option>
																
															<?php endif; ?>
															
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Morada</label>
												<input type="text" class="form-control" name="nova_morada" id="nova_morada" value="<?php echo $row['morada'] ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Nº de telefone</label>
												<input type="text" class="form-control" name="novo_telefone" id="novo_telefone" value="<?php echo $row['n_telefone'] ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Nacionalidade</label>
												<input type="text" class="form-control" name="nova_nacionalidade" id="nova_nacionalidade" value="<?php echo $row['nacionalidade'] ?>">
											</div>
										</div>
										<?php if($row['cargo']=="Professor" || $row['cargo']=="Admin"): ?>
										<div class="col-md-6">
											<div class="form-group">
												<label>Turma</label>
												<input type="text" class="form-control" name="nova_turma" id="nova_turma" value="<?php echo $row['turma'] ?>">
											</div>
										</div>
										<?php endif; ?>
										<?php if($row['cargo']=="Professor" || $row['cargo']=="Admin"): ?>
										<div class="col-md-6">
											<div class="form-group">
												<label>DT</label>
												<input type="text" class="form-control" name="nova_DT" id="nova_DT" value="<?php echo $row['DT'] ?>">
											</div>
										</div>
										<?php endif; ?>
										<?php if($row['cargo']=="Professor" || $row['cargo']=="Admin"): ?>
										<div class="col-md-6">
											<div class="form-group">
												<label>Disciplina</label>
												<input type="text" class="form-control" name="nova_disciplina" id="nova_disciplina" value="<?php echo $row['disciplina'] ?>">
											</div>
										</div>
										<?php endif; ?>
										
										
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="submit">Submter</button>
									</div>
														
								</form>
							
								
							</div>
						</div>
					</div>
				</div>
				<!-- /Profile Modal -->
				
				<!-- Personal Info Modal -->
				<div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Personal Information</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Passport No</label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Passport Expiry Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" type="text">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Tel</label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Nationality <span class="text-danger">*</span></label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Religion</label>
												<div class="cal-icon">
													<input class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Marital status <span class="text-danger">*</span></label>
												<select class="select form-control">
													<option>-</option>
													<option>Single</option>
													<option>Married</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Employment of spouse</label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>No. of children </label>
												<input class="form-control" type="text">
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Personal Info Modal -->
				<?php if($_SERVER['REQUEST_METHOD']=='POST'){
									$img_name = $_FILES['nova_img']['name'];
									$img_type = $_FILES['nova_img']['type'];
									$tmp_name = $_FILES['nova_img']['tmp_name'];
									
									$img_explode = explode('.',$img_name);
									$img_ext = end($img_explode);
					
									$extensions = ["jpeg", "png", "jpg"];
									if(!empty($img_name)){
									if(in_array($img_ext, $extensions) === true){
										$types = ["image/jpeg", "image/jpg", "image/png"];
										if(in_array($img_type, $types) === true){
											$time = time();
											$new_img_name = $time.$img_name;
											$imagemantiga = $row['img'];
											move_uploaded_file($tmp_name,"Teste/php/images/".$new_img_name);
												//$insert_query = mysqli_query($conn, "UPDATE users SET img = '".$new_img_name."'  WHERE img='".$imagemantiga."'");
												
										
									
								}
							}//
						}else{
							$new_img_name=$row['img'];
						}
									
									$novo_pnome=$_POST['novo_pnome'];
									$novo_unome=$_POST['novo_unome'];
									$nova_data=$_POST['nova_data'];
									$novo_sexo=$_POST['novo_sexo'];
									$nova_morada=$_POST['nova_morada'];
									$novo_telefone=$_POST['novo_telefone'];
									$nova_nacionalidade=$_POST['nova_nacionalidade'];
									$nova_turma=$_POST['nova_turma'];
									$nova_dt=$_POST['nova_DT'];
									$nova_disciplina=$_POST['nova_disciplina'];
									$unique_id=$row['unique_id'];
									if($row['cargo']=="Aluno"){
										$nova_disciplina=$row['disciplina'];
										$nova_turma=$row['turma'];
									}
									



									$sql0 = "UPDATE users SET fname = '$novo_pnome', lname = '$novo_unome', data_nas = '$nova_data', sexo='$novo_sexo', morada='$nova_morada', n_telefone='$novo_telefone', nacionalidade='$nova_nacionalidade', turma='$nova_turma', DT='$nova_dt', disciplina='$nova_disciplina', img = '$new_img_name' WHERE unique_id='$unique_id';";

									if ($conn->query($sql0) === TRUE) {
										echo "Sucesso.";
										?>
										<meta http-equiv="refresh" content="0;URL='http://esa.ib6.pt/profile.php'" />  
										<?php 
												} 

											}
								
								?>
				<!-- Family Info Modal -->
				<div id="family_info_modal" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"> Family Informations</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-scroll">
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Family Member <a href="javascript:void(0);" class="delete-icon"><i class="la la-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Name <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Relationship <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Date of birth <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Phone <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="la la-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Name <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Relationship <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Date of birth <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Phone <span class="text-danger">*</span></label>
															<input class="form-control" type="text">
														</div>
													</div>
												</div>
												<div class="add-more">
													<a href="javascript:void(0);"><i class="la la-plus-circle"></i> Add More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Family Info Modal -->
				
				<!-- Emergency Contact Modal -->
				<div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Personal Information</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">Primary Contact</h3>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Name <span class="text-danger">*</span></label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Relationship <span class="text-danger">*</span></label>
														<input class="form-control" type="text">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Phone <span class="text-danger">*</span></label>
														<input class="form-control" type="text">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Phone 2</label>
														<input class="form-control" type="text">
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">Primary Contact</h3>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Name <span class="text-danger">*</span></label>
														<input type="text" class="form-control">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Relationship <span class="text-danger">*</span></label>
														<input class="form-control" type="text">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Phone <span class="text-danger">*</span></label>
														<input class="form-control" type="text">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Phone 2</label>
														<input class="form-control" type="text">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Emergency Contact Modal -->
				
				<!-- Education Modal -->
				<div id="education_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title"> Education Informations</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-scroll">
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="la la-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Oxford University" class="form-control floating">
															<label class="focus-label">Institution</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Computer Science" class="form-control floating">
															<label class="focus-label">Subject</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<div class="cal-icon">
																<input type="text" value="01/06/2002" class="form-control floating datetimepicker">
															</div>
															<label class="focus-label">Starting Date</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<div class="cal-icon">
																<input type="text" value="31/05/2006" class="form-control floating datetimepicker">
															</div>
															<label class="focus-label">Complete Date</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="BE Computer Science" class="form-control floating">
															<label class="focus-label">Degree</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Grade A" class="form-control floating">
															<label class="focus-label">Grade</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Education Informations <a href="javascript:void(0);" class="delete-icon"><i class="la la-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Oxford University" class="form-control floating">
															<label class="focus-label">Institution</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Computer Science" class="form-control floating">
															<label class="focus-label">Subject</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<div class="cal-icon">
																<input type="text" value="01/06/2002" class="form-control floating datetimepicker">
															</div>
															<label class="focus-label">Starting Date</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<div class="cal-icon">
																<input type="text" value="31/05/2006" class="form-control floating datetimepicker">
															</div>
															<label class="focus-label">Complete Date</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="BE Computer Science" class="form-control floating">
															<label class="focus-label">Degree</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus focused">
															<input type="text" value="Grade A" class="form-control floating">
															<label class="focus-label">Grade</label>
														</div>
													</div>
												</div>
												<div class="add-more">
													<a href="javascript:void(0);"><i class="la la-plus-circle"></i> Add More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Education Modal -->
				
				<!-- Experience Modal -->
				<div id="experience_info" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Experience Informations</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="form-scroll">
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="la la-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Digital Devlopment Inc">
															<label class="focus-label">Company Name</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="United States">
															<label class="focus-label">Location</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Web Developer">
															<label class="focus-label">Job Position</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="01/07/2007">
															</div>
															<label class="focus-label">Period From</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="08/06/2018">
															</div>
															<label class="focus-label">Period To</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-body">
												<h3 class="card-title">Experience Informations <a href="javascript:void(0);" class="delete-icon"><i class="la la-trash-o"></i></a></h3>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Digital Devlopment Inc">
															<label class="focus-label">Company Name</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="United States">
															<label class="focus-label">Location</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<input type="text" class="form-control floating" value="Web Developer">
															<label class="focus-label">Job Position</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="01/07/2007">
															</div>
															<label class="focus-label">Period From</label>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-focus">
															<div class="cal-icon">
																<input type="text" class="form-control floating datetimepicker" value="08/06/2018">
															</div>
															<label class="focus-label">Period To</label>
														</div>
													</div>
												</div>
												<div class="add-more">
													<a href="javascript:void(0);"><i class="la la-plus-circle"></i> Add More</a>
												</div>
											</div>
										</div>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Experience Modal -->
				<?php
				$inactive_time = 900;
					
					
					// Check if the session variable for last activity time exists and is within the limit
					if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive_time)) {
						?>
						
						<meta http-equiv="refresh" content="0; url='logout.php?logout_id=<?php echo $row['unique_id']?>'"/>
						
						<?php
						exit;
						
					}
					$_SESSION['last_activity'] = time();
					?>
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>

		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

		<!-- Slimscroll JS -->
		<script src="assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/js/select2.min.js"></script>
