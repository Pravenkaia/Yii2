CREATE TABLE yii2basic.users
(
    id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username varchar(200) NOT NULL,
    email varchar(120) NOT NULL,
    password_hash varchar(64) NOT NULL,
    token varchar(300),
    date_created timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL
);
INSERT INTO yii2basic.users (username, email, password_hash, token, date_created) VALUES ('user Петя', 'user1@email.ru', '$2y$13$I3l53QGqeXl8zpkFuHamzeltdli2Ng8KniIXyCzOF1Q5izX/Nj6H2', 'fffff', '2019-01-31 11:57:10');
INSERT INTO yii2basic.users (username, email, password_hash, token, date_created) VALUES ('admin', 'admin@email.ru', '$2y$13$o2m8HDuuj9oMOlibUI3wzOaIdxd5AvjnZvArxXZ7IEu0G0GaGSbW6', 'nnnnnnnnnnn', '2019-01-31 12:35:04');
INSERT INTO yii2basic.users (username, email, password_hash, token, date_created) VALUES ('Юзер3', 'user3@email.ru', '$2y$13$S7umiOtLigDbtpPhVNoD8urScdztGcOqMEas/6MsQJXE8aahNx4m6', 'MWNUkwcmAPkZGZ52xC3axyINULAIJVjG', '2019-02-08 13:48:38');
INSERT INTO yii2basic.users (username, email, password_hash, token, date_created) VALUES ('test2', 'test2@email.ru', '$2y$13$rcX0ifnpN.XxDcUJfkqvouwuvegnyRW45EAHYr8UEksBkAjNpmfjK', 'F8g24nZHnNmipNtPk5w_GkOYNEKy0hHF', '2019-02-11 11:01:21');
INSERT INTO yii2basic.users (username, email, password_hash, token, date_created) VALUES ('test3', 'test3@email.ru', '$2y$13$Tqv4w7ALeFoI1cEGfJXmL.klmyZ46Pt5Phc7C/txVUDqtUUrMK.U.', 'R7MBMuNkfYEFR9VITIfxpa9ggPRVOL1r', '2019-02-12 18:56:52');
INSERT INTO yii2basic.users (username, email, password_hash, token, date_created) VALUES ('test4', 'test4@email.ru', '$2y$13$1ZH20dqYkukCk7yzdogBLuMGttOh7bcm8SJQke4tOHJQdOorQpRe.', 'HE5mGTEXPJ9RO05A8wigEhrDlGF6ejQl', '2019-02-14 09:25:24');