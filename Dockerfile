FROM zfce/base-application:latest

#Amend VHOST with correct Domains
RUN sed -i 's/##PRODUCTION_DOMAIN##/www.villadbay.com/g' /etc/apache2/sites-enabled/000-default.conf && \
    sed -i 's/##STAGING_DOMAIN##/staging.villadbay.com/g' /etc/apache2/sites-enabled/000-default.conf && \
    sed -i 's/##DEV_DOMAIN##/dev.villadbay.com/g' /etc/apache2/sites-enabled/000-default.conf

# Create custom PHP settings
RUN echo "ZGF0ZS50aW1lem9uZSA9IEF1c3RyYWxpYS9CcmlzYmFuZQo=" | base64 --decode >> /usr/local/etc/php/conf.d/custom.ini && \
    # EDIT TimeZone (through dpkg)
    ln -fs /usr/share/zoneinfo/Australia/Brisbane /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata
