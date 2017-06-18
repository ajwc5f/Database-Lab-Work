-- Aren Wells Lab 4

-- Drop Table Statements

DROP TABLE IF EXISTS doctor;
DROP TABLE IF EXISTS building;
DROP TABLE IF EXISTS office;
DROP TABLE IF EXISTS insurance;
DROP TABLE IF EXISTS _condition;
DROP TABLE IF EXISTS labwork;
DROP TABLE IF EXISTS patient_conditions;
DROP TABLE IF EXISTS doctor_appts;
DROP TABLE IF EXISTS patient;

-- Create Table Statements

CREATE TABLE building (
	bname varchar(25),
	address varchar(50),
	city varchar(30),
	state varchar(25),
	zipcode integer,
	PRIMARY KEY (address, zipcode)
) ENGINE = INNODB;

CREATE TABLE office (
	room_num integer,
    waiting_room_cap integer,
    building_addr varchar(50) REFERENCES building(address),
    building_zip integer REFERENCES building(zipcode),
    PRIMARY KEY (room_num, building_addr, building_zip)
) ENGINE = INNODB;

CREATE TABLE doctor (
	med_license_num integer,
	fname varchar(25),
    lname varchar(25),
    office_num integer,
    building_addr varchar(50),
    building_zip integer,
    FOREIGN KEY (office_num, building_addr, building_zip) 
		REFERENCES office(room_num, building_addr, building_zip),
    PRIMARY KEY (med_license_num)
) ENGINE = INNODB;

CREATE TABLE patient (
	ssn varchar(11),
	fname varchar(25),
    lname varchar(25),
    PRIMARY KEY (ssn)
) ENGINE = INNODB;

CREATE TABLE insurance (
	policy_num integer,
    insurer varchar(30),
    recipient_ssn varchar(11),
    FOREIGN KEY (recipient_ssn) REFERENCES patient(ssn) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE _condition (
	icd10 varchar(15),
    description varchar(150),
    PRIMARY KEY (icd10)
) ENGINE = INNODB;

CREATE TABLE labwork (
	test_name varchar(30),
    test_timestamp timestamp,
    test_value integer,
    patient_ssn varchar(11),
    FOREIGN KEY (patient_ssn) REFERENCES patient(ssn) ON DELETE CASCADE,
    PRIMARY KEY (test_name, test_timestamp)
) ENGINE = INNODB;

CREATE TABLE patient_conditions (
	person varchar(11) REFERENCES patient(ssn),
    conditions varchar(15) REFERENCES _condition(icd10),
    PRIMARY KEY (person, conditions)
) ENGINE = INNODB;

CREATE TABLE doctor_appts (
	doctor integer REFERENCES doctor(med_license_num),
    patients varchar(11) REFERENCES patient(ssn),
    appt_time timestamp,
    appt_date date,
    PRIMARY KEY (doctor, patients)
) ENGINE = INNODB;
    
-- INSERT statements 

INSERT INTO building 
VALUES('Tucker','612 Hitt St','Columbia','Missouri','65211');
INSERT INTO building 
VALUES('Lafferre','416 S 6th St','Columbia','Missouri','65211');
INSERT INTO building 
VALUES('EBW','411 S 6th St','Columbia','Missouri','65211');

INSERT INTO office 
VALUES(101,50,'612 Hitt St','65211');
INSERT INTO office 
VALUES(214,75,'416 S 6th St','65211');
INSERT INTO office 
VALUES(119,25,'411 S 6th St','65211');

INSERT INTO doctor
VALUES(1,'Aren','Wells', 101,'612 Hitt St','65211' );
INSERT INTO doctor 
VALUES(2,'Waxton','Flaxton', 119,'411 S 6th St','65211');
INSERT INTO doctor 
VALUES(3,'Steve','Jobs', 214,'416 S 6th St','65211');

INSERT INTO patient 
VALUES('111-22-3456','Mike','Tyson');
INSERT INTO patient 
VALUES('666-55-4321','Tom','Brady');
INSERT INTO patient 
VALUES('222-77-9898','Michael','Jordan');

INSERT INTO insurance 
VALUES(112233445,'Blue Cross Blue Shield','111-22-3456');
INSERT INTO insurance 
VALUES(556677889,'Statefarm','666-55-4321');
INSERT INTO insurance 
VALUES(987654321,'Progressive','222-77-9898');

INSERT INTO _condition 
VALUES('S01.102','Unspecified open wound of left eyelid and periocular area');
INSERT INTO _condition 
VALUES('T33.019','Superficial frostbite of unspecified ear');
INSERT INTO _condition 
VALUES('R73.02','Impaired glucose tolerance (oral)');

INSERT INTO labwork 
VALUES('Blood Test','2015-08-26 03:38:19',59,'111-22-3456');
INSERT INTO labwork 
VALUES('HIV Test','2012-12-19 10:15:56',99,'666-55-4321');
INSERT INTO labwork 
VALUES('Stool Test','2015-09-19 01:52:22',16,'222-77-9898');

INSERT INTO patient_conditions 
VALUES('111-22-3456','S01.102');
INSERT INTO patient_conditions 
VALUES('666-55-4321','T33.019');
INSERT INTO patient_conditions 
VALUES('222-77-9898','R73.02');

INSERT INTO doctor_appts
VALUES(1,'111-22-3456','2015-08-26 02:30:00','2015-08-26');
INSERT INTO doctor_appts
VALUES(2,'666-55-4321','2012-12-19 09:30:00','2012-12-19');
INSERT INTO doctor_appts 
VALUES(3,'222-77-9898','2015-09-19 01:00:00','2015-09-19');
