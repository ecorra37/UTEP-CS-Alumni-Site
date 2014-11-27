CREATE TABLE master (
	master_id INT(11) NOT NULL AUTO_INCREMENT,
	academicyear VARCHAR(30) NULL,
	term INT(11) NULL,
	last VARCHAR(30)NULL,
	first VARCHAR(30) NULL,
	major VARCHAR(30) NULL,
	level VARCHAR(30) NULL,
	degree VARCHAR(30) NULL,
	PRIMARY KEY (master_id)
) ENGINE-InnoDB;

CREATE TABLE users (
	user_id	INT(11) NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL,
	password VARCHAR(100)	NOT NULL,
	email VARCHAR(50) NOT NULL,
	first VARCHAR(50) NOT NULL,
	last VARCHAR(50) NOT NULL,
	title ENUM('Mr','Ms','Mis')	NULL,
	gender ENUM('f','m','u')	NOT NULL DEFAULT 'u',
	city VARCHAR(50) NULL,
	address VARCHAR(50) NULL,
	bio_data TEXT NULL,
	employed ENUM('y','n','u')	NOT NULL DEFAULT 'u',
	profile_pic BLOB NULL,
	last_login DATE NULL,
	profile_added DATE NULL,
	active_status ENUM('0','1') NOT NULL DEFAULT '0',
	friend_count INT(11) NULL,
	friend_array TEXT NULL,
	PRIMARY KEY (user_id)
) ENGINE=InnoDB;

CREATE TABLE messages (
	msg_id INT NOT NULL AUTO_INCREMENT,
	user_id_sender INT(11) NOT NULL,
	msg VARCHAR(255) NOT NULL,
	msg_read ENUM('y','n') NOT NULL DEFAULT 'n', 
	user_id_receiver INT(8) NOT NULL,
	date DATE NOT NULL,
	PRIMARY KEY (msg_id),
	INDEX (user_id_sender, user_id_receiver)
) ENGINE=InnoDB;

CREATE TABLE friend_requests (
	frequest_id INT(11) NOT NULL AUTO_INCREMENT,
	user_id_from INT(11) NOT NULL,
	user_id_to INT(11) NOT NULL,
	request_date DATE NOT NULL,
	request_confirm_date	DATE NOT NULL,
	request_status ENUM('0','1','-1')	NOT NULL DEFAULT '0', 
	PRIMARY KEY (frequest_id), 
	INDEX (user_id_from, user_id_to)
) ENGINE=InnoDB;

CREATE TABLE admin (
	admin_id INT(11) NOT NULL AUTO_INCREMENT,
	username VARCHAR(15) NOT NULL,
	password VARCHAR(15) NOT NULL,
	first VARCHAR(15) NOT NULL,
	last VARCHAR(15) NOT NULL,
	title VARCHAR(15) NOT NULL,
	PRIMARY KEY (admin_id)
) ENGINE=InnoDB;

CREATE TABLE friends (
	user_id INT(11) NOT NULL,
	user_id_friend INT(11) NOT NULL,
	INDEX (user_id, user_id_friend)
) ENGINE=InnoDB;

CREATE TABLE items (
	item_id INT NOT NULL AUTO_INCREMENT,
	category VARCHAR(30) NOT NULL,
	product_name VARCHAR(30) NOT NULL,
	description VARCHAR(255) NOT NULL,
	quantity INT(15) NOT NULL,
	PRIMARY KEY (item_id)
) ENGINE=InnoDB;