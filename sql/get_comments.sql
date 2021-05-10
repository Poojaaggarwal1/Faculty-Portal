-- Get all comments made on a particular leave application

CREATE OR REPLACE FUNCTION getComments(
IN application_id INTEGER
) RETURNS
TABLE(
	commentid INTEGER,
	commentorid VARCHAR,
	appid INTEGER,
	commentorposition VARCHAR,
	comment VARCHAR,
	timing TIMESTAMP WITHOUT TIME ZONE
)
AS $$
#variable_conflict use_column
BEGIN

RETURN QUERY

SELECT * 
FROM comments 
WHERE appid=application_id
ORDER BY timing DESC;

END;
$$ LANGUAGE plpgsql;