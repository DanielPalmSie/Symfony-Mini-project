Добавьте пустую папку в корне проекта mysql

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

SQL queries


a) SELECT f.name, phone.phone FROM firm f left join
(select firm_id, MAX(phone) as phone from phone group by firm_id) phone on f.id = phone.firm_id

b) select * from
(select name, phone from firm left join phone p on firm.id = p.firm_id) r
where phone is null

c) select r.name ,count(r.phone) as count_phone from
(select name, phone from firm join phone p on firm.id = p.firm_id) r
group by r.name having count_phone >= 2;

d) select r.name ,count(r.phone) as count_phone from
(select name, phone from firm left join phone p on firm.id = p.firm_id) r
group by r.name having count_phone < 2;

e) select phones.name, max.count_phone from
(select max(r.count_phone) as count_phone from
(select r.name , count(r.phone) as count_phone from
    (select name, phone from firm left join phone p on firm.id = p.firm_id) r
group by r.name) r) max join
(select r.name , count(r.phone) as count_phone from
    (select name, phone from firm left join phone p on firm.id = p.firm_id) r
 group by r.name) phones
on max.count_phone = phones.count_phone;

---------------------------------------------------------------------------------------------------------

Я не совсем понял условие двух последних выборок ! Не могли бы вы написать две итоговых выборок что должно получиться
