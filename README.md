## Git clone de onderste code in de gewenste locatie
git clone https://github.com/learn-ap/eindwerk-ap.git eindwerklaravel

## Install Dependencies

composer install

## NPM Dependencies

npm install
npm run dev

## Wijzig .env.example naar .env en zorg dat er een connectie is met je database

APP_URL=http://localhost/eindwerklaravel/public

Zorg voor je eigen mollie api key

## Generate Applicatie Key

php artisan key:generate

## Run Migrations en Seeder

php artisan migrate:fresh --seed

## Surf naar de volgende site:
http://localhost/eindwerklaravel/public/vineyard
#### backend
http://localhost/eindwerklaravel/public/admin
