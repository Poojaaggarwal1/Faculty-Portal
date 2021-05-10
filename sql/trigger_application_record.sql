CREATE TABLE applicationrecord(
	applicantid VARCHAR(225) NOT NULL,
	applicationid INTEGER NOT NULL,
	status VARCHAR(225) NOT NULL,
	changedby VARCHAR(225) NOT NULL,
	timing TIMESTAMP
);

-- Trigger to update the All time record of applications when an application gets approved or rejected.

CREATE OR REPLACE FUNCTION updateapplicationrecord()

	RETURNS TRIGGER AS $$
	#variable_conflict use_column
	BEGIN
	
	INSERT INTO applicationrecord(applicantid,applicationid,status,changedby,timing)
	VALUES(OLD.applicantid,OLD.appid,NEW.status,OLD.status,NOW());
	
	RETURN NEW;
	END;
	$$ LANGUAGE plpgsql;

CREATE TRIGGER recordapplications
	BEFORE UPDATE ON applications
	FOR EACH ROW
	WHEN (NEW.status ='Approved' OR NEW.status='Rejected')
	EXECUTE PROCEDURE updateapplicationrecord();

