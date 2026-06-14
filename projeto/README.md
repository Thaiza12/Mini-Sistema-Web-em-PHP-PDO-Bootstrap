# 🖥️ Mini Sistema Web Responsivo

Trabalho acadêmico da disciplina de **Desenvolvimento Web**.
Sistema completo em **PHP puro + PDO + MySQL + Bootstrap 5**, com **login**, **dashboard** e **CRUD** de Clientes e Produtos.

---

## 📋 Requisitos

- **XAMPP** (recomendado) — inclui Apache + PHP + MySQL
- **PHP 8+**
- **MySQL** / MariaDB
- Navegador web (Chrome, Firefox, Edge...)

---

## 🚀 Como instalar (passo a passo)

### 1. Importar o banco de dados
1. Inicie o **XAMPP** e ligue o **Apache** e o **MySQL**.
2. Acesse o phpMyAdmin: `http://localhost/phpmyadmin`
3. Clique em **Importar** → selecione o arquivo `database/banco.sql` → **Executar**.
4. Isso cria o banco `sistema_web` com as tabelas e o usuário administrador.

### 2. Colocar o projeto na pasta htdocs
- Copie a pasta **`projeto`** para dentro de:
  - **Windows:** `C:\xampp\htdocs\`
  - **Linux:** `/opt/lampp/htdocs/`
  - **Mac:** `/Applications/XAMPP/htdocs/`

### 3. Configurar a conexão
- Abra o arquivo `config/conexao.php` e confira os dados:
  ```php
  $host   = "localhost";
  $dbname = "sistema_web";
  $user   = "root";   // padrão do XAMPP
  $senha  = "";       // padrão do XAMPP (vazio)
  ```
- No XAMPP padrão não é preciso mudar nada.

### 4. Acessar o sistema
- Abra o navegador em:
  ```
  http://localhost/projeto
  ```

---

## 🔑 Login padrão

| Campo  | Valor             |
|--------|-------------------|
| E-mail | `admin@admin.com` |
| Senha  | `123456`          |

> A senha é armazenada de forma **criptografada** com `password_hash()` e verificada com `password_verify()`.

---

## 📁 Estrutura de pastas

```
projeto/
├── config/
│   └── conexao.php          # Conexão PDO com o MySQL
├── includes/
│   ├── header.php           # Cabeçalho HTML + Bootstrap
│   ├── footer.php           # Rodapé + JS do Bootstrap
│   ├── menu.php             # Navbar responsiva
│   └── verificar_login.php  # Protege as páginas internas
├── clientes/
│   ├── listar.php           # Listar + pesquisar
│   ├── cadastrar.php        # Cadastrar
│   ├── editar.php           # Editar
│   └── excluir.php          # Excluir
├── produtos/
│   ├── listar.php
│   ├── cadastrar.php
│   ├── editar.php
│   └── excluir.php
├── assets/
│   ├── css/style.css        # Estilos personalizados
│   └── js/script.js         # Confirmação de exclusão
├── database/
│   └── banco.sql            # Script do banco (importar no phpMyAdmin)
├── login.php                # Tela de login
├── logout.php               # Encerra a sessão
├── index.php                # Dashboard (página inicial)
└── README.md
```

---

## ✨ Funcionalidades

- ✅ **Login** com sessão PHP e senha criptografada
- ✅ **Dashboard** com cards: total de clientes, total de produtos, usuário logado e data atual
- ✅ **CRUD de Clientes** (cadastrar, listar, editar, excluir, pesquisar)
- ✅ **CRUD de Produtos** (cadastrar, listar, editar, excluir, pesquisar)
- ✅ **Layout 100% responsivo** (celular, tablet, notebook e desktop)
- ✅ **Logout** e proteção de todas as páginas internas

---

## 🔒 Segurança aplicada

- **PDO + Prepared Statements** em todas as consultas (evita SQL Injection)
- **password_hash()** para gravar a senha
- **password_verify()** para validar o login
- **session_start()** para controlar o acesso
- **Controle de acesso** com `verificar_login.php` em todas as páginas internas

---

## 🛠️ Tecnologias utilizadas

- PHP 8+ (puro, sem frameworks)
- PDO
- MySQL / MariaDB
- Bootstrap 5 (via CDN)
- Bootstrap Icons (via CDN)
- HTML5 / CSS3 / JavaScript

---

*Projeto desenvolvido para fins acadêmicos.*
