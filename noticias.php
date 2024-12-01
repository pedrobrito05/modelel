<?php
// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados do formulário
    $titulo = $_POST['titulo'];
    $texto = $_POST['texto'];

    // Verificar se foi enviado um arquivo
    if (isset($_FILES['img'])) {
        $img_name = $_FILES['img']['name'];
        $img_type = $_FILES['img']['type'];
        $tmp_name = $_FILES['img']['tmp_name'];

        // Pasta de destino para salvar a imagem
        $dir = "Teste/php/images/";

        // Mover o arquivo para a pasta de destino
        if (move_uploaded_file($tmp_name, $dir . $img_name)) {
            // Imagem movida com sucesso
            echo "Sucesso ao enviar a imagem.";
        }
    }

    // Conexão com o banco de dados
    $hostnamen="localhost";
    $usernamen="noticias";
    $passwordn="Benfica05";
    $databasen="noticias";
    $conn1=new mysqli($hostnamen,$usernamen,$passwordn,$databasen);

    // Verificar se a conexão ocorreu com sucesso
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
    $data="ontem";
    $criador="Elsa";
    // Inserir a notícia no banco de dados
    $sql1 = "INSERT INTO noticia (titulo, texto, imagem, criador, data) VALUES ('$titulo', '$texto', '$dir$img_name', '$criador', '$data')";
    if ($conn1->query($sql1) === TRUE) {
        echo "Notícia adicionada com sucesso.";
    } else {
        echo "Erro ao adicionar a notícia: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn1->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notícias da Escola</title>
  <style>
    /* Estilos CSS aqui */
  </style>
</head>
<body>
  <header>
    <h1>Notícias da Escola</h1>
    <!-- Navegação -->
  </header>

  <main>
    <!-- Formulário para adicionar notícia -->
    <form method="POST" enctype="multipart/form-data">
      <label for="titulo">Título:</label>
      <input type="text" id="titulo" name="titulo" required><br>

      <label for="texto">Texto:</label>
      <textarea id="texto" name="texto" required></textarea><br>

      <label for="img">Imagem:</label>
      <input type="file" id="img" name="img"><br>

      <input type="submit" value="Adicionar Notícia">
    </form>
  </main>

  <footer>
    <p>© 2023 Notícias da Escola. Todos os direitos reservados.</p>
  </footer>
</body>
</html>
