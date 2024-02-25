create table Contact(
    name varchar(255),
    email varchar(255),
    message varchar(255)
);

create table admin_login(
    admin_id int primary key,
    username varchar(255),
    password varchar(255)
)

insert into admin_login values(1001,'Rajesh','raju123');

create table user_login(
    userid int primary key,
    username varchar(255),
    password varchar(255)
);

create table user_register(
    userid varchar(255) primary key,
    firstname varchar(255),
    lastname varchar(255),
    mailid varchar(255),
    phone int(30),
    password varchar(255)
);
CREATE TRIGGER after_register_trigger
AFTER INSERT ON user_register
FOR EACH ROW
BEGIN
    INSERT INTO user_login (userid,username, password) VALUES (NEW.userid,NEW.password);
END;


ALTER TABLE `user_register` ADD `username` VARCHAR(255) NOT NULL ;

ALTER TABLE `user_login` ADD `username` VARCHAR(255) NOT NULL ;

DROP TRIGGER IF EXISTS `after_register_trigger`;
CREATE DEFINER=`root`@`localhost` TRIGGER `after_register_trigger`
AFTER INSERT ON `user_register` 
FOR EACH ROW 
BEGIN 
INSERT INTO user_login (username, password,email) VALUES (NEW.username, NEW.password,NEW.email); 
END

create table auditorium(
    auditorium_id int primary key,
    auditorium_name varchar(255),
    capacity int,
    seating_configuration varchar(255),
    type varchar(255),
    location varchar(255)
);

CREATE TABLE auditorium_updates (
    update_id INT AUTO_INCREMENT PRIMARY KEY,
    auditorium_name VARCHAR(255),
    capacity INT,
    seating_configuration VARCHAR(255),
    type VARCHAR(255),
    place VARCHAR(255),
    update_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table booking(
    booking id int AUTO_INCREMENT ,
    username varchar(255),
    auditorium_name varchar(255),
    booking_date date,
    booking_time time,
    booking_hours int,
    amount DECIMAL(10, 2)
);

CREATE TABLE booking (
    booking_id INT PRIMARY KEY,
    username varchar(255),
    auditorium_name VARCHAR(255),
    booking_date DATE,
    booking_time TIME,
    booking_hours INT,
    amount DECIMAL(10, 2),
    approve_status varchar(255) default 'yet to be approved',
    FOREIGN KEY (user_id) REFERENCES user_register(id)
);

drop table user_login;
create table user_login
(login_no int AUTO_INCREMENT primary key,
 username varchar(255),
 password varchar(255),
 foreign key(username) references user_register(username)
 );

 DROP TRIGGER IF EXISTS `after_register_trigger`;CREATE DEFINER=`root`@`localhost` TRIGGER `after_register_trigger` AFTER INSERT ON `user_register` FOR EACH ROW BEGIN INSERT INTO user_login (username, password) VALUES (NEW.username, NEW.password); END

CREATE TABLE track_status (
    booking_id INT,
    username VARCHAR(255),
    auditorium_id INT,
    auditorium_name VARCHAR(255),
    booking_date DATE,
    booking_time TIME,
    booking_hours INT,
    approval_status VARCHAR(255) DEFAULT 'yet to be approved',
    payment_status VARCHAR(255) DEFAULT 'yet to be paid',
    FOREIGN KEY (booking_id) REFERENCES booking (booking_id) ON DELETE CASCADE,
    FOREIGN KEY (auditorium_id) REFERENCES auditorium (auditorium_id) ON DELETE CASCADE
);

CREATE TABLE deleted_info (
    booking_id INT PRIMARY KEY,
    username VARCHAR(255),
    auditorium_name VARCHAR(255),
    approve_status VARCHAR(255),
    amount DECIMAL(10, 2),
    deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    foreign key(booking_id) references booking(booking_id),
    foreign key(username) references user_register(username),
);

DELIMITER //
CREATE TRIGGER before_delete_booking
BEFORE DELETE ON booking
FOR EACH ROW
BEGIN
    INSERT INTO deleted_info (booking_id, username, auditorium_name, approve_status, amount)
    SELECT booking_id, username, auditorium_name, approve_status, amount
    FROM booking
    WHERE booking_id = OLD.booking_id;

    -- You can also add more columns from the booking table to the deleted_info table if needed.

END;
//
DELIMITER ;

