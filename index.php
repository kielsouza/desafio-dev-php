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
    <div>
        <h2>Dados dos Funcionários</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Nome Funcionário</th>
                    <th>Documento</th>
                    <th>Número do Cartão</th>
                    <th>Saldo</th>
                    <th>Nome da Operadora</th>
                    <th>CNPJ da Operadora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "bancovt";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error);
                }

                $sql = "SELECT f.Nome AS NomeFuncionario, f.Documento, c.Numero AS NumeroCartao, c.Saldo, o.Nome AS NomeOperadora, o.CNPJ AS CNPJOperadora 
                        FROM Funcionario f
                        LEFT JOIN Cartao c ON f.Cartao_id = c.Numero
                        LEFT JOIN Operadora o ON c.Operadora_CNPJ = o.CNPJ";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["NomeFuncionario"] . "</td>";
                        echo "<td>" . $row["Documento"] . "</td>";
                        echo "<td>" . $row["NumeroCartao"] . "</td>";
                        echo "<td>" . $row["Saldo"] . "</td>";
                        echo "<td>" . $row["NomeOperadora"] . "</td>";
                        echo "<td>" . $row["CNPJOperadora"] . "</td>";
            
                        echo "<td>";
                        echo "<form action='delete.php' method='POST'>";
                        echo "<input type='hidden' name='documento' value='" . $row["Documento"] . "'>";
                        echo "<input type='hidden' name='cnpjOperadora' value='" . $row["CNPJOperadora"] . "'>";
                        echo "<button type='submit' name='excluir'>Excluir</button>";
                        echo "</form>";
                        echo "</td>";
            
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum dado encontrado</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
