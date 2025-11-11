# SISGEA - Sistema de Gerenciamento de Eventos Acadêmicos

Sistema de banco de dados para gerenciamento de eventos acadêmicos, desenvolvido em MySQL. O sistema permite que organizadores criem eventos e participantes se inscrevam neles.

## 📋 Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Estrutura do Banco de Dados](#estrutura-do-banco-de-dados)
- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Arquivos do Projeto](#arquivos-do-projeto)
- [Views Disponíveis](#views-disponíveis)
- [Uso](#uso)
- [Estrutura das Tabelas](#estrutura-das-tabelas)

## Sobre o Projeto

O SISGEA (Sistema de Gerenciamento de Eventos Acadêmicos) é um banco de dados MySQL que gerencia eventos acadêmicos, permitindo:

- **Cadastro de usuários** com perfis de organizador ou participante
- **Criação de eventos** por organizadores
- **Inscrição de participantes** em eventos
- **Controle de vagas** e lotação de eventos
- **Consultas e relatórios** através de views predefinidas

## Estrutura do Banco de Dados

O banco de dados possui três tabelas principais:

### Tabelas

1. **USUARIOS**: Armazena informações dos usuários do sistema
2. **EVENTOS**: Armazena informações dos eventos criados
3. **INSCRICOES**: Armazena as inscrições de participantes em eventos

## Requisitos

- MySQL 5.7 ou superior (ou MariaDB 10.2 ou superior)
- MySQL Workbench (opcional, para interface gráfica)
- Acesso ao servidor MySQL

## Instalação

### 1. Clone o repositório

```bash
git clone <url-do-repositorio>
cd ETAPA\ 2
```

### 2. Execute o script de criação do banco de dados

```bash
mysql -u seu_usuario -p < bd_sisgea.sql
```

Ou no MySQL Workbench:
- Abra o arquivo `bd_sisgea.sql`
- Execute o script (Execute SQL Script)

### 3. Popule o banco com dados de exemplo

```bash
mysql -u seu_usuario -p sisgea_db < seed_sisgea.sql
```

Ou no MySQL Workbench:
- Abra o arquivo `seed_sisgea.sql`
- Execute o script

### 4. Crie as views

```bash
mysql -u seu_usuario -p sisgea_db < views_sisgea.sql
```

Ou no MySQL Workbench:
- Abra o arquivo `views_sisgea.sql`
- Execute o script

## Arquivos do Projeto

### `bd_sisgea.sql`
Script de criação do banco de dados e todas as tabelas com suas constraints, índices e relacionamentos.

### `seed_sisgea.sql`
Script de popularização do banco com dados de exemplo:
- 10 usuários (3 organizadores e 7 participantes)
- 5 eventos
- 17 inscrições distribuídas entre os eventos

### `views_sisgea.sql`
Script de criação de 12 views úteis para consultas frequentes no sistema.

## Views Disponíveis

O sistema possui 12 views predefinidas para facilitar consultas:

### 1. **EVENTOS_COM_ORGANIZADOR**
Mostra eventos com informações completas do organizador.

### 2. **EVENTOS_COM_INSCRITOS**
Mostra eventos com contagem de inscritos, vagas disponíveis e status de lotação.

### 3. **INSCRICOES_DETALHADAS**
Mostra inscrições com informações completas de usuário, evento e organizador.

### 4. **EVENTOS_FUTUROS**
Lista apenas eventos que ainda não aconteceram, ordenados por data.

### 5. **EVENTOS_PASSADOS**
Lista apenas eventos que já aconteceram, ordenados por data (mais recentes primeiro).

### 6. **ORGANIZADORES_COM_EVENTOS**
Mostra organizadores com contagem de eventos criados (futuros e passados).

### 7. **PARTICIPANTES_COM_INSCRICOES**
Mostra participantes com contagem de inscrições (futuras e passadas).

### 8. **EVENTOS_MAIS_POPULARES**
Lista eventos ordenados por número de inscritos (mais populares primeiro).

### 9. **EVENTOS_COM_VAGAS**
Mostra eventos futuros que ainda têm vagas disponíveis.

### 10. **EVENTOS_LOTADOS**
Mostra eventos que atingiram o limite de vagas.

### 11. **USUARIO_EVENTOS_INSCRITOS**
Mostra todos os eventos em que cada usuário está inscrito.

### 12. **ESTATISTICAS_GERAIS**
Mostra estatísticas gerais do sistema (total de usuários, eventos, inscrições, médias, etc.).

## Uso

### Conectar ao banco de dados

```sql
USE sisgea_db;
```

### Consultar eventos futuros

```sql
SELECT * FROM EVENTOS_FUTUROS;
```

### Consultar eventos com vagas disponíveis

```sql
SELECT * FROM EVENTOS_COM_VAGAS;
```

### Consultar estatísticas gerais

```sql
SELECT * FROM ESTATISTICAS_GERAIS;
```

### Consultar eventos de um usuário específico

```sql
SELECT * FROM USUARIO_EVENTOS_INSCRITOS 
WHERE usuario_id = 4;
```

## Estrutura das Tabelas

### Tabela USUARIOS

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | INT | Chave primária (auto incremento) |
| nome | VARCHAR(255) | Nome completo do usuário |
| email | VARCHAR(255) | Email do usuário (único) |
| senha | VARCHAR(255) | Senha criptografada |
| perfil | ENUM | Perfil: 'organizador' ou 'participante' |
| created_at | TIMESTAMP | Data de criação |
| updated_at | TIMESTAMP | Data de atualização |

### Tabela EVENTOS

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | INT | Chave primária (auto incremento) |
| titulo | VARCHAR(255) | Título do evento |
| descricao | TEXT | Descrição do evento |
| data | DATE | Data do evento |
| hora | TIME | Hora do evento |
| local | VARCHAR(255) | Local do evento |
| limite_vagas | INT | Limite de vagas (0 = ilimitado) |
| usuario_id | INT | ID do organizador (FK) |
| created_at | TIMESTAMP | Data de criação |
| updated_at | TIMESTAMP | Data de atualização |

### Tabela INSCRICOES

| Campo | Tipo | Descrição |
|-------|------|-----------|
| id | INT | Chave primária (auto incremento) |
| usuario_id | INT | ID do participante (FK) |
| evento_id | INT | ID do evento (FK) |
| created_at | TIMESTAMP | Data da inscrição |

## Relacionamentos

- **USUARIOS** → **EVENTOS**: Um usuário (organizador) pode criar vários eventos (1:N)
- **USUARIOS** → **INSCRICOES**: Um usuário pode se inscrever em vários eventos (1:N)
- **EVENTOS** → **INSCRICOES**: Um evento pode ter várias inscrições (1:N)

### Constraints

- Email único na tabela USUARIOS
- Inscrição única por usuário por evento (UNIQUE constraint)
- Cascade delete: ao deletar um usuário, seus eventos e inscrições são deletados
- Cascade delete: ao deletar um evento, suas inscrições são deletadas

## Segurança

**IMPORTANTE**: As senhas no arquivo `seed_sisgea.sql` são hashes de exemplo. Em produção:

1. Use bibliotecas de hash seguras (bcrypt, argon2)
2. Nunca armazene senhas em texto plano
3. Implemente autenticação adequada
4. Use prepared statements para prevenir SQL injection

## Dados de Exemplo

O arquivo `seed_sisgea.sql` inclui:

- **10 usuários**:
  - 3 organizadores
  - 7 participantes
  
- **5 eventos**:
  - Workshop de Desenvolvimento Web
  - Palestra sobre Inteligência Artificial
  - Evento de Networking para Desenvolvedores
  - Curso de Python para Iniciantes
  - Hackathon de Inovação

- **17 inscrições** distribuídas entre os eventos

## Autores

Este projeto está sendo desenvolvido por:

**Adriely Avelino De Castro**

**Pablo Ladeira**

**Daniel Avelar Dias Vasconcelos**

**Victor Hugo Nogueira Lima**

---

**Desenvolvido para a disciplina de Desenvolvimento Web II**

