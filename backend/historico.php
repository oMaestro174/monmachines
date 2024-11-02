<?php
// status_history.php

// Conexão com o banco de dados
include_once('conexao.php');

// Configurações de paginação
$registros_por_pagina = 20;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_atual - 1) * $registros_por_pagina;

// Consulta para contar o total de registros
$sql_count = "SELECT COUNT(*) as total FROM status_history";
$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_registros = $row_count['total'];
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Consulta para obter os registros da página atual
$sql = "SELECT sh.*, m.name as machine_name 
        FROM status_history sh 
        JOIN machines m ON sh.machine_id = m.id 
        ORDER BY sh.changed_at DESC 
        LIMIT $offset, $registros_por_pagina";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Status das Máquinas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .status-running { color: green; }
        .status-stopped { color: red; }
        .status-maintenance { color: orange; }
        .status-inactive { color: gray; }
        .status-overload { color: purple; }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a, .pagination span {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }
        .pagination a:hover:not(.active) {background-color: #ddd;}
    </style>
</head>
<body>
    <h2>Histórico de Status das Máquinas</h2>
    <table>
        <tr>
            <th>Máquina</th>
            <th>Status</th>
            <th>Data/Hora da Mudança</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["machine_name"]) . "</td>";
                echo "<td class='status-" . $row["status"] . "'>" . htmlspecialchars($row["status"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["changed_at"]) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhum registro encontrado</td></tr>";
        }
        ?>
    </table>
    
    <div class="pagination">
        <?php
        $range = 2;
        
        if ($pagina_atual > 1) {
            echo "<a href='?pagina=1'>&laquo; Primeira</a>";
            echo "<a href='?pagina=" . ($pagina_atual - 1) . "'>Anterior</a>";
        }
        
        for ($i = max(1, $pagina_atual - $range); $i <= min($total_paginas, $pagina_atual + $range); $i++) {
            if ($i == $pagina_atual) {
                echo "<span class='active'>$i</span>";
            } else {
                echo "<a href='?pagina=$i'>$i</a>";
            }
        }
        
        if ($pagina_atual < $total_paginas) {
            echo "<a href='?pagina=" . ($pagina_atual + 1) . "'>Próxima</a>";
            echo "<a href='?pagina=$total_paginas'>Última &raquo;</a>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>