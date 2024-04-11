<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastrarstyle.css">
    <title>Cadastrar Aluno</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>
<body>
    <h2>Cadastrar Aluno</h2>
    <form method="post" action="processar_cadastro.php">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome"><br>
        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone" placeholder="(__) _____-____">
        <script>
            $('#telefone').mask('(00) 00000-0000');
        </script><br>
        <label for="plano">Plano:</label><br>
        <select id="plano" name="plano">
            <option value="MENSAL">MENSAL</option>
            <option value="TRIMESTRAL">TRIMESTRAL</option>
            <option value="SEMESTRAL">SEMESTRAL</option>
        </select><br>
        <label for="valor">Valor:</label><br>
        <input type="text" id="valor" name="valor"><br>
        <label for="dias_treino">Dias de treino:</label><br>
        <select id="dias_treino" name="dias_treino">
            <option value="2X">2X por semana</option>
            <option value="3X">3X por semana</option>
            <option value="4X">4X por semana</option>
        </select><br>
        <label for="data_vencimento">Data de Vencimento:</label><br>
        <input type="date" id="data_vencimento" name="data_vencimento"><br><br>
        <input type="submit" value="Cadastrar Aluno">
    </form>
</body>
</html>
