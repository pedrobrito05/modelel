<?php                


session_start();
$username = 'chatapp';
$password = 'AxrkSKRDA7NmEKn8';
$dbname = 'chatapp';
$hostname = 'localhost';

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
if(!isset($_SESSION['unique_id'])){
	header("location: https://esa.ib6.pt");
}

$sql0 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if(mysqli_num_rows($sql0) > 0){
$row0 = mysqli_fetch_assoc($sql0);
} 
$turmas= array();
$turmas = explode(',',$row0['turma']);
$tosta=$turmas[0];

$event_name = $_POST['event_name'];
$event_start_date = date("y-m-d", strtotime($_POST['event_start_date'])); 
$event_end_date = date("y-m-d", strtotime($_POST['event_end_date'])); 
if(isset($_POST['poop'])){
    $id = $_POST['poop'];
}
$explosao=chunk_split($id,2,"_");
for($i=0;$i<5;$i++){
$res[$i]=$explosao[$i];

}
$tur=implode($res);
$insert_query = "insert into `calendar_event_master`(`event_name`,`event_start_date`,`event_end_date`,`turma`) values ('".$event_name."','".$event_start_date."','".$event_end_date."','".$tur."')";      

if(mysqli_query($conn, $insert_query))
{
	$data = array(
                'status' => true,
                'msg' => 'Event added successfully!'
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Sorry, Event not added.'				
            );
}
echo json_encode($data);	
$insert_query2 = "insert into `calendario_not`(`event_name`,`event_start_date`,`event_end_date`,`turma`) values ('".$event_name."','".$event_start_date."','".$event_end_date."','".$tur."')";       
mysqli_query($conn, $insert_query2);






?>
