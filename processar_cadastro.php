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
    // Captura os dados do formulário
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $plano = $_POST["plano"];
    $valor = $_POST["valor"];
    $dias_treino = $_POST["dias_treino"];
    $data_vencimento = $_POST["data_vencimento"];
    
    // Insere os dados na tabela de alunos
    $sql = "INSERT INTO alunos (nome, telefone, plano, valor, dias_treino, data_vencimento) 
            VALUES ('$nome', '$telefone', '$plano', '$valor', '$dias_treino', '$data_vencimento')";
    
    if ($conn->query($sql) === TRUE) {
        // Redireciona para a tela inicial (index.php)
        header("Location: index.php");
        exit(); // Certifique-se de que a execução do script seja interrompida após o redirecionamento
    } else {
        echo "Erro ao cadastrar aluno: " . $conn->error;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
