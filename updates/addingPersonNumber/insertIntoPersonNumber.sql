INSERT INTO personNumber SELECT number FROM playerData WHERE number IS NOT NULL;
UPDATE playerData SET personNumber = (SELECT number FROM personNumber WHERE playerData.number = number);

