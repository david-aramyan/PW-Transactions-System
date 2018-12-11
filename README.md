Server Requirements

- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

Instructions to Deploy

- composer install
- copy .env.example to new .env
- change DB credentials in .env file
- php artisan migrate --seed
- Admin| email: admin@parrotwings.loc | password: secret