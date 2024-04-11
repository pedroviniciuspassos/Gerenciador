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

// Verifica se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id_aluno = $_POST["id_aluno"];
    $novo_nome = $_POST["novo_nome"];
    $novo_telefone = $_POST["novo_telefone"];
    $novo_plano = $_POST["novo_plano"];
    $novo_valor = $_POST["novo_valor"];
    $novo_dias_treino = $_POST["novo_dias_treino"];
    $nova_data_vencimento = $_POST["nova_data_vencimento"];

    // Atualiza os dados do aluno no banco de dados
    $sql = "UPDATE alunos SET nome='$novo_nome', telefone='$novo_telefone', plano='$novo_plano', valor='$novo_valor', dias_treino='$novo_dias_treino', data_vencimento='$nova_data_vencimento' WHERE id='$id_aluno'";

    if ($conn->query($sql) === TRUE) {
        // Redireciona de volta para a lista de alunos
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao editar aluno: " . $conn->error;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
