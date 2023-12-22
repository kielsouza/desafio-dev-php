<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Funcionário</title>
</head>
<body>
    <h1>Formulário de Funcionário</h1>
    <form action="form.php" method="POST">
        <label for="nomeFuncionario">Nome do Funcionário:</label>
        <input type="text" id="nomeFuncionario" name="nomeFuncionario" required><br><br>

        <label for="documentoFuncionario">Documento do Funcionário:</label>
        <input type="number" id="documentoFuncionario" name="documentoFuncionario" required><br><br>

        <label for="numeroCartao">Número do Cartão:</label>
        <input type="number" id="numeroCartao" name="numeroCartao" required><br><br>

        <label for="saldoCartao">Saldo do Cartão:</label>
        <input type="number" id="saldoCartao" name="saldoCartao" required><br><br>

        <label for="cnpjOperadora">CNPJ da Operadora:</label>
        <input type="number" id="cnpjOperadora" name="cnpjOperadora" required><br><br>

        <label for="nomeOperadora">Nome da Operadora:</label>
        <input type="text" id="nomeOperadora" name="nomeOperadora" required><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
