<?php 
session_start();
include_once "config.php";
if(!isset($_SESSION['unique_id'])){
	header("location: https://esa.ib6.pt");
}
$sql2 = mysqli_query($conn, "SELECT * FROM messages WHERE incoming_msg_id = {$_SESSION['unique_id']}");
if(mysqli_num_rows($sql2) > 0){
$row2 = mysqli_fetch_assoc($sql2);
	}
$hostname = "localhost";
$username = "Calendario";
$password = "r7MX46FdDSDbr3rm";  
$database = "calendario";   
				
$conn5=mysqli_connect($hostname,$username,$password,$database);  
$sql5 = mysqli_query($conn5, "SELECT * FROM calendar_event_master");

// Update the session variable for last activity time

if (empty($_GET['unique_id'])){
	$link="https://esa.ib6.pt/Teste/chat.php";
  }
 else{ 
$id=$_GET['unique_id'];
  $link = "https://esa.ib6.pt/Teste/chat.php?user_id=$id";
  }
?>
  <?php $sql0= mysqli_query($conn, "SELECT * FROM users WHERE {$_SESSION['unique_id']} = unique_id");
  if(mysqli_num_rows($sql0) > 0){
  $row0 = mysqli_fetch_assoc($sql0);
  } 
  $turmas= array();
  $turmas = explode(',',$row0['turma']);
?>
<!DOCTYPE html>
<html lang="en">
	
    <head>
		<style>
		  </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Chat</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="assets/css/line-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body style="overflow-y: hidden;">
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="index.php" class="logo">
						<img src="assets/img/logo.png" width="140" height="50" alt="">
					</a>
                </div>
				<!-- /Logo -->
				
				<!-- Header Title -->
                <div class="page-title-box">
					<h3>Video Chamadas</h3>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
				
					<!-- Search -->
					<li class="nav-item">
						<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
						   </a>
							<form action="search.html">
								<input class="form-control" type="text" placeholder="Search here">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</li>
					<!-- /Search -->

					
				
					<!-- Flag -->
					<li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
							<img src="assets/img/flags/pt.png" alt="" height="20"> <span>Português</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets/img/flags/us.png" alt="" height="16"> English
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets/img/flags/pt.png" alt="" height="16"> Português
							</a>
						</div>
					</li>
					<!-- /Flag -->
										<?php 
										while($row5 = mysqli_fetch_assoc($sql5)){
											$rows[] = $row5;
											$num=$num+1;
											
										}
										
										?>
									  <!-- Notifications -->
									  <li class="nav-item dropdown">
										  <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
											  <i class="fa fa-bell-o"></i> <span class="badge badge-pill"><?php echo $num?></span>
										  </a>
										  <div class="dropdown-menu notifications">
											  <div class="topnav-dropdown-header">
												  <span class="notification-title">Notificações</span>
												  <a href="javascript:void(0)" class="clear-noti"> Limpar tudo </a>
											  </div>
											  <div class="noti-content">
												  <ul class="notification-list">
													 <?php 
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
																  </div>
															  </div>
														  </a>
													  </li>
													  <?php endforeach; ?>
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
											  <i class="fa fa-comment-o"></i> <span class="badge badge-pill"><?php echo $num ?></span>
										  </a>
										  <div class="dropdown-menu notifications">
											  <div class="topnav-dropdown-header">
												  <span class="notification-title">Mensagens</span>
												  <a href="javascript:void(0)" class="clear-noti"> Limpar tudo </a>
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
											  <a class="dropdown-item" href="settings.html">Definições</a>
											  <a class="dropdown-item" href="logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
											  
											  
										  </div>
									  </li>
								  </ul>
								<!-- /Header Menu -->
								
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a>
						<a class="dropdown-item" href="login.html">Logout</a>
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
												  <a href="index.php"><i class="la la-dashboard"></i> <span>Página Inicial</span></a>
											  </li>
											  <li class="menu-title"> 
												  <span>Apps</span>
												  <li> 
												  <a href="https://esa.ib6.pt/ChatLouco.php"><i class="fa fa-weixin"></i> <span>Chat</span></a>
											  	  </li>
													<li> 
												  <a href="https://esa.ib6.pt/jitsi.php"><i class="fa fa-video-camera"></i> <span>Chamadas de Vídeo</span></a>
											  	  </li>
													<li> 
												  <a href="https://esa.ib6.pt/eventos.php"><i class="fa fa-calendar"></i> <span>Calendário</span></a>
											  	  </li>
													<li> 
												  <a href="contacts.php"><i class="fa fa-volume-control-phone"></i> <span>Contactos</span></a>
											  	  </li>
													<li> 
												  <a href="https://esa.ib6.pt/inboxteste.php"><i class="fa fa-envelope"></i> <span>Email</span></a>
											  	  </li>
													<?php if($row['cargo']=='Aluno'):?>
													  <li><a href="https://esa.ib6.pt/file-manager3.php?dir=uploads/Portugues"><i class="fa fa-files-o"></i><span>Ficheiros</span></a></li>
													  <?php endif; ?>
													  <?php if($row['disciplina']=='Português'):?>
													  <li><a href="https://esa.ib6.pt/file-manager3.php?dir=uploads/Portugues">Ficheiros</a></li>
													  <?php endif; ?>
													  <?php if($row['disciplina']=='Matemática'): ?>
													  <li><a href="https://esa.ib6.pt/file-manager3.php?dir=uploads/Matematica">Ficheiros</a></li>
													  <?php endif; ?>
													  <?php if($row['disciplina']=='Programação'): ?>
													  <li><a href="https://esa.ib6.pt/file-manager3.php?dir=uploads/Programacao">Ficheiros</a></li>
													  <?php endif; ?>
													  <?php if($row['disciplina']=='Redes'): ?>
													  <li><a href="https://esa.ib6.pt/file-manager3.php?dir=uploads/Redes">Ficheiros</a></li>
													  <?php endif; ?>
													  <?php if($row['disciplina']=='Base de Dados'): ?>
													  <li><a href="https://esa.ib6.pt/file-manager3.php?dir=uploads/Base%20de%20Dados">Ficheiros</a></li>
													  <?php endif; ?>
													  <?php if($row['disciplina']=='Educação Física'): ?>
													  <li><a href="https://esa.ib6.pt/file-manager3.php?dir=uploads/Educacao%20Fisica">Ficheiros</a></li>
													  <?php endif; ?>
											  </li>
											  <li class="menu-title"> 
												  <span>Trabalhadores</span>
											  </li>
											  <li> 
												  <a href="employees.php"><i class="la la-users"></i> <span>Professores</span></a>
											  </li>
											  <li> 
												  <a href="alunos.php"><i class="la la-users"></i> <span>Alunos</span></a>
											  </li>
											  
													  </li>
												  </ul>
											  </li>
										  </ul>
									  </div>
                </div>
            </div>
			<!-- /Sidebar -->
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
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				
				
				
					<div class="chat-main-row">	
						<!-- Chat Main Wrapper -->
						
						


							<div id="jitsi-container" class="chat-main-wrapper">
							<div class="jitsi-box">
								<script src='https://meet.jit.si/external_api.js' ></script>
								<div class="thebody text-center">


								<div class="container align-items-center ">
								<div class="transbox text-center">
								<button id="start" class="btn btn-primary account-btn" type="button" style="margin: 20% 30% 0 30%;"><b style="font-weight: 100">Começar Nova Reunião</b></button>
									</div>
									</div>
									</div>
								<div class="container align-items-center">
								</div>
									</div>

								<script>
									const btn = document.getElementById('start');


								btn.addEventListener('click', () => {
								// 👇️ hide button
								btn.style.display = 'none';

								// 👇️ show div
								const box = document.getElementById('box');
								box.style.display = 'block';
								});

								var button = document.querySelector('#start');
								var container = document.querySelector('#jitsi-container');
								var api = null;

								button.addEventListener('click', () => {
									var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
									var stringLength = 30;

									function pickRandom() {
									return possible[Math.floor(Math.random() * possible.length)];
									}



									var domain = "meet.jit.si";
									var options = {
										"roomName": '<?php echo $turmaselecionada?>',
										"parentNode": container,
										"width": '100%',
										"height": '100%',

									};
									api = new JitsiMeetExternalAPI(domain, options);
								});

								</script>


				</div>
				<!-- /Chat Main Wrapper -->
					</div>
				<!-- /Add Category Modal-->
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
		
		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>

		
		<?php
  $arrLength = count($turmas);
  if ($arrLength > 1) {
    $turmaselecionada = $row0['turma'];
    ?>

<!-- Event Modal -->
<div class="modal fade" id="event_entry_modal" tabindex="1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
								<div class="modal-dialog modal-md" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<center><h5 class="modal-title" id="modalLabel">TURMA</h5></center>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">X</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="img-container">
												<div class="row">
													<div class="col-sm-12">  
														<form action ="jitsipop.php" class="form-group" method="POST">
														<label for="event_name">Escolha uma turma antes de começar uma reunião</label> <br>
														<?php for($i=0;$i<count($turmas);$i++): ?>
														<input type="radio" name="radio"
														<?php
														if (isset($turmas[$i]) && $turmas[$i]==$turmas[$i]) echo "checked"; ?>
														value="<?php echo $turmas[$i]?>"> <?php echo $turmas[$i];?> <br> <?php								
														endfor;
														
														?>
														<div class="modal-footer">
														<?php echo $turmaselecionada ?>
														<button type="submit" name="submit" class="btn btn-primary" >Confirmar</button>
													</form>
													</div>
												</div>
											</div>
										</div>
											<?php 
											if(isset($_POST['submit'])){
												if(!empty($_POST['radio'])) {
													$turmaselecionada=$_POST['radio'];
												} else {
												}
												}
											
										?>
										</div>
									</div>
								</div>
							</div>
				<!-- /Event Modal -->
				
    <!-- JavaScript code to show and hide the pop-up -->
    <script>
      $(document).ready(function() {
  
  
      $('#event_entry_modal').modal('show');
    
  });
</script>

    <?php
  }
?>
		
    </body>
	
</html>