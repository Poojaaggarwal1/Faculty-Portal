-- Procedure to verify login credentials of a user
CREATE OR REPLACE FUNCTION verifyCredentials(
    IN entereduserid VARCHAR,
    IN enteredpassword varchar
)
RETURNS INTEGER
AS $$

#variable_conflict use_column

DECLARE result INTEGER;
BEGIN

IF EXISTS (SELECT * FROM users WHERE userid=entereduserid AND password=enteredpassword) THEN
	RETURN 1;
ELSE
	RETURN 0;
END IF;

END;
$$ LANGUAGE plpgsql;