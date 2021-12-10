# CED - Controle do Estoque Doméstico 🗃️

![MSSQL Server](https://img.shields.io/badge/Microsoft%20SQL%20Server-CC2927?style=for-the-badge&logo=microsoft%20sql%20server&logoColor=white) 

### 📃 Descrição

O objetivo do projeto é desenvolver um sistema independente que **controle o estoque de produtos domésticos** de um usuário, a partir da leitura do **código de barras** na embalagem do produto através de uma **interface web** (manualmente) ou realizando a leitura por um **aplicativo mobile**.

### 😵 Problema

Por muitas vezes, não sabemos:

* **Quais** produtos **faltam** em nossa casa;
* **Quais** produtos estão para **vencer**;
* **Quais** produtos temos **guardados**;
* **Quanto** temos de certo produto;
* **O que** está estocado há **muito tempo sem uso**;
* **Onde** certos produtos estão **localizados**.

Estas são apenas algumas indagações iniciais que podemos realizar para o nosso problema.

### 📚 Conteúdo

- **Projeto do Banco de Dados (SGBD) com MS SQL Server**
  - Projeto Conceitual
  - Projeto Lógico


### 🔨 Projeto

**1. Como armazenar os dados?**

A princípio, os dados coletados serão armazenados em um esquema de **banco de dados relacional**.

**✔️ Vantagens:**

* Garantia, a princípio, da integridade dos dados
* Esquema estruturado
* Consultas relacionais

**❌ Desvantagens:**

* Limitação para um grande número de registros a longo prazo
* Necessidade de seguir a estrutura do projeto

### ⚙ Configurando Projeto

**[1. MS SQL Sever no Docker](https://docs.microsoft.com/pt-br/sql/linux/quickstart-install-connect-docker?view=sql-server-ver15&pivots=cs1-bash)**

Execute os seguintes comandos **(PowerShell)**:

```shell
docker pull mcr.microsoft.com/mssql/server:2019-latest
```

```PowerShell
docker run -e "ACCEPT_EULA=Y" -e "SA_PASSWORD=<YourStrong@Passw0rd>" `
   -p 1433:1433 --name scc_sqlserver -h scc_sqlserver `
   -d mcr.microsoft.com/mssql/server:2019-latest
```

```shell
docker exec -it scc_sqlserver "bash"
```

```shell
/opt/mssql-tools/bin/sqlcmd -S localhost -U SA -P "<YourStrong@Passw0rd>"
```

**SQL Commands**

Ver a versão do SQL Server:

```sql
SELECT @@VERSION
GO
```

Criar o banco de dados:

```sql
CREATE DATABASE scc
GO
```

Ver os banco de dados do SGBD:

```sql
SELECT Name from sys.Databases
GO
```

Conectar-se de fora do contêiner:

```shell
sqlcmd -S localhost,1433 -U SA -P "<YourStrong@Passw0rd>"
```

