<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bancovt";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeFuncionario = $_POST["nomeFuncionario"];
    $documentoFuncionario = $_POST["documentoFuncionario"];
    $numeroCartao = $_POST["numeroCartao"];
    $saldoCartao = $_POST["saldoCartao"];
    $cnpjOperadora = $_POST["cnpjOperadora"];
    $nomeOperadora = $_POST["nomeOperadora"];

    $sql_check_operadora = "SELECT CNPJ FROM Operadora WHERE CNPJ = '$cnpjOperadora'";
    $result_operadora = $conn->query($sql_check_operadora);

    if ($result_operadora->num_rows == 0) {
        $sql_insert_operadora = "INSERT INTO Operadora (CNPJ, Nome) VALUES ('$cnpjOperadora', '$nomeOperadora')";

        if ($conn->query($sql_insert_operadora) === TRUE) {
            echo "Dados da operadora inseridos com sucesso<br>";
        } else {
            echo "Erro ao inserir dados da operadora: " . $conn->error . "<br>";
        }
    }

    $sql_check_cartao = "SELECT Numero FROM Cartao WHERE Numero = '$numeroCartao'";
    $result_cartao = $conn->query($sql_check_cartao);

    if ($result_cartao->num_rows == 0) {
        $sql_insert_cartao = "INSERT INTO Cartao (Numero, Saldo, Operadora_CNPJ) VALUES ('$numeroCartao', $saldoCartao, '$cnpjOperadora')";

        if ($conn->query($sql_insert_cartao) === TRUE) {
            echo "Dados do cartão inseridos com sucesso<br>";
        } else {
            echo "Erro ao inserir dados do cartão: " . $conn->error . "<br>";
        }
    }


    $sql_insert_funcionario = "INSERT INTO Funcionario (Documento, Nome, Cartao_id) VALUES ('$documentoFuncionario', '$nomeFuncionario', '$numeroCartao')";

    if ($conn->query($sql_insert_funcionario) === TRUE) {
        echo "Dados do funcionário inseridos com sucesso<br>";
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao inserir dados do funcionário: " . $conn->error . "<br>";
    }
}

$conn->close();
?>