INSERT INTO wholePerson (personalData_id, playerData_id, parentData_id)
VALUES (1,1,1);
INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Antonio", "Balmaseda", "Betico", "male", TRUE, FALSE, FALSE, TRUE);
INSERT INTO playerData (season, payment, category)
VALUES (2016, 200, "senior");

INSERT INTO wholePerson (personalData_id, playerData_id)
VALUES (2,2);
INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Fermín", "de la Calle", "Fermín", "male", TRUE, TRUE, FALSE, TRUE);
INSERT INTO playerData (season, payment, category)
VALUES (2016, 240, "senior");


INSERT INTO wholePerson (personalData_id, playerData_id, parentData_id)
VALUES (3,3,1);
INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Antonio", "Castro", "GiJoe", "male", TRUE, TRUE, FALSE, TRUE);
INSERT INTO playerData (season, payment, category)
VALUES (2016, 240, "senior", 3);


INSERT INTO wholePerson (personalData_id, playerData_id)
VALUES (4,4);
INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("María", "Esponera", "Potorro", "female", TRUE, FALSE, FALSE, FALSE);
INSERT INTO playerData (season, payment, category)
VALUES (2016, 240, "femenino", 4);


INSERT INTO wholePerson (personalData_id, playerData_id)
VALUES (5,5);
INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Gonzalo", "Sabe", "Gondo", "male", TRUE, TRUE, FALSE, FALSE); 
INSERT INTO playerData (season, payment, category)
VALUES (2016, 240, "benjamin", 5);


INSERT INTO wholePerson (personalData_id, coachData_id, memberData_id)
VALUES (6,1,1);
INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Angélica", "Hansen", "Geli", "female", FALSE, TRUE, TRUE, FALSE);
INSERT INTO memberData (season, payment, member_id)
VALUES (2016, 20, 1);


INSERT INTO wholePerson (personalData_id, playerData_id)
VALUES (7,6);
INSERT INTO personalData (name, surname, nickname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Juanma", "González", "Cochino", "male", TRUE, FALSE, FALSE, FALSE);
INSERT INTO playerData (season, payment, category)
VALUES (2016, 240, "senior", 7);


INSERT INTO wholePerson (personalData_id, playerData_id)
VALUES (8,7);
INSERT INTO personalData (name, surname, sex, is_player, is_coach, is_member, is_parent)
VALUES ("Pedrito", "González", "male", TRUE, FALSE, FALSE, FALSE);
INSERT INTO playerData (season, payment, category)
VALUES (2016, 240, "alevin", 8);
