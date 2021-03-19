SELECT * FROM users;

drop table users;


CREATE TABLE roles (
roleID INT PRIMARY KEY AUTO_INCREMENT,
type VARCHAR(255)
);

/*Roles inset values*/
INSERT INTO roles (type) VALUES ('SuperAdministrator');
INSERT INTO roles (type) VALUES ('Administrator');
INSERT INTO roles (type) VALUES ('Volunteer');
INSERT INTO roles (type) VALUES ('Customer');

SELECT * FROM roles;

CREATE TABLE admin(
adminID INT PRIMARY KEY AUTO_INCREMENT,
email VARCHAR(255),
password VARCHAR(255),
roleID INT,
FOREIGN KEY (roleID) REFERENCES roles(roleID)
);

SELECT * FROM admin;

INSERT INTO admin(email, password, roleID) VALUES ('text@outlook.com','password',1);

/*Stoped here*/

CREATE TABLE users (
userID INT PRIMARY KEY AUTO_INCREMENT,
firstname VARCHAR(255) NOT NULL ,
lastname VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
roleID INT NOT NULL,
FOREIGN KEY (roleID) REFERENCES roles(roleID)
);

SELECT * FROM users;


CREATE TABLE user_address(
user_address_id INT PRIMARY KEY AUTO_INCREMENT,
userID INT,
addressID INT,
FOREIGN KEY (userID) REFERENCES users(userID),
FOREIGN KEY (addressID) REFERENCES address(addressID)
);


CREATE TABLE address (
addressID INT PRIMARY KEY AUTO_INCREMENT,
address_line1 VARCHAR(255),
address_line2 VARCHAR(255),
city VARCHAR(255),
post_code VARCHAR(255)
);

CREATE TABLE order_status(
orderStatusID INT PRIMARY KEY AUTO_INCREMENT,
status VARCHAR(255)
);

CREATE TABLE orders(
orderID INT PRIMARY KEY AUTO_INCREMENT,
userID INT,
totalPrice DOUBLE,
orderStatusID INT,
FOREIGN KEY (userID) REFERENCES users(userID)
);

CREATE TABLE payment_method(
paymentMethodID INT PRIMARY KEY AUTO_INCREMENT,
method VARCHAR(255)
);

INSERT INTO payment_method(method) VALUES ('Visa');
INSERT INTO payment_method(method) VALUES ('Credit Card');
INSERT INTO payment_method(method) VALUES ('Paypal');


CREATE TABLE order_receipt(
orderReceiptID INT PRIMARY KEY AUTO_INCREMENT,
orderID INT,
customerID INT,
date DATETIME,
paymentMethodID INT,
totalPrice double,
FOREIGN KEY (paymentMethodID) REFERENCES payment_method(paymentMethodID)
);

CREATE TABLE event(
eventID INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(255),
category VARCHAR(255),
start_time DATETIME,
end_time DATETIME
);

CREATE TABLE ticket(
ticketID INT PRIMARY KEY AUTO_INCREMENT,
ticketPrice DOUBLE,
eventID INT,
FOREIGN KEY (eventID) REFERENCES event(eventID)
);

CREATE TABLE order_ticket(
orderID INT,
ticketID INT,
quantity INT,
FOREIGN KEY (orderID) REFERENCES orders(orderID),
FOREIGN KEY (ticketID) REFERENCES ticket(ticketID),
PRIMARY KEY (orderID,ticketID)
);

CREATE TABLE











