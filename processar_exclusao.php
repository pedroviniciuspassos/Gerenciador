<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "alunos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura o nome do aluno a ser excluído
    $nome = $_POST["nome"];
    
    // Exclui o aluno da tabela de alunos
    $sql = "DELETE FROM alunos WHERE nome='$nome'";
    
    if ($conn->query($sql) === TRUE) {
        // Redireciona para a tela inicial (index.php)
        header("Location: index.php");
        exit(); // Certifique-se de que a execução do script seja interrompida após o redirecionamento
    } else {
        echo "Erro ao excluir aluno: " . $conn->error;
    }
    
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
