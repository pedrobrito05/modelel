<?php
session_start();
include_once "config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: https://esa.ib6.pt");
  }
						
  $resultado = mysqli_query($conn, "SELECT DISTINCT turma from users WHERE cargo='Aluno'");
  
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if(mysqli_num_rows($sql) > 0){
$row = mysqli_fetch_assoc($sql);
	}

	
	$sql5 = mysqli_query($conn, "SELECT * FROM calendar_event_master");
	
	
	$sql2 = mysqli_query($conn, "SELECT * FROM messages WHERE incoming_msg_id = {$_SESSION['unique_id']}");
	if(mysqli_num_rows($sql2) > 0){
	$row2 = mysqli_fetch_assoc($sql2);
		}



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
		  $sql6 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turma'");
	  }
	  if($row['cargo']=="Professor"){
	  if($n==1){
		  $sql6 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]'");
	  }elseif($n==2){
		  $sql6 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]'");
	  }elseif($n==3){
		  $sql6 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]' OR turma='$turmas[2]'");
	  }elseif($n==4){
		  $sql6 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]' OR turma='$turmas[2]' OR turma='$turmas[3]'");
	  }elseif($n==5){
		  $sql6 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]' OR turma='$turmas[2]' OR turma='$turmas[3]' OR turma='$turmas[5]'");
	  }elseif($n==6){
		  $sql6 = mysqli_query($conn, "SELECT * FROM calendario_not WHERE turma='$turmas[0]' OR turma='$turmas[1]' OR turma='$turmas[2]' OR turma='$turmas[3]' OR turma='$turmas[5]' OR turma='$turmas[6]'");
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
        <title>Alunos</title>
		
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
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
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
						
					  				
					  					<?php 
										while($row6 = mysqli_fetch_assoc($sql6)){
											$rows[] = $row6;
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
												  <a href="delete_not.php?pag=turmas" class="clear-noti"> Limpar tudo </a>
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
												  <a href="https://esa.ib6.pt/popiup.php"><i class="la la-video-camera"></i> <span>Chamadas de Vídeo</span></a>
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
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Alunos</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Alunos</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
							<?php if($row['cargo']=="Admin" || $row['DT']=="DT"): ?>
							<a href="register.php" class="btn add-btn" ><i class="la la-plus"></i> Add Employee</a>
							<?php endif; ?>
								<div class="view-icons">
									
								</div>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					
					<!-- Search Filter -->
					<?php $i=0; 
					$i2=0;
					?>
					<div class="row staff-grid-row">
						<?php $turma=array() ?>
						<?php while ($row2 = mysqli_fetch_assoc($resultado)): ?>
						
						
						<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
							<div class="profile-widget">
								
									
									<?php $id=$row2['unique_id']; ?>
									
								<div class="dropdown profile-action">
								<?php if($row['cargo']=="Admin" || $row['DT']=="DT"):?>	
								<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
									<div class="dropdown-menu dropdown-menu-right">
									<?php $color='black';
									
										echo"
										<td><a href='?id=$id' id='delete'>&nbsp&nbsp&nbspRemover</a>
																			
										"
										?>
								</div>
								<?php endif; ?>

								</div>
								<?php 
								
								
								?>
								<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="alunos.php?turma=<?php echo $row2['turma']?>"><?php echo $row2['turma'];?></a></h4>
								<div class="small text-muted"></div>
								
								
							</div>
							
						</div>
						
						
						<?php endwhile; ?>
					</div>
					




                </div>
				<!-- /Page Content -->
				
				<!-- Add Employee Modal -->
				<div id="add_employee" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Employee</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">First Name <span class="text-danger">*</span></label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Last Name</label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Username <span class="text-danger">*</span></label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Email <span class="text-danger">*</span></label>
												<input class="form-control" type="email">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Password</label>
												<input class="form-control" type="password">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Confirm Password</label>
												<input class="form-control" type="password">
											</div>
										</div>
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
												<input type="text" class="form-control">
											</div>
										</div>
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
												<div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Phone </label>
												<input class="form-control" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Company</label>
												<select class="select">
													<option value="">Global Technologies</option>
													<option value="1">Delta Infotech</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Department <span class="text-danger">*</span></label>
												<select class="select">
													<option>Select Department</option>
													<option>Web Development</option>
													<option>IT Management</option>
													<option>Marketing</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Designation <span class="text-danger">*</span></label>
												<select class="select">
													<option>Select Designation</option>
													<option>Web Designer</option>
													<option>Web Developer</option>
													<option>Android Developer</option>
												</select>
											</div>
										</div>
									</div>
									<div class="table-responsive m-t-15">
										<table class="table table-striped custom-table">
											<thead>
												<tr>
													<th>Module Permission</th>
													<th class="text-center">Read</th>
													<th class="text-center">Write</th>
													<th class="text-center">Create</th>
													<th class="text-center">Delete</th>
													<th class="text-center">Import</th>
													<th class="text-center">Export</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Holidays</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Leaves</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Clients</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Projects</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Tasks</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Chats</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Assets</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Timing Sheets</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Employee Modal -->
				
				<!-- Edit Employee Modal -->
				<div id="edit_employee" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Employee</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">First Name <span class="text-danger">*</span></label>
												<input class="form-control" value="John" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Last Name</label>
												<input class="form-control" value="Doe" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Username <span class="text-danger">*</span></label>
												<input class="form-control" value="johndoe" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Email <span class="text-danger">*</span></label>
												<input class="form-control" value="johndoe@example.com" type="email">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Password</label>
												<input class="form-control" value="johndoe" type="password">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Confirm Password</label>
												<input class="form-control" value="johndoe" type="password">
											</div>
										</div>
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
												<input type="text" value="FT-0001" readonly class="form-control floating">
											</div>
										</div>
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
												<div class="cal-icon"><input class="form-control datetimepicker" type="text"></div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Phone </label>
												<input class="form-control" value="9876543210" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Company</label>
												<select class="select">
													<option>Global Technologies</option>
													<option>Delta Infotech</option>
													<option selected>International Software Inc</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Department <span class="text-danger">*</span></label>
												<select class="select">
													<option>Select Department</option>
													<option>Web Development</option>
													<option>IT Management</option>
													<option>Marketing</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Designation <span class="text-danger">*</span></label>
												<select class="select">
													<option>Select Designation</option>
													<option>Web Designer</option>
													<option>Web Developer</option>
													<option>Android Developer</option>
												</select>
											</div>
										</div>
									</div>
									<div class="table-responsive m-t-15">
										<table class="table table-striped custom-table">
											<thead>
												<tr>
													<th>Module Permission</th>
													<th class="text-center">Read</th>
													<th class="text-center">Write</th>
													<th class="text-center">Create</th>
													<th class="text-center">Delete</th>
													<th class="text-center">Import</th>
													<th class="text-center">Export</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Holidays</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Leaves</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Clients</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Projects</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Tasks</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Chats</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Assets</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
												<tr>
													<td>Timing Sheets</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input checked="" type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
													<td class="text-center">
														<input type="checkbox">
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn">Save</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Employee Modal -->
				
				<!-- Delete Employee Modal -->
				<div class="modal custom-modal fade" id="delete_employee" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Employee</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Delete Employee Modal -->
				
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<?php
				
					
				
				
																		
																		
				
				if (isset($_GET['id'])) {
					
					$del = $_GET['id'];
					
					


							
							

							$sql2 = "DELETE FROM users WHERE unique_id='$del'"; 
							
							
							if (mysqli_query($conn, $sql2)) {
								echo "Record deleted successfully", $del ;
								?>
								<meta http-equiv="refresh" content="0; url='https://esa.ib6.pt/employees.php'"/>
								<?php
							} else {
								echo "Error deleting record: " . mysqli_error($conn);
							}
							
							// Close the statement and the connection
							mysqli_close($conn);
							
							
						
						
					
					//header("Refresh:0");
					//exit();
				}

				?>
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
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>
		
    </body>
</html>