-- To get all faculties not holding any special position

CREATE OR REPLACE FUNCTION allFaculties()
RETURNS TABLE(
	userid VARCHAR,
	name VARCHAR
)
AS $$
#variable_conflict use_column

BEGIN

RETURN QUERY
SELECT userid,name
FROM users
WHERE position='Faculty';

END;
$$ LANGUAGE plpgsql;