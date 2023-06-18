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

A página inicial do projeto é a documentação da API criada via Swagger.

O primeiro passo é fazer o login para obter as credenciais. Já existe um usuário criado com o email "admin@mail.com" e senha "147258369". Basta fazer uma chamada para o endereço "api/auth/login" informando o email e a senha:
```
{
    "email": "admin@mail.com",
    "password": "147258369"
}
```
Será gerada uma chave que deverá ser usada em todas as outras chamadas a API, informando o header "Authorization: Bearer {chave}"