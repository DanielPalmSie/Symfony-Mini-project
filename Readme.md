Зайти в папку и выполнить команду docker-compose up

После чего зайти в фалик .env и в этой строке DATABASE_URL="mysql://user:root@172.22.0.3:3306/films_db?serverVersion=5.7"
поставить нужный ip. Его можно получить выполнив docker inspect "container name mysql"