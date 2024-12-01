			<html>

			<?php 
session_start();
include_once "config.php";
if(!isset($_SESSION['unique_id'])){
	header("location: https://esa.ib6.pt");
}

$sql0= mysqli_query($conn, "SELECT * FROM users WHERE {$_SESSION['unique_id']} = unique_id");
if(mysqli_num_rows($sql0) > 0){
$row0 = mysqli_fetch_assoc($sql0);
} 
$turmas= array();
$turmas = explode(',',$row0['turma']);



if($row0['cargo'] != 'Aluno'):
?>

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
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				
				
				
					<div class="chat-main-row">	
						<!-- Chat Main Wrapper -->
						
						


							<div class="chat-main-wrapper">

							</div>

								<script>


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
		<?php $sql0= mysqli_query($conn, "SELECT * FROM users WHERE {$_SESSION['unique_id']} = unique_id");
  if(mysqli_num_rows($sql0) > 0){
  $row0 = mysqli_fetch_assoc($sql0);
  } 
  $turmas= array();
  $turmas = explode(',',$row0['turma']);?>
		
		<?php
  $arrLength = count($turmas);
  if ($arrLength > 1) {
    $turmaselecionada = $row0['turma'];
    ?>
<!DOCTYPE html>
<html lang="en">
<title>Alerta</title>
<!-- Event Modal -->
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				
				
				
					<div class="chat-main-row">	
						<!-- Chat Main Wrapper -->
<div class="modal fade" id="event_entry_modal" tabindex="1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
								<div class="modal-dialog modal-md" role="document">
									<div class="modal-content">
										<div class="modal-header">
										<center><h5 class="modal-title" id="modalLabel">TURMA</h5></center>
										</div>
										<div class="modal-body">
											<div class="img-container">
												<div class="row">
													<div class="col-sm-12">  
														<form action ="jitsi.php" class="form-group" method="POST">
														<label for="event_name">Você têm mais do que uma turma atribuida, escolha uma antes de começar a reunião</label> <br>
														<?php for($i=0;$i<count($turmas);$i++): ?>
														<input type="radio" name="radio"
														<?php
														if (isset($turmas[$i]) && $turmas[$i]==$turmas[$i]) echo "checked"; ?>
														value="<?php echo $turmas[$i]?>"> <?php echo $turmas[$i];?> <br> <?php								
														endfor;
														
														?>
														<div class="modal-footer">
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

<?php else: 
	header("Location: https://esa.ib6.pt/jitsi.php");
 endif; ?>
    </body>
	
</html>