-- Stored Procedure to append comment to a leave application.

CREATE OR REPLACE FUNCTION insertComment(	
	IN application_id INTEGER,
	IN commentor_id VARCHAR,
	IN commentor_position VARCHAR,
	IN comment_text VARCHAR
) 
RETURNS
VOID
AS $$
#variable_conflict use_column

BEGIN
INSERT INTO comments(commentorid,appid,commentorposition,comment,timing)
VALUES (commentor_id,application_id,commentor_position,comment_text,NOW());

END;
$$ LANGUAGE plpgsql;

