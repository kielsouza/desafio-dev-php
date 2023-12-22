<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bancovt";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$sql_funcionario = "CREATE TABLE Funcionario (
    Documento VARCHAR(20) PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL
)";

if ($conn->query($sql_funcionario) === TRUE) {
    echo "Tabela Funcionário criada com sucesso<br>";
} else {
    echo "Erro na criação da tabela Funcionário: " . $conn->error . "<br>";
}

$sql_operadora = "CREATE TABLE Operadora (
    CNPJ VARCHAR(20) PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL
)";

if ($conn->query($sql_operadora) === TRUE) {
    echo "Tabela Operadora criada com sucesso<br>";
} else {
    echo "Erro na criação da tabela Operadora: " . $conn->error . "<br>";
}

$sql_cartao = "CREATE TABLE Cartao (
    Numero VARCHAR(20) PRIMARY KEY,
    Saldo DECIMAL(10, 2) NOT NULL,
    Operadora_CNPJ VARCHAR(20),
    FOREIGN KEY (Operadora_CNPJ) REFERENCES Operadora(CNPJ)
)";

if ($conn->query($sql_cartao) === TRUE) {
    echo "Tabela Cartão criada com sucesso<br>";
} else {
    echo "Erro na criação da tabela Cartão: " . $conn->error . "<br>";
}

$sql_alter_funcionario = "ALTER TABLE Funcionario ADD COLUMN Cartao_id VARCHAR(20)";

if ($conn->query($sql_alter_funcionario) === TRUE) {
    echo "Coluna Cartao_id adicionada na tabela Funcionario com sucesso<br>";
} else {
    echo "Erro na adição da coluna Cartao_id na tabela Funcionario: " . $conn->error . "<br>";
}

$sql_fk_funcionario = "ALTER TABLE Funcionario ADD CONSTRAINT fk_cartao FOREIGN KEY (Cartao_id) REFERENCES Cartao(Numero)";

if ($conn->query($sql_fk_funcionario) === TRUE) {
    echo "Chave estrangeira adicionada na tabela Funcionario referenciando a tabela Cartao com sucesso<br>";
} else {
    echo "Erro na adição da chave estrangeira na tabela Funcionario: " . $conn->error . "<br>";
}

$conn->close();
