### ELABORAÇÃO DE UM MARKETPLACE PARA PEQUENAS EMPRESAS

O presente trabalho tem como objetivo apresentar o processo de análise e desenvolvimento de um marketplace para oferecer mais uma forma de anunciar e vender produtos para os lojistas, custeado por uma pequena porcentagem no valor de suas vendas. Sua principal vantagem é que os donos de loja serão beneficiados por todas as propagandas feitas para o marketplace, o que proporcionará uma maior chance de alavancar seus negócios sem custos adicionais. 
O projeto foi  desenvolvido utilizando tecnologias gratuitas, a saber: Laravel 6 e posteriormente atualizado para a versão 8, Blade PHP, Eloquent PHP, Composer, Laragon, Php 7.4.9, sistema de banco de dados MySQL MariaDB 10.2.3, HTML 5, Bootstrap, CSS, Javascript e  PHP Storm como Idle de desenvolvimento. Como arquitetura, foi definido o padrão MVC.


**Baixe a solução em seu servidor, acesse a pasta raiz da aplicação e execute o comando**

Para simular produtos, lojas e usuários, foi utilizado o Seeder e as Factories. 
O Seeder permite definir algumas rotinas pré-configuradas que permitirão manipular o banco de dados. No caso, foram criadas duas seeds: A primeira para automatizar a criação de usuários; e a segunda para automatizar a criação de lojas e produtos.
Factory é usado durante o desenvolvimento e testes da aplicação. Ela permite a inserção de múltiplos registros aleatórios, dentro do banco de dados.
Com a utilização de ambos os recursos foram inseridos automaticamente, no banco de dados, 40 usuários, 40 lojas e 40 produtos.


**Copie a URL do repositório,** 

**Através do seu terminal, acesse a pasta do seu projeto e execute o seguinte comando:**

`git clone https://github.com/srdiegorodrigues/TCC`

**Execute o comando abaixo para acessar a nova pasta:**

 `cd TCC`

**Após isto, execute o seguinte comando para instalar as dependências do projeto:**

 `composer install`

**Copie o arquivo .env.example e renomeie o novo arquivo para .env:**

`cp .env.example .env`

**Crie a chave única da aplicação:**

`php artisan key:generate`

**Rode o comando abaixo para criar as tabelas, usuários, produtos e lojas para fins de teste**

`php artisan migrate --seed`

**Após gerar os usuários, você poderá acessar o sistema no papel de administrador com os seguintes dados**

`Nome de usuário - **Administrator`**

`email e login - **administrador@example.net`**

`senha - **password`**
