FROM nimmis/apache-php7

RUN apt-get update && apt-get install nano

COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod a+x /docker-entrypoint.sh