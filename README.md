## Desenvolvimento de um CRUD para avaliar conhecimentos com o framework Laravel.


Passos:

1 - Baixe o projeto, coloque dentro do seu servidor e execute os comandos: "composer install" e "npm install"

2 - Crie o banco de dados com o nome "supera" e configure o arquivo .env de acordo com suas definições de usuário e senha 

3 - Rode o script estados.sql e cidades.sql respectivamente dentro da base (supera) 

4 - Execute o comando: php artisan migrate --seed (Este comando criará as tabelas no banco de dados, bem como um usuário com as credenciais: admin@argon.com / secret) 

5 - Dê o start dentro da pasta do projeto (php artisan serve) 

6 - Faça login com as credenciais criadas no passo 4 

7- Crie o registro de uma empresa 

8 - Crie os registros das unidades que estão vinculadas à empresa 

9 - Após a criação das unidades, será possível criar os usuários e vinculá-los à respectiva unidade. Para isso é só clicar no botão Usuários dentro da tela que lista as unidades. 

10 - Na tela em que se lista os usuários da unidade é possível colocar os atestados para um determinado usuário. 

11 - Por fim, o contrato pode ser criado ao selecionar a empresa e preencher os dados referentes ao mesmo.

Dentro das limitações de tempo, não foi possível criar utilizando uma única tela.

