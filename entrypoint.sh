#!/usr/bin/env bash
#create or update db
./waitforit.sh db:3306 -t 30
/usr/local/bin/php /var/www/bin/console doctrine:migrations:migrate --no-interaction

# start apache
apache2-foreground
