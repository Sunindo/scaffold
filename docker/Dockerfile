FROM ubuntu:20.04

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y software-properties-common

RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C
RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php

RUN apt-get update

RUN apt-get install -y apache2 libapache2-mod-php7.1
RUN apt-get install -y git php7.1-cli php7.1-curl php7.1-gd php7.1-mbstring php7.1-mysql php7.1-sqlite php7.1-xml php7.1-zip

RUN echo "Europe/London" | tee /etc/timezone
RUN dpkg-reconfigure --frontend noninteractive tzdata

COPY ./docker/common/composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

COPY ./docker/common/phpunit-7.phar /usr/local/bin/phpunit
RUN chmod +x /usr/local/bin/phpunit

RUN echo alias artisan=\"/usr/bin/php /var/www/artisan\" >> /etc/bash.bashrc

COPY ./docker/common/web/httpd.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker/common/web/php.ini /etc/php/7.1/apache2/php.ini

COPY ./docker/common/web/run.sh /root/run.sh
RUN chmod +x /root/run.sh

RUN a2enmod rewrite
RUN rm -rf /var/www/html
RUN update-rc.d -f apache2 remove

WORKDIR /var/www

EXPOSE 80

ENTRYPOINT ["/root/run.sh"]
