<html>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h5>Nome evento</h5>
    <input class="form-control" type="nome_evento" name="nome_evento" id="nome_evento">

    <h5>Quadrado</h5>
    <input class="form-control" type="quadrado" name="quadrado" id="quadrado">

    <button type="submit" name="submit" id="submit">SUBMETER</button>
</form>
<?php
$username10 = 'disciplinas';
$password10 = 'hj6ZkzWhkX5pCCiH';
$dbname10 = 'disciplinas';
$hostname10 = 'localhost';

$conn10 = mysqli_connect($hostname10, $username10, $password10, $dbname10);
if (!$conn10) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo "conexao funcionak";
}
if (isset($_POST['submit'])) {
    $nome_evento = mysqli_real_escape_string($conn10, $_POST['nome_evento']);
    $quadrado = mysqli_real_escape_string($conn10, $_POST['quadrado']);

    if (!empty($nome_evento) && !empty($quadrado)) {
        $insert_query = mysqli_query($conn10, "INSERT INTO disciplina (nome, quadrado) VALUES ('$nome_evento', '$quadrado')");

        if ($insert_query) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "Error: both event name and square value must be filled in.";
    }
}
?>
</html>
