INSERT INTO personNumber (number) (SELECT number FROM playerData WHERE number IS NOT NULL);
UPDATE playerData SET personNumber_id = (SELECT id FROM personNumber WHERE playerData.number = personNumber.number);
ALTER TABLE playerData DROP COLUMN number;

