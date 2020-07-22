
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  andre
 * Created: 10/05/2020
 */
-- 
-- CREATE TABLE estudiante(
-- id_estudiante int(255) auto_increment not null,
-- codigo_estudiante varchar(100),
-- nombre1 varchar(100) not null,
-- nombre2 varchar(100),
-- nombre3 varchar(100),
-- apellido1 varchar(100) not null,
-- apellido2 varchar(100) not null,
-- fecha_nacimiento date not null,
-- fecha_inscripcion date not null,
-- email varchar(255),
-- estado enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
-- created_at datetime,
-- updated_at datetime,
-- CONSTRAINT pk_estudiante PRIMARY KEY(id_estudiante),
-- CONSTRAINT uq_codigo_estudiante UNIQUE(codigo_estudiante)
-- )ENGINE=InnoDb;
-- 
-- CREATE TABLE encargado(
-- id_encargado int(255) auto_increment not null,
-- nombre1 varchar(100),
-- nombre2 varchar(100),
-- apellido1 varchar(100),
-- apellido2 varchar(100),
-- direccion varchar(255),
-- telefono1 varchar(25),
-- telefono2 varchar(25),
-- estado enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
-- created_at datetime,
-- updated_at datetime,
-- CONSTRAINT pk_encargado PRIMARY KEY(id_encargado),
-- )ENGINE=InnoDb;
-- 
-- CREATE TABLE estudiante_encargado(
-- id_estudiante int(255) not null,
-- id_encargado int(255) not null,
-- created_at datetime,
-- updated_at datetime,
-- CONSTRAINT fk_estudiante_encargado PRIMARY KEY (id_estudiante,id_encargado),
-- CONSTRAINT fk_estudiante_encargado_estudiante FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_estudiante),
-- CONSTRAINT fk_estudiante_encargado_encargado FOREIGN KEY (id_encargado) REFERENCES encargado(id_encargado)
-- )ENGINE=InnoDb;
-- 
-- 
-- 
-- 
-- INSERT INTO `encargado`(`nombre1`, `nombre2`, `apellido1`, `apellido2`, `direccion`, `telefono1`, `telefono2`, `created_at`, `updated_at`) 
-- VALUES ('Rosa','Maria','Garrido','Guerra','Zona 18, San Rafel Buena Vista, L 3 Mz 22','24847515','41984098',curtime(),curtime());
-- 
-- INSERT INTO `estudiante_encargado`(`id_estudiante`, `id_encargado`, `created_at`, `updated_at`) VALUES (1,1,curtime(),curtime());
-- 
-- SELECT E.nombre1,EST.nombre1 FROM encargado E
-- inner join estudiante_encargado EE
-- on E.id_encargado=EE.id_encargado
-- inner join estudiante EST
-- on EST.id_estudiante=EE.id_estudiante;
-- 
-- 
-- DELIMITER $$
-- CREATE TRIGGER TG_ENCARGADO_CREARUSUARIO
-- AFTER INSERT ON encargado
-- FOR EACH ROW
-- BEGIN
-- IF(NEW.usuario LIKE 1) THEN
--     INSERT INTO USERS (name,email,email_verified_at,password,created_at,updated_at)
--     VALUES(concat(NEW.nombre1,NEW.apellido1),NEW.email,now(),123,now(),now());
-- 
--     UPDATE ENCARGADO SET USER_ID=NEW.ID WHERE ID LIKE NEW.ID;
-- END IF;
-- END$$
-- DELIMITER ;
-- 
-- DELIMITER $$
-- CREATE TRIGGER TG_ENCARGADO_CREARUSUARIODESPUES
-- AFTER UPDATE ON encargado
-- FOR EACH ROW
-- BEGIN
-- IF(NEW.usuario LIKE 1 AND OLD.usuario LIKE 0) THEN
--     INSERT INTO USERS (name,email,email_verified_at,password,created_at,updated_at)
--     VALUES(concat(NEW.nombre1,NEW.apellido1),NEW.email,now(),123,now(),now());
-- 
--     UPDATE ENCARGADO SET USER_ID=NEW.ID WHERE ID LIKE NEW.ID;
-- END IF;
-- END$$
-- DELIMITER ;


   
---------------------
CREATE TABLE GENDER(
id char(20) not null,
name varchar(100) not null,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_gender PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE ROLE(
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(191) not null,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_role PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE MARITALSTATUS(
id int UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100),
description varchar(300),
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_maritalstatus PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE PERSON(
id int unsigned not null,
first_name varchar(100) not null,
second_name varchar(100) not null,
other_name varchar(100),
first_surname varchar(100) not null,
second_surname varchar(100) not null,
other_surname varchar(100),
maritalstatus_id int UNSIGNED NOT NULL,
phone_number VARCHAR(100), 
cellphone_number varchar(100),
department varchar(100),
home_address varchar(300),
occupation varchar(100),
birthday date,
picture varchar(300),
gender_id char(20) not null,
employee BOOLEAN DEFAULT FALSE,
tutor BOOLEAN DEFAULT FALSE,
student BOOLEAN DEFAULT FALSE,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_person PRIMARY KEY (id),
CONSTRAINT fk_person_maritalstatus FOREIGN KEY (maritalstatus_id) REFERENCES maritalstatus(id),
CONSTRAINT fk_person_gender FOREIGN KEY (gender_id) REFERENCES GENDER(id)
)ENGINE=InnoDb;

CREATE TABLE USERS(
id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
'name' varchar(191) not null,
email varchar(191) not null,
email_verified_at timestamp,
password varchar(191) not null,
remember_token varchar(191),
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
person_id int not null,
role_id not null,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT PRIMARY KEY(id),
CONSTRAINT users_email_unique UNIQUE(email),
CONSTRAINT fk_users_role FOREIGN KEY (role_id) REFERENCES role(id),
CONSTRAINT fk_users_person FOREIGN KEY (person_id) REFERENCES person(id)
)ENGINE=InnoDb;


CREATE TABLE EMPLOYEE(
id int(255) unsigned not null,
dpi varchar(100) not null,
job varchar(100) not null,
salary decimal(10,2),
professor BOOLEAN DEFAULT FALSE,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_employee PRIMARY KEY (id),
CONSTRAINT fk_employee_person FOREIGN KEY (id) REFERENCES person(id)
)ENGINE=InnoDb;

CREATE TABLE TUTOR(
id int(255) unsigned not null,
dpi varchar(100) not null,
occupation varchar(100) not null,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_tutor PRIMARY KEY (id),
CONSTRAINT fk_tutor_person FOREIGN KEY (id) REFERENCES person(id)
)ENGINE=InnoDb;

CREATE TABLE GRADE(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100),
section enum('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'),
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_grade PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE STUDENT(
id int(255) unsigned not null,
student_code varchar(100),
age int,
grade_id int(255) unsigned,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_student PRIMARY KEY (id),
CONSTRAINT fk_student_person FOREIGN KEY (id) REFERENCES person(id),
CONSTRAINT fk_student_grade FOREIGN KEY (grade_id) REFERENCES grade(id)
)ENGINE=InnoDb;

CREATE TABLE STUDENTTUTOR(
student_id int(255) UNSIGNED NOT NULL,
tutor_id int(255) UNSIGNED NOT NULL,
relationship varchar(100) not null,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_studenttutor PRIMARY KEY (student_id,tutor_id),
CONSTRAINT fk_studenttutor_student FOREIGN KEY (student_id) REFERENCES student(id),
CONSTRAINT fk_studenttutor_tutor FOREIGN KEY (tutor_id) REFERENCES tutor(id)
)ENGINE=InnoDb;

CREATE TABLE PAYMENTCATEGORY(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100),
description varchar(300),
payment_date date,
amount decimal(10,2) not null,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_paymentcategory PRIMARY KEY (id)
)ENGINE=InnoDb;


CREATE TABLE PAYMENT(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
paymentcategory_id int(255) UNSIGNED NOT NULL,
amount decimal(10,2) not null,
code_reference varchar(100) not null,
student_id int(255) UNSIGNED NOT NULL,
tutor_id int(255) UNSIGNED NOT NULL,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_payment PRIMARY KEY (id),
CONSTRAINT fk_payment_studenttutor1 FOREIGN KEY (student_id) REFERENCES studenttutor(student_id),
CONSTRAINT fk_payment_studenttutor2 FOREIGN KEY (tutor_id) REFERENCES studenttutor(tutor_id),
CONSTRAINT fk_payment_paymentcategory FOREIGN KEY (paymentcategory_id) REFERENCES paymentcategory(id)
)ENGINE=InnoDb;

CREATE TABLE SCHOOL(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100) not null,
phone_number VARCHAR(100), 
cellphone_number varchar(100),
department varchar(100),
address varchar(300),
vision mediumtext,
mision mediumtext,
history mediumtext,
facebook_url varchar(300),
website_url varchar(300),
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_school PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE CYCLE(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100) not null,
school_id int(255) unsigned not null,
start_date date,
end_date date, 
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_cycle PRIMARY KEY (id),
CONSTRAINT fk_cycle_school FOREIGN KEY (school_id) REFERENCES school(id)
)ENGINE=InnoDb;

CREATE TABLE COURSE(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100) not null,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_course PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE SUBJECT(
grade_id int(255) UNSIGNED NOT NULL,
course_id int(255) UNSIGNED NOT NULL,
cycle_id int(255) UNSIGNED NOT NULL,
employee_id int(255) UNSIGNED NOT NULL,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_subject PRIMARY KEY (grade_id,course_id,cycle_id),
CONSTRAINT fk_subject_grade FOREIGN KEY (grade_id) REFERENCES grade(id),
CONSTRAINT fk_subject_course FOREIGN KEY (course_id) REFERENCES course(id),
CONSTRAINT fk_subject_cycle FOREIGN KEY (cycle_id) REFERENCES cycle(id),
CONSTRAINT fk_subject_employee FOREIGN KEY (employee_id) REFERENCES employee(id)
)ENGINE=InnoDb;

CREATE TABLE SUBJECTSTUDENT(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
student_id int(255) UNSIGNED NOT NULL,
grade_id int(255) UNSIGNED NOT NULL,
course_id int(255) UNSIGNED NOT NULL,
cycle_id int(255) UNSIGNED NOT NULL,
score_subject int(255) unsigned not null default '0',
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_subjectstudent PRIMARY KEY (id),
CONSTRAINT fk_subjectstudent_subject1 FOREIGN KEY (grade_id) REFERENCES subject(grade_id),
CONSTRAINT fk_subjectstudent_subject2 FOREIGN KEY (course_id) REFERENCES subject(course_id),
CONSTRAINT fk_subjectstudent_subject3 FOREIGN KEY (cycle_id) REFERENCES subject(cycle_id),
CONSTRAINT fk_subjectstudent_student  FOREIGN KEY (student_id) REFERENCES student(id)
)ENGINE=InnoDb;

CREATE TABLE UNIT(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
name varchar(100) NOT NULL,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_unit PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE ACTIVITY(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
unit_id int(255) UNSIGNED NOT NULL,
grade_id int(255) UNSIGNED NOT NULL,
course_id int(255) UNSIGNED NOT NULL,
cycle_id int(255) UNSIGNED NOT NULL,
name varchar(100) NOT NULL,
description varchar(100),
score decimal(10,0) not null default '0',
delivery_date date,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_activity PRIMARY KEY (id),
CONSTRAINT fk_activity_unit FOREIGN KEY (unit_id) REFERENCES unit(id),
CONSTRAINT fk_activity_subject1 FOREIGN KEY (grade_id) REFERENCES subject(grade_id),
CONSTRAINT fk_activity_subject2 FOREIGN KEY (course_id) REFERENCES subject(course_id),
CONSTRAINT fk_activity_subject3 FOREIGN KEY (cycle_id) REFERENCES subject(cycle_id)
)ENGINE=InnoDb;


-- CREATE TABLE SCORE(
-- id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
-- subjectstudent_id int(255) UNSIGNED NOT NULL,
-- unit_id int(255) UNSIGNED NOT NULL,
-- student_id int(255) UNSIGNED NOT NULL,
-- score_unit decimal(10,0) not null default '0',
-- created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
-- updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
-- status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
-- CONSTRAINT pk_score PRIMARY KEY (id),
-- CONSTRAINT fk_score_subjectstudent FOREIGN KEY (subjectstudent_id) REFERENCES subjectstudent(id),
-- CONSTRAINT fk_score_unit FOREIGN KEY (unit_id) REFERENCES unit(id),
-- CONSTRAINT fk_score_student FOREIGN KEY (student_id) REFERENCES student(id)
-- )ENGINE=InnoDb;

CREATE TABLE HOMEWORK(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
activity_id int(255) UNSIGNED NOT NULL,
subjectstudent_id int(255) UNSIGNED NOT NULL,
student_id int(255) UNSIGNED NOT NULL,
unit_id int(255) UNSIGNED NOT NULL,
points decimal(10,0) not null default '0',
delivery_date date,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_homework PRIMARY KEY (id),
CONSTRAINT fk_homework_activity FOREIGN KEY (activity_id) REFERENCES activity(id),
CONSTRAINT fk_homework_subjectstudent FOREIGN KEY (subjectstudent_id) REFERENCES subjectstudent(id),
CONSTRAINT fk_homework_student FOREIGN KEY (student_id) REFERENCES student(id),
CONSTRAINT fk_homework_unit FOREIGN KEY (unit_id) REFERENCES unit(id)
)ENGINE=InnoDb;

CREATE TABLE DAY(
id char(20) not null,
name varchar(100) not null,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_day PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE SCHEDULE(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
grade_id int(255) UNSIGNED NOT NULL,
course_id int(255) UNSIGNED NOT NULL,
cycle_id int(255) UNSIGNED NOT NULL,
day_id char(20) not null,
start_time time,
end_time time,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_schedule PRIMARY KEY (id),
CONSTRAINT fk_schedule_day FOREIGN KEY (day_id) REFERENCES day(id),
CONSTRAINT fk_schedule_subject1 FOREIGN KEY (grade_id) REFERENCES subject(grade_id),
CONSTRAINT fk_schedule_subject2 FOREIGN KEY (course_id) REFERENCES subject(course_id),
CONSTRAINT fk_schedule_subject3 FOREIGN KEY (cycle_id) REFERENCES subject(cycle_id)
)ENGINE=InnoDb;

CREATE TABLE CALENDAR(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
title varchar(100) not null,
description mediumtext,
start_time datetime,
end_time datetime,
cycle_id int(255) UNSIGNED not null,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_calendar PRIMARY KEY (id),
CONSTRAINT fk_calendar_cycle FOREIGN KEY (cycle_id) REFERENCES cycle(id)
)ENGINE=InnoDb;

CREATE TABLE ANNOUNCEMENT(
id int(255) UNSIGNED NOT NULL AUTO_INCREMENT,
title varchar(100) not null,
description mediumtext,
start_time datetime,
end_time datetime,
cycle_id int(255) UNSIGNED NOT NULL,
created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP on update CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
status enum('ACTIVO','INACTIVO') not null default 'ACTIVO',
CONSTRAINT pk_announcement PRIMARY KEY (id),
CONSTRAINT fk_announcement_cycle FOREIGN KEY (cycle_id) REFERENCES cycle(id)
)ENGINE=InnoDb;