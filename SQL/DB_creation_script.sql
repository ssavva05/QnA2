/*Here will put all thesql creation script after export from php my admin*/
CREATE DATABASE IF NOT EXISTS qnaDB;
CREATE TABLE IF NOT EXISTS members (
  memberID int(11) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  active varchar(255) NOT NULL,
  PRIMARY KEY (memberID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;


CREATE TABLE IF NOT EXISTS Course(
    cname varchar(10),
    memberID int(11), 
    dateof date,
    PRIMARY KEY(cname,dateof),
    CONSTRAINT FOREIGN KEY (memberID) REFERENCES Professor(memberID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS Lecture(
    lid int,
    cname varchar(10),
	dateof date,
	`enroll_key` varchar(20),
	`active` BIT NOT NULL DEFAULT b'0',
	`mod_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	UNIQUE KEY `enrollKey_UNIQUE` (`enroll_key`),
    PRIMARY KEY(lid),
    CONSTRAINT FOREIGN KEY (cname) REFERENCES Course(cname),
	CONSTRAINT FOREIGN KEY (dateof) REFERENCES Course(dateof)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS Question(
    qid int,
    lid int,
    seen int,
    textofquestion text,
    textofanswer	text,
    PRIMARY KEY(qid),
    FOREIGN KEY (lid) REFERENCES Lecture(lid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS Answer(
    aid int,
    qid int,
    textofanswer text,
    counter int,
    PRIMARY KEY(aid),
    FOREIGN KEY (qid) REFERENCES Question(qid)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

CREATE TABLE IF NOT EXISTS `loginAttemptsStudents` (
  `IP` varchar(20) NOT NULL,
  `Attempts` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `enroll_key` varchar(20) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

