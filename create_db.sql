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
    volunteer_id INT(10) UNSIGNED PRIMARY KEY NOT NULL,
    FOREIGN KEY (volunteer_id) REFERENCES user(user_id)
);

CREATE TABLE order (
    order_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    customer_id INT(10) UNSIGNED NOT NULL,
    total FLOAT(10) NOT NULL,
);

CREATE TABLE ticket (
    ticket_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY NOT NULL,
    event_id INT(10) UNSIGNED NOT NULL,
    ticket_price FLOAT(10) NOT NULL,
);

CREATE TABLE order_item(
    order_id INT(10) UNSIGNED PRIMARY KEY NOT NULL,
    ticket_id INT(10) UNSIGNED PRIMARY KEY NOT NULL,
    quantity INT(2) UNSIGNED NOT NULL,
    FOREIGN KEY (order_id) REFERENCES order(order_id),
    FOREIGN KEY (ticket_id) REFERENCES ticket(ticket_id)
);