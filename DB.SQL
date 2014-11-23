CREATE TABLE students_master ( //already provided by Longpre
		master_id 		INT 			NOT NULL AUTO_INCREMENT,
		academicyear		VARCHAR(12)	  	NULL,
		term	  		INT(11)		    	NULL,
		last		        VARCHAR(25)	  	NULL,
		first	  	        VARCHAR(12)	  	NULL,
		major		       	VARCHAR(5)	  	NULL,
		level		        VARCHAR(5)	  	NULL,
		degree		    	VARCHAR(12)	  	NULL,
		PRIMARY KEY (master_id),
	) ENGINE=InnoDB;
CREATE TABLE users (
		user_id 		INT			NOT NULL AUTO_INCREMENT,
		master_id		INT(11)			NOT NULL,
		first		    	VARCHAR(15)		NOT NULL,
		last		    	VARCHAR(15)		NOT NULL,
		password	  	VARCHAR(15)		NOT NULL,
		gender		  	ENUM(‘f’,’m’,’u’)	NOT NULL DEFAULT ‘u’,
		city		    	VARCHAR(20)		NULL,
		employed	  	ENUM(‘y’,’n’,’u’)	NOT NULL DEFAULT ‘u’,
		email		    	VARCHAR(30)		NOT NULL,
		image		    	BLOB			NULL,
		PRIMARY KEY (user_id),
    		INDEX (master_id)
	) ENGINE=InnoDB;
CREATE TABLE messages (
		msg_id		      	INT		      	NOT NULL AUTO_INCREMENT,
		user_id_sender		INT(11)		  	NOT NULL,
		msg			VARCHAR(255)		NOT NULL,
		msg_read		ENUM(‘y’,’n’)		NOT NULL DEFAULT ‘n’,				
    		user_id_receiver	INT(8)		  	NOT NULL,
		date		        DATE			NOT NULL,
		PRIMARY KEY (msg_id),
		INDEX (user_id_sender, user_id_receiver)
	) ENGINE=InnoDB;
CREATE TABLE friend_requests (
		user_id_invite		INT(11)			NOT NULL,
		status		      	ENUM(‘a’,’n’)		NOT NULL DEFAULT ‘n’, //a=accepted n = not
	  	user_id_invited		INT(11)		    	NOT NULL,
		INDEX (user_id_invite, user_id_invited)
	) ENGINE=InnoDB;
CREATE TABLE admin (
		username	    	VARCHAR(15)	    	NOT NULL,
		password	    	VARCHAR(15)		NOT NULL,
		first		    	VARCHAR(15)	    	NOT NULL,
		last		      	VARCHAR(15)	    	NOT NULL,
		title		      	VARCHAR(15)	    	NOT NULL,
		PRIMARY KEY (username)
	) ENGINE=InnoDB;
CREATE TABLE friends (
		user_id		    	INT(11)   		NOT NULL,
		user_id_friend		INT(11)		    	NOT NULL,
		INDEX (user_id, user_id_friend)
	) ENGINE=InnoDB;
CREATE TABLE items (
		item_id			INT			NOT NULL AUTO_INCREMENT,
		category		VARCHAR(30)		NOT NULL,
		product_name		VARCHAR(30)		NOT NULL,
		description		VARCHAR(255)		NOT NULL,
		quantity		INT(15)			NOT NULL,
		PRIMARY KEY (item_id)
	) ENGINE=InnoDB;


