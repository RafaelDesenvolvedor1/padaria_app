# 🚀 Plataforma de Desenvolvimento — Flutter & PHP Stack

Ambiente de desenvolvimento robusto, conteinerizado e totalmente automatizado com **Docker** e **VS Code Dev Containers**. Integra um frontend em **Flutter Web**, uma API em **PHP (Apache)** e um banco de dados **MySQL 8.0** com interface gráfica via **Adminer**.

O ambiente foi blindado contra conflitos de redes órfãs e isolamento de portas, centralizando toda a configuração em um único arquivo `.env`.

---

## 🏗️ O que o Ambiente Fornece

| Serviço | Descrição | Porta |
|---|---|---|
| **Flutter Web** | SDK configurado, pronto para compilar e servir a aplicação Web | `8085` |
| **PHP API** | Apache + PHP 8.2 com suporte nativo a PDO e CORS liberado | `8000` |
| **MariaDB 10.0** | Instância isolada dentro da rede interna do Docker | `3306` |
| **Adminer** | Interface gráfica leve para administrar o MySQL pelo navegador | `8080` |

Todos os serviços são interconectados automaticamente pela rede bridge privada `flutterdev_platform_network`.

---

## 📋 Pré-requisitos

Certifique-se de ter instalado na máquina host (Linux Debian/Mint ou Windows):

- **Docker Engine** v20.10+
- **Docker Compose V2**
- **Visual Studio Code**
- Extensão VS Code: **Dev Containers** (`ms-vscode-remote.remote-containers`)

---

## ⚙️ Configuração Inicial

Crie um arquivo `.env` na raiz do projeto com as seguintes variáveis:

```env
# Portas dos Serviços (Acesso Externo)
API_PORT=8000
ADMINER_PORT=8080
DB_PORT=3306
FLUTTER_WEB_PORT=8085

# Dados do Aplicativo Flutter
FLUTTER_APP_NAME=facul_app

# Credenciais do Banco de Dados
DB_ROOT_PASSWORD=suasenharoot
DB_DATABASE=db_plataforma
DB_USER=rafael
DB_PASSWORD=suasenhadesenvolvedor
```

> ⚠️ Nunca versione o arquivo `.env`. Adicione-o ao `.gitignore`.

---

## ▶️ Como Executar o Projeto

Siga a ordem abaixo para garantir que banco de dados e rotas de rede subam sem conflitos.

### Passo 1 — Subir a Infraestrutura de Backend

Na raiz do projeto, execute:

```bash
docker compose up -d
```

Isso inicia o banco de dados, a API PHP e o Adminer em segundo plano.

### Passo 2 — Abrir o Frontend no VS Code Dev Container

1. Abra o VS Code na pasta raiz do projeto.
2. Pressione `Ctrl + Shift + P` para abrir a paleta de comandos.
3. Selecione: **Dev Containers: Reopen in Container**.

O VS Code vai ler `.devcontainer/devcontainer.json`, limpar contêineres órfãos anteriores automaticamente via labels e inicializar o SDK do Flutter de forma limpa.

> Aguarde até o indicador **`Dev Container: Flutter...`** aparecer na barra inferior esquerda do VS Code.

### Passo 3 — Rodar o Aplicativo Flutter Web

Dentro do Dev Container, abra o terminal integrado (`Ctrl + '`) e execute:

```bash
cd $FLUTTER_APP_NAME
flutter run -d web-server --web-port=8085 --web-hostname=0.0.0.0
```

A aplicação estará disponível em `http://localhost:8085`.

---

## 🔗 Acessos Rápidos

| Serviço | URL |
|---|---|
| Flutter Web | http://localhost:8085 |
| PHP API | http://localhost:8000 |
| Adminer | http://localhost:8080 |

---

## 🛑 Parando o Ambiente

```bash
docker compose down
```

Para remover também os volumes do banco de dados:

```bash
docker compose down -v
```
