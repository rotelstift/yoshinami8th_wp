FROM wordpress

COPY conf/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf
COPY certs/* /etc/ssl/private
