-- Get the userID and name rof the Head of a particular department

CREATE OR REPLACE FUNCTION hodAt(
	IN dept_name VARCHAR,
	OUT hod_userid VARCHAR,
	OUT hod_name VARCHAR
)

AS $$
#variable_conflict use_column

BEGIN

SELECT userid,name
INTO hod_userid,hod_name
FROM users
WHERE position='HOD' and dept=dept_name;

END;
$$ LANGUAGE plpgsql;
