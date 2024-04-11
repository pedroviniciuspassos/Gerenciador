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

// Função para listar todos os alunos
function listarAlunos($conn) {
    $sql = "SELECT * FROM alunos ORDER BY nome ASC";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<h2>Lista de Alunos</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Nome</th><th>Telefone</th><th>Plano</th><th>Valor</th><th>Treino por semana</th><th>Data de Vencimento</th><th>Ações</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            // Verifica se a data de vencimento já passou
            if (strtotime($row["data_vencimento"]) < strtotime(date('Y-m-d'))) {
                // Se sim, adiciona a classe "vencido" ao nome do aluno
                echo "<td class='vencido'>" . $row["nome"] . "</td>";
            } else {
                // Senão, apenas exibe o nome do aluno normalmente
                echo "<td>" . $row["nome"] . "</td>";
            }
            echo "<td>" . $row["telefone"] . "</td>";
            echo "<td>" . $row["plano"] . "</td>";
            echo "<td>" . $row["valor"] . "</td>";
            echo "<td>" . $row["dias_treino"] . "</td>";
            
            // Formatação da data de vencimento para "DD-MM-AAAA"
            $dataVencimentoFormatada = date('d-m-Y', strtotime($row["data_vencimento"]));
            echo "<td>" . $dataVencimentoFormatada . "</td>";
            
            echo "<td>";
            echo "<a href='editar_aluno.php?id=" . $row["id"] . "'>Editar</a> | ";
            echo "<a href='javascript:void(0);' onclick='confirmarExclusao(" . $row["id"] . ")'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum aluno encontrado.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Lista de Alunos</title>
    <script>
        function confirmarExclusao(id) {
            if (confirm("Tem certeza de que deseja excluir este aluno?")) {
                // Requisição AJAX para excluir o aluno
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.status == 200) {
                            // Recarrega a página para atualizar a lista de alunos
                            location.reload();
                        } else {
                            console.error("Erro ao excluir aluno: " + xhr.responseText);
                        }
                    }
                };
                xhr.open("GET", "excluir_aluno.php?id=" + id, true);
                xhr.send();
            }
        }
    </script>
</head>
<body>
    <h1>Centro de Treinamento Bruno Mendes</h1>
    
    <?php listarAlunos($conn); ?>
    
    <br>
    <a href="cadastrar_aluno.php" class="button">Cadastrar Aluno</a>
<a href="registrar_pagamento.php" class="button">Receber Mensalidade</a>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
