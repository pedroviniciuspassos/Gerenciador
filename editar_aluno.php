<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editarstyle.css">
    <title>Editar Aluno</title>
</head>
<body>
    <h2>Editar Aluno</h2>
    <form method="post" action="processar_edicao.php">
        <?php
        // Verifica se o ID do aluno foi passado via GET
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

            // Obtém o ID do aluno da URL
            $id_aluno = $_GET['id'];

            // Consulta SQL para obter os dados do aluno
            $sql = "SELECT * FROM alunos WHERE id = $id_aluno";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Obtém os dados do aluno
                $aluno = $result->fetch_assoc();
        ?>
        <!-- Preenche os campos do formulário com os dados do aluno -->
        <input type="hidden" id="id_aluno" name="id_aluno" value="<?php echo $aluno['id']; ?>">
        <label for="novo_nome">Novo Nome:</label><br>
        <input type="text" id="novo_nome" name="novo_nome" value="<?php echo $aluno['nome']; ?>"><br>
        <label for="novo_telefone">Novo Telefone:</label><br>
        <input type="text" id="novo_telefone" name="novo_telefone" placeholder="(__) _____-____" value="<?php echo $aluno['telefone']; ?>"><br>
        <label for="novo_plano">Novo Plano:</label><br>
        <select id="novo_plano" name="novo_plano">
            <option value="MENSAL" <?php if ($aluno['plano'] == 'MENSAL') echo 'selected'; ?>>MENSAL</option>
            <option value="TRIMESTRAL" <?php if ($aluno['plano'] == 'TRIMESTRAL') echo 'selected'; ?>>TRIMESTRAL</option>
            <option value="SEMESTRAL" <?php if ($aluno['plano'] == 'SEMESTRAL') echo 'selected'; ?>>SEMESTRAL</option>
        </select><br>
        <label for="novo_valor">Novo Valor:</label><br>
        <input type="text" id="novo_valor" name="novo_valor" value="<?php echo $aluno['valor']; ?>"><br>
        <label for="novo_dias_treino">Novos Dias de treino:</label><br>
        <select id="novo_dias_treino" name="novo_dias_treino">
            <option value="2X" <?php if ($aluno['dias_treino'] == '2X') echo 'selected'; ?>>2X por semana</option>
            <option value="3X" <?php if ($aluno['dias_treino'] == '3X') echo 'selected'; ?>>3X por semana</option>
            <option value="4X" <?php if ($aluno['dias_treino'] == '4X') echo 'selected'; ?>>4X por semana</option>
        </select><br>
        <label for="nova_data_vencimento">Nova Data de Vencimento:</label><br>
        <input type="date" id="nova_data_vencimento" name="nova_data_vencimento" value="<?php echo $aluno['data_vencimento']; ?>"><br><br>
        <?php
            } else {
                echo "Aluno não encontrado.";
            }
            // Fechar a conexão com o banco de dados
            $conn->close();
        }
        ?>
        <input type="submit" value="Editar Aluno">
    </form>
</body>
</html>
