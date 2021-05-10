-- Updates the applicationn status upon approval or rejection by an authority

CREATE OR REPLACE FUNCTION updateApplicationStatus(	
	IN application_id INTEGER,
	IN position_of_updater VARCHAR,
	IN type_of_update VARCHAR
) 
RETURNS
VOID
AS $$
#variable_conflict use_column

DECLARE
new_status VARCHAR;
retrosp INTEGER;

BEGIN

SELECT isretrospective
INTO retrosp
FROM applications
WHERE appid=application_id;

if type_of_update='approve' then
	if position_of_updater='Faculty' then
		new_status='HOD';
	elsif position_of_updater='HOD' then
		new_status='Dean FA';
	elsif position_of_updater='Dean FA' then
		if retrosp=1 then
			new_status='Director';
		else
			new_status='Approved';
		end if;
	elsif position_of_updater='Director' then
		new_status:='Approved';
	end if;
	
elsif type_of_update='reject' then
	new_status:='Rejected';
	
elseif type_of_update='return' then
	new_status:=CONCAT('Returned by ',position_of_updater);
end if;

UPDATE applications
SET status=new_status
WHERE appid=application_id;

END;
$$ LANGUAGE plpgsql;