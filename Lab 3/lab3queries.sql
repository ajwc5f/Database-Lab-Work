-- A
-- A1
CREATE TABLE pilot (
	fname varchar(15),
	lname varchar(15) NOT NULL,
	license_num integer AUTO_INCREMENT PRIMARY KEY,
	birthdate datetime NOT NULL
) ENGINE = INNODB;

-- A2
CREATE TABLE plane (
	tail_num varchar(10) PRIMARY KEY,
	brand varchar(25),
	model varchar(25),
	owner_license_num integer references pilot(license_num),
	num_engines integer
) ENGINE = INNODB;

-- B
-- B1
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('Tyroil', 'Smoochie', '1995-05-09');
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('Javaris Jamar', 'Javarison', '1983-10-20');
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('Ibrahim', 'Moizoos', '1989-04-29');    
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('Xmus Jaxon', 'Flaxton', '1980-06-08');
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('Hingle', 'McCringleberry', '1985-03-27');
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('Ozamataz', 'Buckshank', '1988-10-28');    
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('Saggitariutt', 'Jefferspin', '1993-08-19');    
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('X-Wing', '@Aliciousness', '1991-05-17');
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('T.J. A.J. R.J.', 'Backslashin', '1988-12-21');
INSERT INTO pilot (fname, lname, birthdate)
	VALUES ('Dan', 'Smith', '1992-01-04');
    
-- B2
INSERT INTO plane
	VALUES ('A123', 'Boeing', '747', '1', '4');
INSERT INTO plane
	VALUES ('C453', 'Boeing', '747-400', '2', '4');
INSERT INTO plane
	VALUES ('B562', 'Boeing', '747SP', '3', '4');
INSERT INTO plane
	VALUES ('E901', 'Incom', 'T-65 X-wing', '4', '4');
INSERT INTO plane
	VALUES ('A363', 'Boeing', '757', '5', '1');
INSERT INTO plane
	VALUES ('D584', 'Boeing', '767', '6', '2');
INSERT INTO plane
	VALUES ('E236', 'Boeing', 'E-767', '7', '2');
INSERT INTO plane
	VALUES ('C445', 'Boeing', 'KC-767', '8', '2');
INSERT INTO plane
	VALUES ('B821', 'Boeing', '777', '9', '2');
INSERT INTO plane
	VALUES ('C840', 'Boeing', '787', '10', '2');
    
-- C
-- C1
SELECT brand, model FROM plane;
-- C2
SELECT lname FROM pilot 
	WHERE lname = 'Jefferspin';
-- C3
SELECT num_engines FROM plane 
	WHERE brand = 'Incom';
-- C4
SELECT birthdate FROM pilot;
-- C5
SELECT * FROM pilot;
-- C6
SELECT tail_num FROM plane;

-- D
-- D1
UPDATE plane SET num_engines = 4 
	WHERE tail_num = 'E236';
-- D2
DELETE FROM plane WHERE tail_num = 'C445';
-- D3
UPDATE pilot SET lname = 'Jones'
	WHERE fname = 'Dan';
-- D4
UPDATE plane SET brand = 'CoolPlanes'
	WHERE model = "777";
-- D5
DELETE FROM plane WHERE num_engines < 2;
