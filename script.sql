-- NOTE: All tables names are in lower case; Database name is
-- all lower case as well.

-- **IMPORTANT**
-- Change abcd to your username on the next 3 lines before running this script!

CREATE DATABASE heroku_6eac11ed5355ee9;
USE heroku_6eac11ed5355ee9;
CREATE TABLE User (
	id INT AUTO_INCREMENT, 
	username VARCHAR(50),
	password VARCHAR(50),
	PRIMARY KEY (id)
);

CREATE TABLE Projects(
	projectid INT AUTO_INCREMENT,
	userid INT,
	title VARCHAR(50),
	PRIMARY KEY(projectid),
	FOREIGN KEY(userid) REFERENCES User(id)
		ON DELETE CASCADE
);

CREATE TABLE Tasks(
	taskid INT AUTO_INCREMENT,
	projectid INT,
	taskname VARCHAR(50),
	taskdue DATE,
	priority ENUM("High","Medium","Low"),
	notes MEDIUMTEXT,
	done BOOLEAN,
	PRIMARY KEY(taskid),
	FOREIGN KEY(projectid) REFERENCES Projects(projectid)
	
);
