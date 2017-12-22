FROM php:apache

ENV DEV_MODE false

# Set the working directory to /app
WORKDIR /var/www

COPY . /var/www

# SOFTWARE REQS
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y libicu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    docker-php-ext-configure opcache && \
    docker-php-ext-install opcache && \
    apt-get install zip -y && \
    apt-get install git -y

# APACHE MODULES
RUN a2enmod rewrite

#Create custom PHP settings
RUN echo "c2hvcnRfb3Blbl90YWc9T2Zm" | base64 --decode > /usr/local/etc/php/conf.d/custom.ini

# EDIT vhost
RUN echo "PFZpcnR1YWxIb3N0ICo6ODA+DQoNCiAgICBEb2N1bWVudFJvb3QgL3Zhci93d3cvaHRtbA0KICAgIDxEaXJlY3RvcnkgL3Zhci93d3cvaHRtbD4NCiAgICAgICAgQWxsb3dPdmVycmlkZSBOb25lDQogICAgICAgIE9yZGVyIEFsbG93LERlbnkNCiAgICAgICAgQWxsb3cgZnJvbSBBbGwNCg0KICAgICAgICA8SWZNb2R1bGUgbW9kX3Jld3JpdGUuYz4NCiAgICAgICAgICAgIE9wdGlvbnMgLU11bHRpVmlld3MNCiAgICAgICAgICAgIFJld3JpdGVFbmdpbmUgT24NCiAgICAgICAgICAgIFJld3JpdGVDb25kICV7UkVRVUVTVF9GSUxFTkFNRX0gIS1mDQogICAgICAgICAgICBSZXdyaXRlUnVsZSBeKC4qKSQgaW5kZXgucGhwIFtRU0EsTF0NCiAgICAgICAgPC9JZk1vZHVsZT4NCiAgICA8L0RpcmVjdG9yeT4NCg0KICAgICMgdW5jb21tZW50IHRoZSBmb2xsb3dpbmcgbGluZXMgaWYgeW91IGluc3RhbGwgYXNzZXRzIGFzIHN5bWxpbmtzDQogICAgIyBvciBydW4gaW50byBwcm9ibGVtcyB3aGVuIGNvbXBpbGluZyBMRVNTL1Nhc3MvQ29mZmVlU2NyaXB0IGFzc2V0cw0KICAgICMgPERpcmVjdG9yeSAvdmFyL3d3dy9wcm9qZWN0Pg0KICAgICMgICAgIE9wdGlvbnMgRm9sbG93U3ltbGlua3MNCiAgICAjIDwvRGlyZWN0b3J5Pg0KDQogICAgIyBvcHRpb25hbGx5IGRpc2FibGUgdGhlIFJld3JpdGVFbmdpbmUgZm9yIHRoZSBhc3NldCBkaXJlY3Rvcmllcw0KICAgICMgd2hpY2ggd2lsbCBhbGxvdyBhcGFjaGUgdG8gc2ltcGx5IHJlcGx5IHdpdGggYSA0MDQgd2hlbiBmaWxlcyBhcmUNCiAgICAjIG5vdCBmb3VuZCBpbnN0ZWFkIG9mIHBhc3NpbmcgdGhlIHJlcXVlc3QgaW50byB0aGUgZnVsbCBzeW1mb255IHN0YWNrDQogICAgPERpcmVjdG9yeSAvdmFyL3d3dy9odG1sL2J1bmRsZXM+DQogICAgICAgIDxJZk1vZHVsZSBtb2RfcmV3cml0ZS5jPg0KICAgICAgICAgICAgUmV3cml0ZUVuZ2luZSBPZmYNCiAgICAgICAgPC9JZk1vZHVsZT4NCiAgICA8L0RpcmVjdG9yeT4NCiAgICBFcnJvckxvZyAgJHtBUEFDSEVfTE9HX0RJUn0vZXJyb3IubG9nDQogICAgQ3VzdG9tTG9nICR7QVBBQ0hFX0xPR19ESVJ9L2FjY2Vzcy5sb2cgY29tYmluZWQNCjwvVmlydHVhbEhvc3Q+" | base64 --decode > /etc/apache2/sites-enabled/000-default.conf

# Create Deployment User and group
# Change Apache User from www-data to deployuser
RUN groupadd deploygroup && \
    adduser --disabled-password --gecos ""  --ingroup deploygroup deployuser && \
    chgrp deploygroup /var/www -R && \
    chown deployuser /var/www -R && \
    sed -i 's/${APACHE_RUN_USER:=www-data}/${APACHE_RUN_USER:=deployuser}/g' /etc/apache2/envvars && \
    sed -i 's/${APACHE_RUN_GROUP:=www-data}/${APACHE_RUN_GROUP:=deploygroup}/g' /etc/apache2/envvars

# Change owner to avoid running as root
USER deployuser

# RUN COMPOSER to generate parameters.yml file
RUN /usr/local/bin/php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    /usr/local/bin/php -r "copy('https://composer.github.io/installer.sig', 'composer-installer.sig');" && \
    /usr/local/bin/php -r "if (hash_file('SHA384', 'composer-setup.php') === trim(file_get_contents('composer-installer.sig'))) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    /usr/local/bin/php composer-setup.php && \
    /usr/local/bin/php -r "unlink('composer-setup.php');" && \
    /usr/local/bin/php -r "unlink('composer-installer.sig');" && \
    /usr/local/bin/php composer.phar install -n

# SET UP DEPLOYMENT KEY TO ALLOW GIT PULL
RUN  mkdir -p ~/.ssh && echo "c3NoLXJzYSBBQUFBQjNOemFDMXljMkVBQUFBREFRQUJBQUFDQVFEWTBla1hma2o1Y3BERFRUUW5tSGxzVDVUODBrbzByWUtKOW1BTmhqQ2Z4MS9Ja25RZzZTWGxUc3A2YkUzZXZnR2lwZkw5SlZqZ3pxWDVoUXhNVzdJSVd5UHpuSkxpK0hhYnE5ci9oTmtHWTUxcDBjWk5rZmNIMTJVWjM4NDBPUGhac3dpNVIxc1RZczdkZjE4eFpUdDk5SzdkZVBtSHowdFRhRDVGaFJVTWRlMXB0S2FLOCsxZEkwZHExL1psKzRvekZKWkhhQUkySWluN3A5SWFDaFdWREY0dm1kRmd1RXErczl4Z05LeER4Z0hXUExRSUhKU1M0NTBDeVFSdFV5S04rMGxOdit4ak5oYmY5N2NFTFkrc2JKSVh6N0doQ2xCSFJKU3o2RE5wWEkwQkZzY29ydVZjRkNidlVEeXlUS3c2SkkyNXVTMDM5d1BDVzFvT2dnbTl3RGQrZVcxandleXhzMWNKMDA1b0xxcWdHQ0NOUEZRcW9acHVUbzJEb3hNcllTVk42b2lNUXNBbEorYnpIaW1OTzRkQzVVcU5RYUliSkdQY25wcVBQd3Rnc1lrdDNQSENQdFFpNWtjcFh4VGc1a2lTdnRiaCs4b1R4emtjSWppTjZSZlU5N0tIS0Z3QW96dDRXMm96akR6NVgyd2lXbWpxNGJqMXlQdCsxWDdVbFR4WXlIL0kxbWg2S2dHdlY3dzdUTXBwcXlPUklGb1lubVVxZmpuNm5SMmp5UjRjei9JcHAvR05BRjVGOXlXY2MxdEpSS1Z0N0tHRGNiaUpPenUxN0ZNNVNXYll0U1dLcFRUTHcwR3BQUllqWDJ0anZIbWZ6bnZxRVlyM1lFK3U5djV5M0I2QmJERVZ3NEpYdmNUMEZDQlZxZU1YOHA1d2VrdVd0bWxhaHc9PSBtYXJrMTk3OXNtaXRoQGdvb2dsZW1haWwuY29tDQo=" | base64 --decode > ~/.ssh/id_rsa.pub

# Switch back to ROOT
USER root
