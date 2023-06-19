## Instalação

- Requer PHP 8
- Criar arquivo .env com as configurações do banco de dados
- Baixar dependencias com comando composer install
    ```
    composer install
    ```
- Rodar migrations e seeders com comando:
    ```
    php artisan migrate --seed
    ```
- Gerar chave JWT com o comando:
    ```
    php artisan jwt:secret
    ```
- Iniciar servidor com o comando:
    ```
    php artisan serve
    ```
## Uso

A página inicial do projeto é a documentação da API criada via Swagger e explica como usar todos as funções da API.

Para usar a API é necessário fazer o login para obter as credenciais. Já existe um usuário criado com o email "admin@mail.com" e senha "147258369". Na própria página da documentação é possível fazer fazer o login de forma simplificada, seguindo dois passos:
- Clicar em "try it out" e depois em "execute" na função de login. 
- Copiar o token gerado e colar na seção de login em "authorize". 

Feito isso, é possível testar todas as outras funções da API de forma similar ao que é feito no passo 1.

Alternativamente, basta fazer uma chamada para o endereço "api/auth/login" informando o email e a senha em forma de JSON:
```
{
    "email": "admin@mail.com",
    "password": "147258369"
}
```
Da mesma forma, será gerado um token que deverá ser usada em todas as outras chamadas a API, informando o header "Authorization: Bearer {token}"