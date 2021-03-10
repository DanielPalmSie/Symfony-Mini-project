create table classroom
(
	id int auto_increment,
	name varchar(255) null,
	is_active boolean,
	date_created timestamp null,
	constraint classroom_pk
		primary key (id)
);

INSERT INTO classroom (name, is_active, date_created)
VALUES ('ClassA', true , '2018-04-01 13:00:00'),
       ('ClassB', true , '2012-03-02 14:00:00'),
       ('ClassC', false, '2011-11-15 15:00:00'),
       ('ClassD', true, '2016-02-03 16:00:00'),
       ('ClassE', true, '2020-05-13 17:00:00'),
       ('ClassF', false, '2003-12-04 18:00:00');
