# CTF-EasySQLWAF (Web题目)

****A repository to build docker image with Apache, PHP, MySQL & PHP MyAdmin****

## Installation

Clone or download the repository ***phpmysql***

```
git clone https://github.com/L-HeliantHuS/ctf-easysql -b master
```

```
echo "AddType application/x-httpd-php .html .htm" > web/src/html/.htaccess
```

```
docker-compose up -d
```

once the docker build is complete run docker ps  command and check the containers are running
```
docker ps
```
Launch the browser and go to http://localhost:8081 to open index.

Launch the broser and go to http://localhost:8080 to login to PHP MyAdmin.

## Default Values

#### <u>Apache</u>
- apache runs in port 8081
- apache /var/www/html is mapped to src/html
    
#### <u>MySQL</u>
- DB running on port 3306
- DB data folder mapped to **/db/data/**
- default root user password is **password**
- default database name is **mydb**
- default user name is **mysql**
- default user password is **mysql**
  
#### <u>PHP MyAdmin</u>
- PHP MyAdmin runs in port 8080
  
## Optional

Change the following parameters to customize the Apache & MySQL 

#### <u>Apache</u>
Modify the Dockerfile in the web folder
- EXPOSE to custom port numeber
- ADD src /var/www to custom folder

#### <u>MySQL</u>
Modify the docker-compose.yml
- modify **MYSQL_ROOT_PASSWORD** for root password
- modify **MYSQL_DATABASE** for root database name
- modify **MYSQL_USER** for db user name
- modify **MYSQL_PASSWORD** for db password