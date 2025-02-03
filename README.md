DESCRIÇÃO DO PROJETO------------------------------------------------------------------------
Este projeto consiste em um sistema de listagem de tarefas relacionadas a colaboradores. Ele permite o cadastro de colaboradores e tarefas, com funcionalidades de filtro e organização.

REQUISITOS DO SISTEMA-----------------------------------------------------------------------

PHP
MySQL
XAMPP (para servidor local)

INSTRUÇÕES DE INSTALAÇÃO--------------------------------------------------------------------
1 - Clonar o Repositório

Abra o terminal ou prompt de comando e execute: "git clone https://github.com/seu-usuario/seu-repositorio.git" Ou baixe o arquivo ZIP diretamente do GitHub e extraia.

2 - Mover os Arquivos

Após extrair ou clonar, mova a pasta do projeto para dentro da pasta htdocs do XAMPP: C:\xampp\htdocs\seu-projeto

3 - Configurar o Banco de Dados

Inicie o XAMPP e ative Apache e MySQL. Acesse o phpMyAdmin pelo navegador: http://localhost/phpmyadmin/

Crie um banco de dados chamado listagem-tarefas.

Importe o arquivo listagemTarefas.sql presente na pasta "database" na raiz do projeto.

No phpMyAdmin, selecione o banco de dados "listagem-tarefas". Vá para a aba Importar e escolha o arquivo listagemTarefas.sql e clique em Executar.

4 - Configurar a Conexão com o Banco

Edite o arquivo database.php e altere as credenciais conforme necessário:

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "listagem-tarefas";

5 - Executar o Projeto

Acesse o navegador e digite: "http://localhost/listagem-tarefas/" Obs: Ou pelo nome que salvar o arquivo na pasta do projeto na pasta htdocs.

FUNCIONALIDADE DA APLICAÇÃO -----------------------------------------------------------------

- Cadastro de Colaboradores
- Cadastro de Tarefas
- Filtros por prioridade, colaborador e datas de prazo
- Organização por prioridade e prazo
- Auto-complete para selecionar colaborador na tarefa

REGRAS

- Cadastro de colaborador separado do cadastro de tarefas
- Campo Responsável vinculado ao cadastro de colaboradores com auto-complete
- Data/Hora Prazo limite deve ser no mínimo 24 horas à frente da data/hora atual
- Prioridade deve conter opções: Baixa, Média e Alta
