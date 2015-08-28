-- create users for mysql
GRANT ALL PRIVILEGES ON *.* TO 'osuweb'@'%' IDENTIFIED BY '' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '' WITH GRANT OPTION;
-- delete all users with no username
DELETE FROM mysql.user WHERE user='';
-- reload mysql users
FLUSH PRIVILEGES;