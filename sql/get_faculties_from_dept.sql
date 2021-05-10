--To get faculties currently not holding any special position from a particular department

CREATE OR REPLACE FUNCTION facultiesFromDept(	
	IN department_name VARCHAR
)
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
WHERE position='Faculty' and dept=department_name;

END;
$$ LANGUAGE plpgsql;