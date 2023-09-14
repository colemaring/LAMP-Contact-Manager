FROM mattrayner/lamp:latest-1804

WORKDIR /project
COPY . .

CMD ["/run.sh"]