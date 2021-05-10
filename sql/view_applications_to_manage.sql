-- Fetch applications to manage depending on the level of authority

DROP FUNCTION viewapplicationstomanage(character varying,character varying);
CREATE OR REPLACE FUNCTION viewApplicationsToManage(	
	IN user_position VARCHAR,
	IN user_dept VARCHAR
)
RETURNS TABLE(
	applicantid VARCHAR,
	appid INTEGER,
	status VARCHAR,
	startdate DATE,
	enddate DATE,
	isretrospective INTEGER
)
AS $$
#variable_conflict use_column

BEGIN

IF user_position='Director' THEN
	RETURN QUERY
	SELECT applicantid,appid,status,startdate,enddate,isretrospective
	FROM applications
	WHERE (status='Director' OR status='Returned by Director')
	ORDER BY timing;

ELSIF user_position='Dean FA' THEN
	RETURN QUERY
	SELECT applicantid,appid,status,startdate,enddate,isretrospective
	FROM applications
	WHERE (status='Dean FA' OR status='Returned by Dean FA')
	ORDER BY timing;
	
ELSIF user_position='HOD' THEN
	RETURN QUERY
	SELECT A1.applicantid,A1.appid,A1.status,A1.startdate,A1.enddate,A1.isretrospective
	FROM applications as A1,users as U1
	WHERE A1.applicantid=U1.userid AND U1.dept=user_dept and (A1.status='HOD' OR A1.status='Returned by HOD')
	ORDER BY A1.timing;
END IF;

END;
$$ LANGUAGE plpgsql;

