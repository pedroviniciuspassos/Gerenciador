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

// Query para obter a lista de alunos
$sql = "SELECT id, nome FROM alunos";
$result = $conn->query($sql);

// Processar o formulário de pagamento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $aluno_id = $_POST["aluno_id"];
    $tipo_pagamento = $_POST["tipo_pagamento"];

    // Determinar o número de dias com base no tipo de pagamento
    if ($tipo_pagamento == "mensal") {
        $dias_para_adicionar = 31;
    } elseif ($tipo_pagamento == "trimestral") {
        $dias_para_adicionar = 92;
    } elseif ($tipo_pagamento == "semestral") {
        $dias_para_adicionar = 184;
    }

    // Atualizar a data de vencimento
    $data_atual = date('Y-m-d');
    $nova_data_vencimento = date('Y-m-d', strtotime("+$dias_para_adicionar days", strtotime($data_atual)));

    $sql = "UPDATE alunos SET data_vencimento='$nova_data_vencimento' WHERE id='$aluno_id'";
    if ($conn->query($sql) === TRUE) {
        // Redireciona para a tela inicial (index.php)
        header("Location: index.php");
        exit(); // Certifique-se de que a execução do script seja interrompida após o redirecionamento
    } else {
        echo "Erro ao registrar pagamento: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registrarstyle.css">
    <title>Registrar Pagamento</title>
</head>
<body>
    <h1>Registrar Pagamento</h1>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="aluno">Selecione o aluno:</label>
        <select name="aluno_id" id="aluno">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum aluno encontrado</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="tipo_pagamento">Tipo de Pagamento:</label>
        <select name="tipo_pagamento" id="tipo_pagamento">
            <option value="mensal">Mensal</option>
            <option value="trimestral">Trimestral</option>
            <option value="semestral">Semestral</option>
        </select>
        <br><br>
        <input type="submit" value="Registrar Pagamento">
    </form>
</body>
</html>

<?php
// Fechar a conexão com o banco de dados
$conn->close();
?>
