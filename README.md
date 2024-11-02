# monmachines
Monitoramento de máquinas com PHP e React JS

Sistema de Monitoramento de Máquinas

Este projeto é um sistema de monitoramento de máquinas em tempo real, desenvolvido com PHP no backend e React no frontend. Ele permite visualizar e atualizar o status de várias máquinas, mantendo um histórico de mudanças.

## Status das Máquinas

O sistema agora suporta os seguintes status para as máquinas:

- Running (Em execução)
- Stopped (Parado)
- Maintenance (Em manutenção)
- Inactive (Inativo)
- Overload (Sobrecarga)

Cada status é representado por uma cor diferente no histórico e tem uma imagem correspondente na interface principal.

## Funcionalidades

- Exibição em tempo real do status das máquinas
- Atualização automática a cada 5 segundos
- Atualização manual do status através de botões
- Registro de histórico de mudanças de status
- Exibição de imagens correspondentes ao status de cada máquina

## Tecnologias Utilizadas

- Backend: PHP
- Frontend: React
- Banco de Dados: MySQL
- Servidor Web: Nginx
- Containerização: Docker

## Estrutura do Projeto

```plaintext
projeto/
│
├── backend/
│   ├── conexao.php
│   ├── get_machines.php
│   ├── index.php
│   ├── update_status.php
│   └── status_history.php
│
├── frontend/
│   ├── index.html
│   ├── js/
│   │   └── app.js
│   └── css/
│       └── global.css
│
├── images/
│   ├── inactive.png
│   ├── maintenance.png
│   ├── overload.png
│   ├── running.png
│   └── stopped.png
│
├── data/
│   └── machine_monitoring.sql
│
├── docker-compose.yml
├── Dockerfile
├── nginx.conf
├── LICENSE
└── README.md

```


Vamos explicar de maneira simples cada passo da aplicação:

1. Banco de Dados:

1. Armazena informações sobre as máquinas (ID, nome, status, última atualização).
2. Mantém um histórico de mudanças de status.



2. Backend (PHP):

1. `get_machines.php`: Busca dados das máquinas no banco e os envia como JSON.
2. `update_status.php`: Atualiza o status de uma máquina e registra a mudança no histórico.
3. `status_history.php`: Este arquivo PHP exibe um histórico das mudanças de status das máquinas. Ele inclui:

- Uma tabela com as últimas 50 mudanças de status.
- Informações sobre a máquina, o novo status e a data/hora da mudança.
- Estilos CSS incorporados para uma apresentação visual agradável.

Para acessar o histórico:

1. Configure o arquivo `status_history.php` com as credenciais corretas do banco de dados.
2. Acesse `http://seu-servidor/status_history.php` através do navegador.

Características do histórico:

- A tabela é ordenada com as mudanças mais recentes no topo.
- Cada status é colorido de acordo (verde para 'running', vermelho para 'stopped', laranja para 'maintenance').
- O design é responsivo e se adapta a diferentes tamanhos de tela.



3. Frontend (React):

1. Exibe uma lista de máquinas com seus status e imagens correspondentes.
2. Atualiza automaticamente os dados a cada 5 segundos.
3. Permite atualização manual do status de cada máquina através de botões.
4. Mostra a data e hora da última atualização.



4. Fluxo de Dados:

1. O React solicita dados ao `get_machines.php` periodicamente.
2. Quando um botão de status é clicado, o React envia uma solicitação para `update_status.php`.
3. O PHP atualiza o banco de dados e retorna uma resposta.
4. O React atualiza a interface do usuário com os novos dados.


## Configuração e Instalação

1. Clone este repositório para o seu servidor web local ou remoto.
2. Configure as credenciais do banco de dados no arquivo (`conexao.php`) que será utilizado em (`get_machines.php`, `update_status.php`, `status_history.php`).
3. Certifique-se de que o servidor web tem permissões para ler e escrever nos arquivos e diretórios do projeto.
4. Acesse o arquivo `index.html` através do seu servidor web para visualizar a aplicação.


## Uso

- A página principal exibirá automaticamente o status de todas as máquinas cadastradas.
- Os status são atualizados automaticamente a cada 5 segundos.
- Use os botões "Iniciar", "Parar" e "Manutenção" para alterar manualmente o status de cada máquina.
- A data e hora da última atualização são exibidas no topo da página.
- Para visualizar o histórico de mudanças de status, acesse a página `status_history.php`.


## Contribuição

Contribuições são bem-vindas! Por favor, sinta-se à vontade para submeter pull requests ou criar issues para melhorias e correções de bugs.

## Licença
MIT