FROM zfce/base-application:latest

ENV DEV_MODE false

# Create custom PHP settings
RUN echo "ZGF0ZS50aW1lem9uZSA9IEF1c3RyYWxpYS9CcmlzYmFuZQ==" | base64 --decode >> /usr/local/etc/php/conf.d/custom.ini

# EDIT vhost
RUN echo "PFZpcnR1YWxIb3N0ICo6ODA+DQoNCiAgICBEb2N1bWVudFJvb3QgL3Zhci93d3cvaHRtbA0KICAgIDxEaXJlY3RvcnkgL3Zhci93d3cvaHRtbD4NCiAgICAgICAgQWxsb3dPdmVycmlkZSBOb25lDQogICAgICAgIE9yZGVyIEFsbG93LERlbnkNCiAgICAgICAgQWxsb3cgZnJvbSBBbGwNCg0KICAgICAgICA8SWZNb2R1bGUgbW9kX3Jld3JpdGUuYz4NCiAgICAgICAgICAgIE9wdGlvbnMgLU11bHRpVmlld3MNCiAgICAgICAgICAgIFJld3JpdGVFbmdpbmUgT24NCiAgICAgICAgICAgIFJld3JpdGVDb25kICV7UkVRVUVTVF9GSUxFTkFNRX0gIS1mDQogICAgICAgICAgICBSZXdyaXRlUnVsZSBeKC4qKSQgaW5kZXgucGhwIFtRU0EsTF0NCiAgICAgICAgPC9JZk1vZHVsZT4NCiAgICA8L0RpcmVjdG9yeT4NCg0KICAgICMgdW5jb21tZW50IHRoZSBmb2xsb3dpbmcgbGluZXMgaWYgeW91IGluc3RhbGwgYXNzZXRzIGFzIHN5bWxpbmtzDQogICAgIyBvciBydW4gaW50byBwcm9ibGVtcyB3aGVuIGNvbXBpbGluZyBMRVNTL1Nhc3MvQ29mZmVlU2NyaXB0IGFzc2V0cw0KICAgICMgPERpcmVjdG9yeSAvdmFyL3d3dy9wcm9qZWN0Pg0KICAgICMgICAgIE9wdGlvbnMgRm9sbG93U3ltbGlua3MNCiAgICAjIDwvRGlyZWN0b3J5Pg0KDQogICAgIyBvcHRpb25hbGx5IGRpc2FibGUgdGhlIFJld3JpdGVFbmdpbmUgZm9yIHRoZSBhc3NldCBkaXJlY3Rvcmllcw0KICAgICMgd2hpY2ggd2lsbCBhbGxvdyBhcGFjaGUgdG8gc2ltcGx5IHJlcGx5IHdpdGggYSA0MDQgd2hlbiBmaWxlcyBhcmUNCiAgICAjIG5vdCBmb3VuZCBpbnN0ZWFkIG9mIHBhc3NpbmcgdGhlIHJlcXVlc3QgaW50byB0aGUgZnVsbCBzeW1mb255IHN0YWNrDQogICAgPERpcmVjdG9yeSAvdmFyL3d3dy9odG1sL2J1bmRsZXM+DQogICAgICAgIDxJZk1vZHVsZSBtb2RfcmV3cml0ZS5jPg0KICAgICAgICAgICAgUmV3cml0ZUVuZ2luZSBPZmYNCiAgICAgICAgPC9JZk1vZHVsZT4NCiAgICA8L0RpcmVjdG9yeT4NCiAgICBFcnJvckxvZyAgJHtBUEFDSEVfTE9HX0RJUn0vZXJyb3IubG9nDQogICAgQ3VzdG9tTG9nICR7QVBBQ0hFX0xPR19ESVJ9L2FjY2Vzcy5sb2cgY29tYmluZWQNCjwvVmlydHVhbEhvc3Q+" | base64 --decode > /etc/apache2/sites-enabled/000-default.conf

# Change owner to avoid running as root
USER deployuser

RUN printf "%s" 'Authorization: token ' > .git.token && \
    printf "%s" $GITHUB_TOKEN | base64 --decode >> .git.token && \
    CURRENT_DEPLOYMENT_KEY_ID=$( \
        curl -i -H @.git.token https://api.github.com/repos/mark1979smith/villadbay/keys | \
            grep "\"id\":" |  \
            awk '{print $2}' |  \
            sed s/,//g \
    ) && \
    mkdir -p ~/.ssh && \
    ssh-keygen -t rsa -N "" -b 4096 -C "mark1979smith@googlemail.com" -f ~/.ssh/id_rsa && \
    eval $(ssh-agent -s) && \
    ssh-add ~/.ssh/id_rsa && \
    # Create New Deployment Key
    printf "%s" '{"title": "Villa DBay Deploy Key (Write) ' >> .create-deployment-key.json && \
    echo `date` >> .create-deployment-key.json && \
    printf "%s" '", "key":"' >> .create-deployment-key.json && \
    cat ~/.ssh/id_rsa.pub | tee >> .create-deployment-key.json && \
    printf "%s"  '", "read_only": false}' >> .create-deployment-key.json && \
    curl -i -X POST -H @.git.token -d @.create-deployment-key.json https://api.github.com/repos/mark1979smith/villadbay/keys && \
    # Remove Old Deployment Key
    echo "Removing Deployment Key Id: $CURRENT_DEPLOYMENT_KEY_ID" && \
    curl -i -X DELETE -H @.git.token https://api.github.com/repos/mark1979smith/villadbay/keys/$CURRENT_DEPLOYMENT_KEY_ID && \
    rm -f .create-deployment-key.json && \
    rm -f .git.token && \
    cd  /var/www && \
    rm -rf html && \
    ssh-keyscan github.com >> ~/.ssh/known_hosts && \
    git clone git@github.com:mark1979smith/villadbay.git . && \
    git config user.email "mark1979smith@googlemail.com" && \
    git config user.name "Mark Smith"

WORKDIR /var/www

    # RUN COMPOSER to generate parameters.yml file
RUN /usr/local/bin/php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    /usr/local/bin/php -r "copy('https://composer.github.io/installer.sig', 'composer-installer.sig');" && \
    /usr/local/bin/php -r "if (hash_file('SHA384', 'composer-setup.php') === trim(file_get_contents('composer-installer.sig'))) { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    /usr/local/bin/php composer-setup.php && \
    /usr/local/bin/php -r "unlink('composer-setup.php');" && \
    /usr/local/bin/php -r "unlink('composer-installer.sig');" && \
    rm -rf /var/www/vendor && \
    /usr/local/bin/php composer.phar install -n && \
    git add -A && \
    git commit -m "[AUTO] Updates to composer installation" && \
    git push

# Switch back to ROOT
USER root
