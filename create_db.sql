CREATE TABLE user (
    user_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email_address VARCHAR(250)
);
CREATE TABLE customer (
    customer_id INT(10) UNSIGNED PRIMARY KEY,
    billing_address VARCHAR(60),
    FOREIGN KEY (customer_id) REFERENCES user(user_id)
);
CREATE TABLE admin (
    admin_id INT(10) UNSIGNED PRIMARY KEY,
    FOREIGN KEY (customer_id) REFERENCES user(user_id)
);
CREATE TABLE volunteer (
    volunteer_id INT(10) UNSIGNED PRIMARY KEY,
    FOREIGN KEY (volunteer_id) REFERENCES user(user_id)
);