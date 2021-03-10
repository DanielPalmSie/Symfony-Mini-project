Зайти в папку и выполнить команду docker-compose up

После чего зайти в фалик .env и в этой строке DATABASE_URL="mysql://user:root@172.22.0.3:3306/films_db?serverVersion=5.7"
поставить нужный ip. Его можно получить выполнив docker inspect "container name mysql"

--------------------------------------------------------------------------------------------------------------------------------------------------------------------
routes:

localhost:8088/classroom/list GET

localhost:8088/classroom/{id} GET

localhost:8088/classroom POST

params:
name string
isActive bool

localhost:8088/classroom/{id} PATCH

params:
name string
isActive bool

localhost:8088/classroom/{id} DELETE
