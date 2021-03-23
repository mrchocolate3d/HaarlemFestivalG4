CREATE TABLE `user` (
    user_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email_address VARCHAR(250)
);
CREATE TABLE `customer` (
    customer_id INT(10) UNSIGNED PRIMARY KEY,
    billing_address VARCHAR(60),
    FOREIGN KEY (customer_id) REFERENCES user(user_id)
);
CREATE TABLE `admin` (
    admin_id INT(10) UNSIGNED PRIMARY KEY,
    FOREIGN KEY (admin_id) REFERENCES user(user_id)
);
CREATE TABLE `volunteer` (
    volunteer_id INT(10) UNSIGNED PRIMARY KEY,
    FOREIGN KEY (volunteer_id) REFERENCES user(user_id)
);
CREATE TABLE `order` (
    order_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_id INT(10) UNSIGNED NOT NULL,
    order_date DATETIME,
    total FLOAT(10) NOT NULL
);
CREATE TABLE `ticket` (
    ticket_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    event_id INT(10) UNSIGNED NOT NULL,
    ticket_price FLOAT(10) NOT NULL,
    ticket_quantity INT(4) NOT NULL
);
CREATE TABLE `order_item` (
    order_id INT(10) UNSIGNED,
    ticket_id INT(10) UNSIGNED,
    quantity INT(2) UNSIGNED NOT NULL,
    PRIMARY KEY (order_id, ticket_id),
    FOREIGN KEY (order_id) REFERENCES `order`(order_id),
    FOREIGN KEY (ticket_id) REFERENCES ticket(ticket_id)
);
CREATE TABLE `location`(
    location_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    location_name VARCHAR(50),
    location_description VARCHAR(500),
    capacity INT(4) UNSIGNED
);
CREATE TABLE `event` (
    event_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(50),
    category VARCHAR(50),
    start_time DATETIME,
    end_time DATETIME,
    location_id INT(10) UNSIGNED,
    FOREIGN KEY (location_id) REFERENCES `location`(location_id)
);
CREATE TABLE `artist` (
    artist_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    artist_name VARCHAR(50) UNIQUE,
    artist_description VARCHAR(5000),
    genre VARCHAR(50),
    image MEDIUMBLOB,
    facebook_link VARCHAR(200),
    twitter_link VARCHAR(200),
    instagram_link VARCHAR(200),
    youtube_link VARCHAR(200)
);
CREATE TABLE `jazz_event` (
    event_id INT(10) UNSIGNED PRIMARY KEY,
    artist_id INT(10) UNSIGNED,
    FOREIGN KEY (artist_id) REFERENCES artist(artist_id),
    FOREIGN KEY (event_id) REFERENCES `event`(event_id)
);
CREATE TABLE `dance_event` (
    dance_event_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    artist_id INT(10) UNSIGNED,
    event_id INT(10) UNSIGNED,
    FOREIGN KEY (artist_id) REFERENCES artist(artist_id),
    FOREIGN KEY (event_id) REFERENCES `event`(event_id)
);
CREATE TABLE `history_event` (
    dance_event_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    event_id INT(10) UNSIGNED,
    guide_user_id INT(10) UNSIGNED,
    FOREIGN KEY (guide_user_id) REFERENCES user(user_id),
    FOREIGN KEY (event_id) REFERENCES `event`(event_id)
);