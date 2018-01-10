FROM php:apache

ENV DEV_MODE false

# Set the working directory to /app
WORKDIR /var/www

# SOFTWARE REQS
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y libicu-dev && \
    docker-php-ext-configure intl && \
    docker-php-ext-install intl && \
    docker-php-ext-configure opcache && \
    docker-php-ext-install opcache && \
    docker-php-ext-install pdo pdo_mysql && \
    apt-get install zip -y && \
    apt-get install git -y

# APACHE MODULES
RUN a2enmod rewrite

#Create custom PHP settings
RUN echo "c2hvcnRfb3Blbl90YWcgPSBPZmYNCnNlc3Npb24uYXV0b19zdGFydCA9IDANCmRhdGUudGltZXpvbmUgPSBBdXN0cmFsaWEvQnJpc2JhbmU=" | base64 --decode > /usr/local/etc/php/conf.d/custom.ini

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

# SET UP DEPLOYMENT KEY TO ALLOW GIT PULL
RUN  mkdir -p ~/.ssh && \
    echo "LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQ0KTUlJSktBSUJBQUtDQWdFQW9FWkc1YlJvL1QrOVVxcFh6T0JTd0dURHBweU02OE8zSHJYUHN6T2QwQTB5WFZHeA0KNGZNOU9wNTEzZlYxaW1meTJyWkFrQnBOSTBTT1g0Nmdrck91Mm1zRTJySjAxTzAzK2prQ084NU9PNysrWXptUw0KNTNqUCt0dkovVzhoNlZMQ2hnQ0VQOFBSTDljRFZhV1BOcW9OUTU4WkNSelRJNCt5bHpGNU5oQ2hTdGx6eHlUdw0KTG5ZWDBSMnlvdUJ3cGV4YjZ5UVhZRE1FNzV3bGFkL1VrcmR3TjlIRXF5OUdHSll0U2pFODNIWVoxVTVsYXVTNA0KQU0wbEZKMHY2a3JDRXdqMlY1endrenNjQUM3WWpjTURpMElBWEw1T0RBK1JrcGFVcmhKeGVTYlNqK1cvbzNjMA0KenBEYjBnVDAveHEwZVBkNHV4OTRDRXNSYVdyRWpyeEJJVm5nVTlCNW8rRDZ2b2Y1L3gxaFprelM5OEYyK2J4RQ0KZ1lsS0hOVHg5RUdmM1kzd01FVC84YktrcXZaT2YvbE5ycmg2aHVkb0xNTURIUWJyaXVZUklHMWk0L3I3ckcrLw0KS0JYTzJEU3ZlTUNGL1BCTFFDM3BhVTBheXNPdXJzdXBoWTdqTUhQR2s3cEhoSVhtRng2SUdHaUFBL0MrRFpweg0KeWJPYmQ4ZytCM3NPK29jRDF3UlZUdlRNbzBaQ0x5eGY3NFpKRkFROExOMURwRS9YQVJnTXhwTzJsc1N6L3o2Mg0KUnBTODBmMjN0R1hzaExiYXJRUXpZL3lXOGkyU3RzKzhMZURVbENIczZ2bGlYb1A4TWttTFpnaVZ6Y2dDRFlTVg0KZ3JFS0wrdEljNm16S1pzQzIwZzJ4Vk5SQS9PMG1KUmlJNm5TUmVhUXVMQTN6aXJmZ0djSGQ4c1FOWEVDQXdFQQ0KQVFLQ0FnQWRpM2JzUnlxSGJLV0l4SS8wMjNGRnVBMTgvQ1RhSFRUM2UwcHpYVk45RThHeUJDcEhYYUJ1MnVFZA0KYm04aGVYSUNNVkNMZjkyeVg2UGpKNWFnRkhGcUlBcEFDbCtSRkwyWjZjSm9wZW8wQjIrZ09PL0VyYmVoSmIwQg0KYytnTGE4OGlCcHhhYU0xNkJTZS9OUXJHWitpVUM1TUE1QWhqNk14aUpLT1VmTkpPeXZFVng5QmlzREJKd3pDMw0KNTZtOFhHckJXT0RhUWUxcUFoMi9lNXhqQTErelduN25rNHBYWSsrcldwSStqYUxMZUcwbm5FdnpFZDRCQTh6ZQ0KWXJPTjhMd0FnSlMwZjFQMUVLMm96RWN0OTVlN2dQVkFNZXFDM0RGQ09YSWpoQzJTaXlhZGlvNzRlU21jZUg5MQ0KTzBZRGVwTU40NG9yOVRLYmZTd0lwOWxWdll5bGUvY0c5OThjVFBwZTBzeThqVVovanplL0ZTUGtPY01DSGc5NQ0KdUo4bkZBNkRvRDBoQUJPRExjZU1BSHRLb08rV1VERnRPYnkxUHJXdjR3aXN3QnM5dkYyK2QrVGtxdjFZWVhybw0KK25PeVBjeWFvS09QclhTeG12NDB5OXdNbi9OS2w3ejNMOEt0N0trVGZ2UlU3a3JRaUxGenlpdDA4Witoa0JleA0KNVArSTE2bysvK1YvVklwUkRnZ0tHTDU2cTdMYzNKRWF3eG1GNFJPd3drc1o3bTd4Y1pKWlFPQVFOOTZGNktwNQ0Kd3ZXSXJDN0NsQk1yN2RydVNJWkNnZE1VbmVSVVlqcVM1VnpYUFlhV0pmQXFsNWYzM0NmVnptTUxTUGJMdVdaSw0KSytyODVlY3NtZlpsams2amJNcUt5Y2FVQkR2ZjU2Ulkwb2hSeWM3UGoyZWdSSWZNWlFLQ0FRRUF6L1J2dW9nNA0KOFB3VzNuV3FsZ3VIc2lwNEFuUUZZQmNHNlZWVnlZT09SajNVSWpIYk9HS0N4dy8xN0pIemF1azE2d3N1ODd6QQ0KQkt2eHN5MWpUb0hrNDc3THpiQUdOUDdmTVR5aHYyK2dtelpVa3F0dW81QjVZL24yNVBzYnV3cTRibXE2U0szcQ0KN3B3MElQWTRCOFRWMm5mbzFwdlVqSklzTm5MeGxxcEtsYXZOaWc5cW1hdzFHd1NPKzlUZVlTMnR3bndZT01wbg0KV3hYQ0VwYUNBbFEwNmg3MmtrRjczS3RQMC94OGM0c2Z4M3NQMnRQNDVORkZQNjdLdDJpOEYvSEtTTWduMnZjQQ0KMVlrNFNvb1ZHc3RWeUZSenloVVNNZHFZUmN4bWRpWXRBODY2b3pCcFVqNExJTENVam0xS3BoWXc3TmpNZHVxdQ0Ka2kxY2RGSFNRRkF5TndLQ0FRRUF4VTNGZEVjVC9KczAvbElvNHRxVGVZcGdSTTFYVVgrZ3B0dWZWZjh6V01qaw0KVk14UzdkeWcrL2cybWd1VENWOW9iVXEzYnVjZEFWYTBWQXBmaklTR2UrR3RqUWZhSnNoUXJuSzVaTXRxeGd6cw0KTEdSRGFIL1pPME02UXk0alpCYjMvUS9Cc2ZxZHB2MlpLYkVTTHRySFNEaEdZWDZDenRTQmx1VUxQVzBFdUkxUg0KQ01ScUc3dVlJN2RYRVFWanlJbFlFa2ptUUtsRzV4NFFLNEJrWFB1OU1iNEZCakMvY253a2lrNzltY2NOVEVpbQ0KRUtZaFdaMEhrbHVnSmE5QXIvZWMyWER3VEVKMHRTQ3psMEF5bkZMUmxyVTFhTEJyMWJSRmZNeUZMU3RJT0p2Tg0KQzhiUjVHRGFIRVZ3WjZnNlhlYlhUUDJ4UzlHT1ZaTFFPSHc2VmtLaGx3S0NBUUJMdzQyMVV3NFQxblJxaGtvcA0KTW5nMDFENDIvcGc2d3dqMGwrK1NaSWpBVktSbDlPNGVvOTFyc3dmeE1kZVNtdmJXOUpNZG9DWUJUYmZZaE8vSw0KV1k3UDN1S1h4TXJ1SWZHbEdhY0FmU1h4aHFEWGN2ZnpSWjdFYXZ5bHZrc0RJVXZDaHNYcDF0dGlKYXprV1hCZQ0KZkR0QnhqQWhpRkt2Q0U1dFpBRmEyQjRtVzVxZDh6SHVYUXhZRkpnWGJoMjdJQTVQYmpEUStBVWg3Vkp3dlQ4Tw0KcENsSEp4TEVoSEVoRzVVUThjdFJ1VjFScXlkQ25ibnZlOE1VQ1pXM3JzUGdvV29HakUzZys5N2s3WUtCdmI4aw0KclBKSzgySGdQVDhNeE14M21abTI3LyswaEd3QktwRWtzcEFSVCtRLzQ5ZXZuU1FrRm5TZjJxN1JlUTlYSGJ4Ug0KVENhUEFvSUJBRXZuMEtnY1ZEOGhndkM0c1F3ZFpSRWtRRWNYN0pqcERlaERvL2dVdHk5WUVpZmhkNklVK0VZWA0KeHdIYXBCVytBOUhRSmVQZnZCUHd4RzEwbEMvZUtGTHVqck1zS3l3eWNuKzZtVUtDMDdBZjlwaFpkbWwwamlFeg0KaXUyZmlYUVBOaGJBZ2hjendJVW5HVTZsMWNYNjJ5SVlyRk1EdGRWV2dnaUlVNXV0SGx6VjJUQVRTSE1rNTdJTg0KN2N3Wms3cnB3OTA4K0lBMTM1WTR4YVhHdmxYYmIzejhpcmhIOXM5WG5VTXNnbm92enhqaTlpaC9rV01GZTQwOQ0KL00yaXI3TkRBcS9RdUZIT1cxSDNvNy96cmNUZ1E4dkVLU2orZm0zMzdhZkdreEcramdsaFB6QmhyQXc5aW92SA0KMXllNTI4S1dkWXdrS1pwdW8yQ2VtOGF2WEU0bFVqOENnZ0VCQUl2RWowYnVwREh0UFA5TDFzOE01NFlPajlCVQ0KYW5uUHFnVkxRYWRhWmpNdlRIWjdDMll5SFE0aVN2RC9yd2FBVkhNZFMyTFBRZjJCSzBoWUREd3RlMGsrbm9MZA0KeGd3b05sKzVDZ3ZnR1F3K0VnSDJEajBmK2JxTEwzZEtlWkZpYkpURUJTbUZibkgraXdsWFM1ZThKQ2hWR1lWYQ0KeUZodDdmTWE2Y0cwUm92Wm1QT3BpNTBTTGN5WXg1cmpJS1NCL0xtZ3NreDZlR0pydFFWRlJocEtVSlR4cWZpag0KOEJjblRqYVE1UW9FTzNiZ1FjTllsN2ZPb3ZkRjdHdW5Cc2hXcWY5U2w3YmxGOWlqTUt5d2hhdlNEcER3d084Yg0KWEtQZ2VONjlzOSt6dldQZzBwVUt4QXFCRHRxT21BVXRmV09WSWtXa0w2SGJiVnJHZ3JqSDFlSXBKNjQ9DQotLS0tLUVORCBSU0EgUFJJVkFURSBLRVktLS0tLQ==" | base64 --decode > ~/.ssh/id_rsa && \
    chmod 0600 ~/.ssh/id_rsa && \
    echo "c3NoLXJzYSBBQUFBQjNOemFDMXljMkVBQUFBREFRQUJBQUFDQVFDZ1JrYmx0R2o5UDcxU3FsZk00RkxBWk1PbW5JenJ3N2NldGMrek01M1FEVEpkVWJIaDh6MDZublhkOVhXS1ovTGF0a0NRR2swalJJNWZqcUNTczY3YWF3VGFzblRVN1RmNk9RSTd6azQ3djc1ak9aTG5lTS82MjhuOWJ5SHBVc0tHQUlRL3c5RXYxd05WcFk4MnFnMURueGtKSE5Namo3S1hNWGsyRUtGSzJYUEhKUEF1ZGhmUkhiS2k0SENsN0Z2ckpCZGdNd1R2bkNWcDM5U1N0M0EzMGNTckwwWVlsaTFLTVR6Y2RoblZUbVZxNUxnQXpTVVVuUy9xU3NJVENQWlhuUENUT3h3QUx0aU53d09MUWdCY3ZrNE1ENUdTbHBTdUVuRjVKdEtQNWIramR6VE9rTnZTQlBUL0dyUjQ5M2k3SDNnSVN4RnBhc1NPdkVFaFdlQlQwSG1qNFBxK2gvbi9IV0ZtVE5MM3dYYjV2RVNCaVVvYzFQSDBRWi9kamZBd1JQL3hzcVNxOWs1LytVMnV1SHFHNTJnc3d3TWRCdXVLNWhFZ2JXTGordnVzYjc4b0ZjN1lOSzk0d0lYODhFdEFMZWxwVFJyS3c2NnV5Nm1GanVNd2M4YVR1a2VFaGVZWEhvZ1lhSUFEOEw0Tm1uUEpzNXQzeUQ0SGV3NzZod1BYQkZWTzlNeWpSa0l2TEYvdmhra1VCRHdzM1VPa1Q5Y0JHQXpHazdhV3hMUC9QclpHbEx6Ui9iZTBaZXlFdHRxdEJETmovSmJ5TFpLMno3d3Q0TlNVSWV6cStXSmVnL3d5U1l0bUNKWE55QUlOaEpXQ3NRb3Y2MGh6cWJNcG13TGJTRGJGVTFFRDg3U1lsR0lqcWRKRjVwQzRzRGZPS3QrQVp3ZDN5eEExY1E9PSBtYXJrMTk3OXNtaXRoQGdvb2dsZW1haWwuY29t" | base64 --decode > ~/.ssh/id_rsa.pub && \
    eval $(ssh-agent -s) && \
    ssh-add ~/.ssh/id_rsa && \
    git config user.email "mark1979smith@googlemail.com" && \
    git config user.name "Mark Smith" && \
    git clone git@github.com:mark1979smith/villadbay.git .

# RUN COMPOSER to generate parameters.yml file
RUN /usr/local/bin/php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    /usr/local/bin/php -r "copy('https://composer.github.io/installer.sig', 'composer-installer.sig');" && \
    /usr/local/bin/php -r "if (hash_file('SHA384', 'composer-setup.php') === trim(file_get_contents('composer-installer.sig'))) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    /usr/local/bin/php composer-setup.php && \
    /usr/local/bin/php -r "unlink('composer-setup.php');" && \
    /usr/local/bin/php -r "unlink('composer-installer.sig');" && \
    /usr/local/bin/php composer.phar update -n

# Switch back to ROOT
USER root
