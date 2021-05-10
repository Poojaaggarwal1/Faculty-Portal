-- Get status of a leave application

CREATE OR REPLACE FUNCTION getApplicationStatus(
IN application_id INTEGER
) RETURNS
VARCHAR
AS $$
#variable_conflict use_column

DECLARE
retval VARCHAR;

BEGIN

SELECT status INTO retval
FROM applications 
WHERE appid=application_id;

RETURN retval;
END;
$$ LANGUAGE plpgsql;