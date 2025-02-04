## Teste para Desenvolvedor PHP/Laravel

Bem-vindo ao teste de desenvolvimento para a posição de Desenvolvedor PHP/Laravel.

O objetivo deste teste é desenvolver uma API Rest para o cadastro de fornecedores, permitindo a busca por CNPJ ou CPF, utilizando Laravel no backend.

## Descrição do Projeto

### Backend (API Laravel):

#### CRUD de Fornecedores:
- **Criar Fornecedor:**
    - Permita o cadastro de fornecedores usando CNPJ ou CPF, incluindo informações como nome/nome da empresa, contato, endereço, etc.
    - Valide a integridade e o formato dos dados, como o formato correto de CNPJ/CPF e a obrigatoriedade de campos.

- **Editar Fornecedor:**
    - Facilite a atualização das informações de fornecedores, mantendo a validação dos dados.

- **Excluir Fornecedor:**
    - Possibilite a remoção segura de fornecedores.

- **Listar Fornecedores:**
    - Apresente uma lista paginada de fornecedores, com filtragem e ordenação.

#### Migrations:
- Utilize migrations do Laravel para definir a estrutura do banco de dados, garantindo uma boa organização e facilidade de manutenção.

## Requisitos

### Backend:
- Implementar busca por CNPJ na [BrasilAPI](https://brasilapi.com.br/docs#tag/CNPJ/paths/~1cnpj~1v1~1{cnpj}/get) ou qualquer outro endpoint público.

## Tecnologias a serem utilizadas
- Framework Laravel (PHP) 9.x ou superior
- MySQL ou Postgres

## Critérios de Avaliação
- Adesão aos requisitos funcionais e técnicos.
- Qualidade do código, incluindo organização, padrões de desenvolvimento e segurança.
- Documentação do projeto, incluindo um README detalhado com instruções de instalação e operação.

## Bônus
- Implementação de Repository Pattern.
- Implementação de testes automatizados.
- Dockerização do ambiente de desenvolvimento.
- Implementação de cache para otimizar o desempenho.

## Entrega
- Para iniciar o teste, faça um fork deste repositório; Se você apenas clonar o repositório não vai conseguir fazer push.
- Crie uma branch com o nome que desejar;
- Altere o arquivo README.md com as informações necessárias para executar o seu teste (comandos, migrations, seeds, etc);
- Depois de finalizado, envie-nos o pull request;


## Organização do Projeto

```
Src/
│
├── User/  # Nome do Módulo
│   ├── Application/
│   │   ├── Providers/
│   │   │   └── UserServiceProvider.php
│   ├── Domain/
│   │   └── Contracts/
│   │       └── Repositories/
│   │           └── UserRepository.php  # Interface do Repositorio
│   ├── Infrastructure/
│   │   └── Eloquent/
│   │       ├── Models/
│   │       │   └── UserEloquentModel.php  # Eloquent Model
│   │       └── Repositories/
│   │           └── UserEloquentRepository.php  # Implementação do Repositório no Eloquent
│   └── Presentation/
│       └── Api/
│           ├── Controllers/
│           ├── Requests/
│           ├── Resources/
│           └── routes.php
```


## 📌 Instruções de Instalação e Operação

### 📥 Requisitos

Antes de iniciar, certifique-se de ter os seguintes itens instalados:
•	Docker e Docker Compose
•	PHP 8.2+
•	Composer
•	PostgreSQL ou MySQL (caso não use o Docker)
•	Node.js e NPM/Yarn (para frontend, se necessário)

### 🚀 Passos para Configuração

#### 1️⃣ Clonar o repositório

```
git clone URL_DO_REPOSITORIO
cd seu-repositorio
```

#### 2️⃣ Configurar as variáveis de ambiente

Copie o arquivo .env.example para .env:

```
cp .env.example .env
```

Edite o .env e configure os valores do banco de dados e outras configurações conforme necessário.

#### 3️⃣ Subir os containers com Docker

```
docker-compose up -d
```

Isso iniciará os serviços PHP, Nginx, PostgreSQL e RabbitMQ.

#### 4️⃣ Instalar dependências do Laravel

```
docker-compose exec php composer install
```

#### 5️⃣ Gerar a chave da aplicação

```
docker-compose exec php php artisan key:generate
```

#### 6️⃣ Rodar as migrations e seeders

```
docker-compose exec php php artisan migrate --seed
```

#### 7️⃣ Verificar filas do RabbitMQ

```
docker-compose exec php php artisan queue:restart
```

#### 8️⃣ Acessar a aplicação
•	API: http://localhost:9080
•	RabbitMQ UI: http://localhost:15672 (usuário: user, senha: password)

#### 9️⃣ Rodar testes

```
docker-compose exec php php artisan test
```

#### 🔄 Como Reiniciar a Aplicação

Caso precise reiniciar a aplicação, basta rodar:

```
docker-compose down && docker-compose up -d
```
