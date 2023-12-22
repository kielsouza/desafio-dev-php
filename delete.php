<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir"])) {
    $documento = $_POST["documento"];
    $cnpjOperadora = $_POST["cnpjOperadora"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bancovt";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $sql_count = "SELECT COUNT(*) AS total FROM Funcionario WHERE Documento = '$documento'";
    $result_count = $conn->query($sql_count);
    $row_count = $result_count->fetch_assoc();
    $total_funcionarios = intval($row_count['total']);

    if ($total_funcionarios === 1) {
        $sql_delete_funcionario = "DELETE FROM Funcionario WHERE Documento = '$documento'";
        if ($conn->query($sql_delete_funcionario) !== TRUE) {
            echo "Erro ao excluir funcionário: " . $conn->error;
        }
    }

    $sql_count_funcionario_operadora = "SELECT COUNT(*) AS total FROM Funcionario f 
                                       INNER JOIN Cartao c ON f.Cartao_id = c.Numero 
                                       WHERE c.Operadora_CNPJ = '$cnpjOperadora' 
                                       AND f.Documento != '$documento'";
    $result_count_funcionario_operadora = $conn->query($sql_count_funcionario_operadora);
    $row_count_funcionario_operadora = $result_count_funcionario_operadora->fetch_assoc();
    $total_funcionarios_operadora = intval($row_count_funcionario_operadora['total']);

    if ($total_funcionarios_operadora === 0) {
        $sql_delete_cartao = "DELETE FROM Cartao WHERE Operadora_CNPJ = '$cnpjOperadora'";
        if ($conn->query($sql_delete_cartao) !== TRUE) {
            echo "Erro ao excluir cartão: " . $conn->error;
        }
    }

    $sql_count_operadora = "SELECT COUNT(*) AS total FROM Operadora WHERE CNPJ = '$cnpjOperadora'";
    $result_count_operadora = $conn->query($sql_count_operadora);
    $row_count_operadora = $result_count_operadora->fetch_assoc();
    $total_operadoras = intval($row_count_operadora['total']);

    if ($total_operadoras === 1) {
        $sql_delete_operadora = "DELETE FROM Operadora WHERE CNPJ = '$cnpjOperadora'";
        if ($conn->query($sql_delete_operadora) !== TRUE) {
            echo "Erro ao excluir operadora: " . $conn->error;
        }
    }

    header("Location: index.php");

    $conn->close();
}
?>
