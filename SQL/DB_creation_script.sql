/*Here will put all thesql creation script after export from php my admin*/
CREATE DATABASE IF NOT EXISTS qnaDB;
CREATE TABLE IF NOT EXISTS Professor(
    username varchar(10),
    password varchar(10),
    email	varchar(30),
    PRIMARY KEY(username)
);


CREATE TABLE IF NOT EXISTS Course(
    cname varchar(10),
    username varchar(10),
    dateof date,
    PRIMARY KEY(cname,dateof),
    CONSTRAINT FOREIGN KEY (username) REFERENCES Professor(username)
);

CREATE TABLE IF NOT EXISTS Lecture(
    lid int,
    cname varchar(10),
    PRIMARY KEY(lid),
    FOREIGN KEY (cname) REFERENCES Course(cname)
);

CREATE TABLE IF NOT EXISTS Question(
    qid int,
    lid int,
    seen int,
    textofquestion text,
    textofanswer	text,
    PRIMARY KEY(qid),
    FOREIGN KEY (lid) REFERENCES Lecture(lid)
);

CREATE TABLE IF NOT EXISTS Answer(
    aid int,
    qid int,
    textofanswer text,
    counter int,
    PRIMARY KEY(aid),
    FOREIGN KEY (qid) REFERENCES Question(qid)
);
