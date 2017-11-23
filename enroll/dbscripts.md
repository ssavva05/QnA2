
ALTER TABLE `Lecture` 
 ADD `enroll_key` varchar(20) ;
 
 ALTER TABLE `Lecture` 
  ADD UNIQUE KEY `enrollKey_UNIQUE` (`enroll_key`) ;
 
ALTER TABLE `Lecture`  
 ADD `mod_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ;
 
ALTER TABLE `Lecture` 
  ADD dateof date ;

ALTER TABLE `Lecture` 
  ADD CONSTRAINT FOREIGN KEY "dateof2" (dateof) REFERENCES Course(dateof) ;

ALTER TABLE `Lecture` 
  DROP FOREIGN KEY cname

CREATE TABLE IF NOT EXISTS `loginAttemptsStudents` (
  `IP` varchar(20) NOT NULL,
  `Attempts` int(11) NOT NULL,
  `LastLogin` datetime NOT NULL,
  `enroll_key` varchar(20) DEFAULT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `lecture`(`lid`, `cname`, `enroll_key`, `mod_timestamp`) VALUES ("1","EPL425","enroll",)