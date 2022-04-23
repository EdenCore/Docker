USE testdb;
CREATE TABLE test (
	name varchar(30),
	email varchar(50)
);

INSERT INTO test (name, email)
VALUES
	('Linus','linus@sio.fr'),
	('Richard','richard@sio.fr');
	