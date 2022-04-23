FROM php:7.4-apache-bullseye

RUN apt-get update && \
apt-get install -y autoconf gcc libc6 make automake wget unzip libgd-dev && \
apt clean

WORKDIR /tmp
RUN wget -O nagioscore.tar.gz https://github.com/NagiosEnterprises/nagioscore/releases/download/nagios-4.4.6/nagios-4.4.6.tar.gz && \
    wget -O nagios-plugins.tar.gz https://github.com/nagios-plugins/nagios-plugins/releases/download/release-2.4.0/nagios-plugins-2.4.0.tar.gz && \
    tar -xzf nagioscore.tar.gz && \
    tar -xzf nagios-plugins.tar.gz

# Core setup
WORKDIR /tmp/nagios-4.4.6/
RUN useradd nagios && \
    usermod -a -G nagios www-data && \
    ./configure --with-httpd-conf=/etc/apache2/sites-enabled && \
    make all && \
    make install-groups-users && \
    make install && \
    make install-init && \
    make install-commandmode && \
    make install-config && \
    make install-webconf && \
    a2enmod rewrite && \
    a2enmod cgi

#Create a strong password
ARG HTPASSWD=12-Soleil&
RUN htpasswd -bc /usr/local/nagios/etc/htpasswd.users nagiosadmin $HTPASSWD

WORKDIR /tmp/nagios-plugins-2.4.0/
RUN ./configure && \
    make && \
    make install && \
    make install-root

WORKDIR /tmp
RUN rm -rf /tmp/nagios-4.4.6 && \
    rm -rf /tmp/nagios-plugins-2.4.0 && \
    rm nagios-plugins.tar.gz && \
    rm nagioscore.tar.gz

EXPOSE 80

CMD service nagios start && apache2-foreground
