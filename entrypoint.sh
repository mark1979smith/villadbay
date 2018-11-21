#!/usr/bin/env bash
#create or update db
./waitforit.sh <DB_HOST>:<DP_PORT> -t 30
/usr/local/bin/php /var/www/bin/console doctrine:migrations:migrate

# start apache
apache2-foreground
