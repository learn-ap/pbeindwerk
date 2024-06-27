# Install Dependencies

composer install

# NPM Dependencies

npm install
npm run dev

# Wijzig .env.example naar .env en zorg dat er een connectie is met je database

APP_URL=http://localhost/eindwerklaravel/public

Zorg voor je eigen mollie api key

# Generate Applicatie Key

php artisan key:generate

# Run Migrations en Seeder

php artisan migrate:fresh --seed
#   p b e i n d w e r k  
 