# Iniciando o projeto
## Clonar o Repositório
Clone o repositório do GitHub para o seu ambiente local:

```git clone https://github.com/GabrielTFV/agenda-eletronica-vaggon-2024```

```cd seu-repositorio```
## Instalar Dependências
Certifique-se de que você tem o Composer instalado. Instale as dependências do projeto com o Composer:

```composer install```
## Configurar o Banco de Dados
Criar o Banco de Dados:

Crie um banco de dados no MySQL para o seu projeto. Você pode fazer isso usando um cliente MySQL ou via linha de comando:

```CREATE DATABASE vaggon_agenda_db;```
## Configurar as Credenciais:

Abra o arquivo de configuração do banco de dados app/Config/Database.php e atualize com as credenciais do seu banco de dados:

 ```
public $default = [
    'DSN'      => '',
    'hostname' => 'localhost',
    'username' => 'seu_usuario',
    'password' => 'sua_senha',
    'database' => 'nome_do_banco',
    'DBDriver' => 'MySQLi',
    'DBPrefix' => '',
    'pConnect' => false,
    'DBDebug'  => (ENVIRONMENT !== 'production'),
    'charset'  => 'utf8',
    'DBCollat' => 'utf8_general_ci',
    'returnType' => 'array',
    'pager' => 'CodeIgniter\Pager\View',
];
 ```

## Criar as tabelas:

Execute o comando de SQL abaixo para criar as tabelas necessárias:

```
USE vaggon_agenda_db;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    start_datetime DATETIME NOT NULL,
    end_datetime DATETIME NOT NULL,
    status ENUM('pendente', 'concluída', 'cancelada') NOT NULL DEFAULT 'pendente',
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

4. Configurar o Servidor Web
Para rodar o servidor embutido do PHP, execute o comando na raiz do projeto:

```php -S localhost:8080 -t public```

5. Acessar a Aplicação
Abra o seu navegador e acesse:

```http://localhost:8080```

Você deve ver a tela inicial da aplicação. A partir daqui, você pode se registrar, fazer login e usar as funcionalidades da agenda eletrônica.
