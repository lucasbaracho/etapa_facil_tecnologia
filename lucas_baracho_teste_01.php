<?php
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die($conn->connect_error);
}

// SQL
$sql = "
    SELECT 
        BANCO.NOME, CONVENIO.VERBA, CONTRATO.CODIGO,
        CONTRATO.DATA_INCLUSAO, CONTRATO.VALOR, CONTRATO.PRAZO
    FROM 
        TB_CONTRATO CONTRATO
    LEFT JOIN TB_CONVENIO_SERVICO CONVENIOSERV ON CONTRATO.CONVENIO_SERVICO = CONVENIOSERV.CODIGO
    LEFT JOIN TB_CONVENIO CONVENIO ON CONVENIOSERV.CONVENIO = CONVENIO.CODIGO
    LEFT JOIN TB_BANCO BANCO ON CONVENIO.BANCO = BANCO.CODIGO
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Nome do Banco</th>
                <th>Verba</th>
                <th>Código do Contrato</th>
                <th>Data de Inclusão</th>
                <th>Valor</th>
                <th>Prazo</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nome"]. "</td>
                <td>" . $row["verba"]. "</td>
                <td>" . $row["codigo"]. "</td>
                <td>" . $row["data_inclusao"]. "</td>
                <td>" . $row["valor"]. "</td>
                <td>" . $row["prazo"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "A consulta não retornou nenhum resultado.";
}

$conn->close();
?>