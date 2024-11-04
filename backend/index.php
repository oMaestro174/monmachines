<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento de Máquinas</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateMachines() {
            $.ajax({
                url: 'get_machines.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#machines').empty();
                    data.forEach(function(machine) {
                        var machineHtml = '<div class="machine">' +
                            '<h2>Máquina: ' + machine.name + '</h2>' +
                            '<p>Status: ' + machine.status + '</p>' +
                            '<img src="' + machine.image_path + '" alt="' + machine.status + '" width="100">' +
                            '<hr>' +
                            '</div>';
                        $('#machines').append(machineHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao atualizar máquinas:', error);
                }
            });
        }

        $(document).ready(function() {
            updateMachines();
            setInterval(updateMachines, 5000);
        });
    </script>

<script>
        $(document).ready(function() {
            function exibirUltimaAtualizacao() {
                var agora = new Date();
                var dia = String(agora.getDate()).padStart(2, '0');
                var mes = String(agora.getMonth() + 1).padStart(2, '0');
                var ano = agora.getFullYear();
                var horas = String(agora.getHours()).padStart(2, '0');
                var minutos = String(agora.getMinutes()).padStart(2, '0');
                var segundos = String(agora.getSeconds()).padStart(2, '0');

                var dataFormatada = dia + '/' + mes + '/' + ano + ', ' + horas + ':' + minutos + ':' + segundos;

                $('#ultima-atualizacao').text('Última atualização: ' + dataFormatada);
            }

            // Executa a função imediatamente
            exibirUltimaAtualizacao();

            // Atualiza a cada segundo (1000 milissegundos)
            setInterval(exibirUltimaAtualizacao, 5000);
        });
    </script>
</head>
<body>
    <h1>Monitoramento de Máquinas DI </h1>
    <p id="ultima-atualizacao"></p>
    <div id="machines"></div>
</body>
</html>
