# Fullstack PHP Laravel & Vue.js - Cadastro de Usuários com Integração ViaCEP

Este é um projeto de aplicação web completa desenvolvido com Laravel (backend) e Vue.js (frontend). Ele permite o cadastro de usuários, autenticação, edição de perfil e integração com a API ViaCEP para preenchimento automático de endereços.

## Funcionalidades
- **Cadastro de Usuários:**
  - Formulário com campos de Nome, Email, Senha, CEP, Endereço, Bairro, Cidade e Estado.
  - Integração com a API ViaCEP para preenchimento automático ao digitar o CEP.

- **Controle de Acesso:**
  - Login e logout de usuários.
  - Somente usuários autenticados têm acesso à página inicial e às funcionalidades protegidas.

- **Perfil do Usuário:**
  - Visualização e edição de informações pessoais.

- **Lista de Usuários:**
  - Disponível apenas para administradores.
  - Mostra todos os usuários cadastrados na aplicação.

## Tecnologias Utilizadas
- **Backend:** Laravel 8.x ou superior.
- **Frontend:** Vue.js.
- **Banco de Dados:** MySQL ou outro banco de dados compatível.

## Requisitos
- PHP 8.x ou superior.
- Composer.
- Node.js e npm.
- MySQL.

## Configuração e Execução

### 1. Clonar o Repositório
Clone o repositório do projeto para sua máquina local:
```bash
git clone https://seu-repositorio-url
cd seu-repositorio
```

### 2. Configuração do Ambiente
Copie o arquivo `.env.example` para `.env`:
```bash
cp .env.example .env
```

### 3. Configuração do Banco de Dados
Edite o arquivo `.env` com as credenciais do seu banco de dados MySQL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

### 4. Migrar Banco de Dados
Execute as migrações para criar as tabelas:
```bash
php artisan migrate
```
Se desejar, rode também os seeds para popular o banco de dados com dados iniciais:
```bash
php artisan migrate --seed
```

### 5. Instalação de Dependências
Instale as dependências do Laravel:
```bash
composer install
```
Instale as dependências do Vue.js:
```bash
npm install
```

### 6. Gerar a Chave do Aplicativo
Gere a chave do aplicativo Laravel:
```bash
php artisan key:generate
```

### 7. Executar a Aplicação
Inicie o servidor backend:
```bash
php artisan serve
```
Por padrão, o servidor estará disponível em [http://localhost:8000](http://localhost:8000).

Inicie o servidor frontend:
```bash
npm run dev
```
Por padrão, o Vue.js estará disponível em [http://localhost:3000](http://localhost:3000).

## Utilização
- **Cadastro de Usuário:** Acesse a página de cadastro e preencha os dados. O endereço será preenchido automaticamente ao inserir o CEP.
- **Login/Logout:** Use as credenciais para acessar a aplicação. Após o login, você será redirecionado para a página inicial.
- **Perfil do Usuário:** Edite suas informações pessoais na página de perfil.
- **Lista de Usuários:** Acesse o painel administrativo para visualizar todos os usuários (apenas administradores).

## Testando a Integração com a API ViaCEP
A integração com a API ViaCEP permite preencher os campos de endereço automaticamente ao digitar o CEP no formulário de cadastro ou edição de perfil.

