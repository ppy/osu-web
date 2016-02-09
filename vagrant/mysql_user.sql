-- create users for mysql
CREATE USER 'osuweb'@'%' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'osuweb'@'%' WITH GRANT OPTION;

CREATE USER 'root'@'%' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;

-- reload mysql users
FLUSH PRIVILEGES;
