-- Fetch the userid and name for faculty holding a special position

CREATE OR REPLACE FUNCTION facultyAtPosition(	
	IN position_of_faculty VARCHAR,
	OUT faculty_userid VARCHAR,
	OUT faculty_name VARCHAR
) 
AS $$
#variable_conflict use_column

BEGIN

SELECT userid,name
INTO faculty_userid,faculty_name
FROM users
WHERE position=position_of_faculty;

END;
$$ LANGUAGE plpgsql;

