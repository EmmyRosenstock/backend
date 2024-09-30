Roteiro de Execução para o Repositório API Laravel Baseado em Containers
1. Requisitos do Sistema Operacional
Este tutorial é voltado para Windows usando o PowerShell como terminal. No entanto, os passos podem ser adaptados para outros sistemas operacionais, como Linux e macOS, com pequenos ajustes nos comandos.

2. Ferramentas Necessárias
Antes de começar, certifique-se de ter as seguintes ferramentas instaladas no seu sistema:

Docker Desktop para Windows ou Linux/Mac.
Git para clonar o repositório.
Editor de texto ou IDE, como o VSCode.
3. Passo a Passo para Configuração do Ambiente



Entre na pasta do projeto:
cd api-laravel-basead-containers
3.2. Configuração de Variáveis de Ambiente
Vá até a pasta application e crie um arquivo .env a partir do .env.example:


cd application
cp .env.example .env
Edite o arquivo .env com um editor de texto, como o VSCode ou Notepad, e ajuste as variáveis do banco de dados:

env

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=Emmy
DB_USERNAME=postgres
DB_PASSWORD=postgres
Essas variáveis configuram o banco de dados PostgreSQL para rodar dentro do Docker.

3.2. Subindo os Containers com Docker
Volte para o diretório principal do projeto e execute o comando abaixo para iniciar os serviços com Docker Compose:


docker-compose up -d
Isso irá subir os containers da aplicação, Nginx, Redis e PostgreSQL.

3.3. Instalando Dependências do Laravel
Dentro do container app, instale as dependências do Composer para que o Laravel funcione corretamente:


docker-compose exec app composer install
Esse comando instalará todos os pacotes definidos no arquivo composer.json.

3.5. Gerando a Chave da Aplicação
Ainda dentro do container, execute o comando para gerar uma chave única para a aplicação Laravel:


docker-compose exec app php artisan key:generate
A chave será automaticamente adicionada ao arquivo .env.

3.6. Executando as Migrações
O próximo passo é preparar o banco de dados. Rode as migrações para criar as tabelas no PostgreSQL:


docker-compose exec app php artisan migrate
Isso criará as tabelas necessárias para o funcionamento da aplicação.

3.7. Acessando a Aplicação
Com tudo pronto, você pode acessar a aplicação no navegador:


http://localhost:8000
A aplicação estará disponível localmente rodando na porta 8000, conforme configurado no arquivo docker-compose.yml.