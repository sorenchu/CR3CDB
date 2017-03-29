/***************************
***      SEASONS         ***
***************************/
INSERT INTO season(startingyear, seasontext, defaultseason)
VALUES (2016, "2016/2017", 1);
INSERT INTO season(startingyear, seasontext, defaultseason)
VALUES (2017, "2017/2018", 0);

/***************************
***      PERSONAL DATA   ***
***************************/
INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Antonio", "Balmaseda", "Betico", "male", TRUE, FALSE, FALSE, TRUE);

INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Antonio", "Castro", "GiJoe", "male", FALSE, TRUE, TRUE, FALSE);

INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Fermín", "de la Calle", "Fermín", "male", TRUE, TRUE, FALSE, FALSE);

INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("María", "Esponera", "Potorro", "female", TRUE, FALSE, TRUE, FALSE);

INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Angélica", "Hansen", "Geli", "female", FALSE, TRUE, TRUE, TRUE);

INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Juanma", "González", "Cochino", "male", TRUE, TRUE, FALSE, FALSE);

INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Gonzalo", "Sabe", "Gondo", "male", TRUE, FALSE, TRUE, FALSE); 

INSERT INTO personalData (name, surname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Pedrito", "González", "male", FALSE, TRUE, FALSE, FALSE);


/***************************
***      WHOLE PERSON    ***
***************************/
INSERT INTO wholePerson(personalData_id, playerData_id, coachData_id, memberData_id, parentData_id)
VALUES (1, NULL, NULL, NULL, NULL);

INSERT INTO wholePerson(personalData_id, playerData_id, coachData_id, memberData_id, parentData_id)
VALUES (2, NULL, NULL, NULL, NULL);

INSERT INTO wholePerson(personalData_id, playerData_id, coachData_id, memberData_id, parentData_id)
VALUES (3, NULL, NULL, NULL, NULL);

INSERT INTO wholePerson(personalData_id, playerData_id, coachData_id, memberData_id, parentData_id)
VALUES (4, NULL, NULL, NULL, NULL);

INSERT INTO wholePerson(personalData_id, playerData_id, coachData_id, memberData_id, parentData_id)
VALUES (5, NULL, NULL, NULL, NULL);

INSERT INTO wholePerson(personalData_id, playerData_id, coachData_id, memberData_id, parentData_id)
VALUES (6, NULL, NULL, NULL, NULL);

INSERT INTO wholePerson(personalData_id, playerData_id, coachData_id, memberData_id, parentData_id)
VALUES (7, NULL, NULL, NULL, NULL);

INSERT INTO wholePerson(personalData_id, playerData_id, coachData_id, memberData_id, parentData_id)
VALUES (8, NULL, NULL, NULL, NULL);

