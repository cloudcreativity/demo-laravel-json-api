cd /vagrant
/usr/bin/php artisan key:generate
/usr/bin/php artisan migrate --seed
/usr/bin/php artisan passport:install
yarn
yarn run prod
