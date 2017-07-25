-- create user for mysql
CREATE USER 'osuweb'@'%' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'osuweb'@'%' WITH GRANT OPTION;

-- reload mysql users
FLUSH PRIVILEGES;
