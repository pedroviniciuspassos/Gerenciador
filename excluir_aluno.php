<?php
// Verifica se o ID do aluno foi recebido via GET
if (isset($_GET['id'])) {
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

    // ID do aluno a ser excluído
    $id_aluno = $_GET['id'];

    // Query para excluir o aluno do banco de dados
    $sql = "DELETE FROM alunos WHERE id = $id_aluno";

    if ($conn->query($sql) === TRUE) {
        // Retorna uma resposta de sucesso
        http_response_code(200);
        echo "Aluno excluído com sucesso.";
    } else {
        // Retorna uma resposta de erro
        http_response_code(500);
        echo "Erro ao excluir aluno: " . $conn->error;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
} else {
    // Se o ID do aluno não foi recebido, retorna um erro
    http_response_code(400);
    echo "ID do aluno não fornecido.";
}
?>
