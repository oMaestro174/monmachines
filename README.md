# 🌐 **monmachines**

![status](https://img.shields.io/badge/status-Active-green)  
Monitoramento de máquinas com **PHP** e **React JS**

> **Sistema de Monitoramento de Máquinas**  
> Um sistema para monitorar o status de máquinas em tempo real, desenvolvido com PHP no backend e React no frontend. O sistema permite visualizar e atualizar o status de várias máquinas, mantendo um histórico de mudanças.

---

## 🚦 **Status das Máquinas**

O sistema suporta os seguintes status para as máquinas:

- 🟢 **Running** (Em execução)
- 🔴 **Stopped** (Parado)
- 🟠 **Maintenance** (Em manutenção)
- ⚪ **Inactive** (Inativo)
- 🟣 **Overload** (Sobrecarga)
<i class="fas fa-user" style="color: purple;"></i>

Cada status é representado por uma cor no histórico e possui uma imagem correspondente na interface principal.

---

## ⚙️ **Funcionalidades**

- Exibição em **tempo real** do status das máquinas
- **Atualização automática** a cada 5 segundos
- Atualização manual do status através de botões
- Registro de **histórico** de mudanças de status
- Exibição de **imagens correspondentes** ao status de cada máquina

---

## 🛠 **Tecnologias Utilizadas**

- **Backend**: PHP
- **Frontend**: React
- **Banco de Dados**: MySQL
- **Servidor Web**: Nginx
- **Containerização**: Docker

---

## 📁 **Estrutura do Projeto**

```plaintext
monmachines/
│
├── backend/
│   ├── conexao.php          # Conexão com o banco de dados
│   ├── get_machines.php      # Endpoint para obter o status das máquinas
│   ├── index.php             # Ponto de entrada
│   ├── update_status.php     # Atualiza o status das máquinas
│   └── status_history.php    # Histórico de status das máquinas
│
├── frontend/
│   ├── index.html            # Página principal
│   ├── js/
│   │   └── app.js            # Lógica do frontend em JavaScript
│   └── css/
│       └── global.css        # Estilos globais da aplicação
│
├── images/                   # Imagens representando status das máquinas
│   ├── inactive.png
│   ├── maintenance.png
│   ├── overload.png
│   ├── running.png
│   └── stopped.png
│
├── data/
│   └── machine_monitoring.sql # Script de inicialização do banco de dados
│
├── docker-compose.yml        # Arquivo de configuração Docker
├── Dockerfile                # Dockerfile para a aplicação
├── nginx.conf                # Configurações do Nginx
├── LICENSE                   # Licença
└── README.md                 # Este documento

```
## 📜 **Descrição dos Componentes**
### 🗄️ Banco de Dados

- Armazena informações sobre as máquinas (ID, nome, status, última atualização).
- Mantém um histórico das mudanças de status.

### 🖥️ Backend (PHP)
- get_machines.php: Busca dados das máquinas e retorna como JSON.
- update_status.php: Atualiza o status e registra no histórico.
- status_history.php: Exibe uma tabela com o histórico de status.
Configuração CSS para uma apresentação agradável.
Ordenação por ordem decrescente de data.

### 💻 Frontend (React)
- Exibe uma lista de máquinas com status e imagens correspondentes.
- Atualização automática dos dados a cada 5 segundos.
- Permite atualização manual do status das máquinas.

### 🔄 Fluxo de Dados


- O React solicita dados ao get_machines.php periodicamente.
- Ao clicar nos botões de status, o React envia uma requisição para update_status.php, que atualiza o banco de dados e retorna uma resposta.
- O React atualiza a interface com os novos dados.

### 🛠️ Configuração e Instalação

Clone este repositório para o seu servidor web local ou remoto.
```shell
git clone https://github.com/oMaestro174/monmachines.git
```
> 
>Caso não tenho o [GIT](https://git-scm.com/downloads) instalado ou se preferir,  
>você poderá baixar os arquivos diretamente do site do github em: [oMaestro174/monmachines](https://github.com/oMaestro174/monmachines/archive/refs/heads/main.zip) 

Acesse o diretório monmachines
```shell
cd monmachines
```

Rode os containers para subir o ambiente
```shell
docker-compose up -d
```
>Acesse a aplicaçao em http://localhost  
>Caso queira fazer os testes, acesse http://localhost/index.html



Para tudo funcionar precisa já ter o docker instalado e funcionando. Caso não saiba como instalar e configurar acesse aqui: [https://docs.docker.com/engine/install/](https://docs.docker.com/engine/install/)

Configure as credenciais do banco de dados no arquivo `conexao.php`, utilizado por `get_machines.php`, `update_status.php` e `status_history.php`.

Certifique-se de que o servidor web tem permissões para ler e escrever nos arquivos e diretórios do projeto.

Acesse o arquivo index.html pelo servidor web para visualizar a aplicação.

### 💻 Uso
- A página principal exibirá automaticamente o status de todas as máquinas cadastradas.
- Os status são atualizados automaticamente a cada 5 segundos.
- Use os botões "Iniciar", "Parar" e "Manutenção" para alterar manualmente o status de cada máquina.

- A data e hora da última atualização são exibidas no topo da página.
- Para visualizar o histórico de mudanças de status, acesse a página status_history.php.

### 🤝 Contribuição

Contribuições são bem-vindas! Por favor, sinta-se à vontade para submeter pull requests ou criar issues para melhorias e correções de bugs.

### 📄 Licença
Este projeto é licenciado sob a licença do [MIT](/LICENSE)