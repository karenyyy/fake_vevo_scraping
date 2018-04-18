
CREATE TABLE userprofile(
	userid varchar(50) NOT NULL,
	firstname varchar(50) NULL,
	lastname varchar(50) NULL,
	email varchar(50) NULL,
	password varchar(max) NULL,
	CONSTRAINT PK_userprofile PRIMARY KEY (userid)
);

CREATE TABLE COMMENT (
	CommentId INT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	UserId VARCHAR(50) NOT NULL,
	Comment TEXT,
	CONSTRAINT COMMENT_FK FOREIGN KEY(UserId)
	REFERENCES USERPROFILE(userid)
	ON UPDATE CASCADE)