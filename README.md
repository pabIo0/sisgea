# Sisgea: Sistema de Gestão de Eventos e Atividades
## Visão Geral do Projeto
O **Sisgea** é um projeto desenvolvido para a disciplina de Desenvolvimento Web 2, com o objetivo de oferecer uma plataforma completa para o gerenciamento de eventos e atividades acadêmicas. O sistema permite que organizadores criem e gerenciem eventos, enquanto participantes podem se inscrever e acompanhar suas atividades. A arquitetura segue o padrão MVC (Model-View-Controller) nativo do framework Laravel, garantindo organização, segurança e escalabilidade.
## Funcionalidades Principais
### Para Todos os Usuários
*   **Autenticação**: Sistema completo de cadastro e login.
*   **Visualização de Eventos**: Página inicial com listagem de eventos disponíveis.
*   **Detalhes do Evento**: Página dedicada com informações completas sobre cada evento.
### Para Participantes
*   **Dashboard do Participante**: Área exclusiva para visualizar "Meus Eventos".
*   **Inscrição**: Facilidade para se inscrever em eventos abertos.
*   **Cancelamento**: Opção para cancelar a inscrição em eventos.
### Para Organizadores
*   **Dashboard do Organizador**: Visão geral dos eventos gerenciados.
*   **Gerenciamento de Eventos (CRUD)**: Criar, visualizar, editar e excluir eventos.
*   **Gestão de Inscritos**: Visualizar a lista de participantes inscritos em cada evento.
## Tecnologias Utilizadas
### Frontend
*   **Laravel Blade**: Motor de templates para renderização dinâmica das views.
*   **Tailwind CSS**: Framework CSS utilitário para estilização moderna e responsiva.
*   **JavaScript**: Para interações dinâmicas no cliente.
### Backend
*   **PHP 8.2+**: Linguagem base do sistema.
*   **Laravel 12**: Framework PHP robusto utilizado para toda a estrutura MVC, roteamento, autenticação e lógica de negócios.
*   **MySQL**: Banco de dados relacional para persistência das informações.
## Rotas da Aplicação
### Públicas
*   `GET /`: Página inicial (Lista de eventos).
*   `GET /login`: Formulário de login.
*   `POST /login`: Processamento do login.
*   `GET /register`: Formulário de cadastro.
*   `POST /register`: Processamento do cadastro.
### Autenticadas (Participantes e Organizadores)
*   `POST /logout`: Realizar logout.
*   `GET /meus-eventos`: Dashboard do participante.
*   `GET /events/{id}`: Detalhes do evento.
*   `POST /events/{id}/inscrever`: Realizar inscrição.
*   `DELETE /events/{id}/cancelar`: Cancelar inscrição.
### Exclusivas de Organizadores
*   `GET /organizador`: Dashboard do organizador.
*   `GET /events/{id}/inscritos`: Lista de inscritos no evento.
*   `RESOURCE /events`: Rotas CRUD completas para eventos (index, create, store, edit, update, destroy).
## Como Usar
### Pré-requisitos
*   PHP 8.2 ou superior
*   Laravel
*   Composer
*   MySQL
### Instalação
1.  **Clone o repositório:**
    ```bash
    git clone <url-do-repositorio>
    cd sisgea
    ```
2.  **Instale as dependências do backend:**
    ```bash
    composer install
    ```
3.  **Instale as dependências do frontend:**
    ```bash
    npm install
    ```
4.  **Configure o ambiente:**
    Copie o arquivo `.env.example` para o arquivo `.env`, usando o comando abaixo:
    ```bash
    copy .env.example .env
    ```
    
    E depois, configure os campos abaixo de acordo com as suas configurações locais:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sisgea_db	# Nome do banco de dados
    DB_USERNAME=root		# Seu usuário do MySQL
    DB_PASSWORD= 		    # Senha do seu banco de dados

    SESSION_DRIVER=file
    ```
5.  **Gere a chave da aplicação:**
    ```bash
    php artisan key:generate
    ```
6.  **Execute as migrações do banco de dados:**
    ```bash
    php artisan migrate
    ```
7.  **Inicie o servidor de desenvolvimento:**

    Em um terminal, inicie o servidor Laravel:
    ```bash
    php artisan serve
    ```
8.  **Acesse a aplicação:**
    Abra o navegador em `http://localhost:8000`.
