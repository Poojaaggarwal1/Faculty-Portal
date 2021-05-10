CREATE TABLE positionsrecord(
	userid VARCHAR(225) NOT NULL,
	position VARCHAR(225) NOT NULL,
	startdate DATE NOT NULL,
	enddate DATE ,
	time TIMESTAMP NOT NULL
);


CREATE OR REPLACE FUNCTION appoint()
	RETURNS 
	TRIGGER 
	AS $$
	
	#variable_conflict use_column
	
	DECLARE 
	new_position VARCHAR;
	positionchanged VARCHAR;
	
	BEGIN
	positionchanged = NEW.position;
	
	IF NEW.position='HOD' THEN
		new_position = CONCAT(NEW.dept,' ',NEW.position);
		UPDATE positionsrecord 
		SET enddate=current_date 
		WHERE position=new_position;

		UPDATE users 
		SET position='Faculty' 
		WHERE position=positionchanged and dept=NEW.dept;

		INSERT INTO positionsrecord (userid,position,startdate,time) 
		VALUES(NEW.userid,new_position,current_date,now());
	
	ELSE
		Update positionsrecord SET enddate=current_date WHERE position=positionchanged;
		UPDATE users SET position='Faculty' WHERE position=positionchanged ;
		INSERT INTO positionsrecord (userid,position,startdate,time) VALUES(NEW.userid,positionchanged,current_date,now());
	END IF;
	
	RETURN NEW;
	END;
	$$ LANGUAGE plpgsql;

CREATE TRIGGER appointing
	BEFORE UPDATE
	ON users
	FOR EACH ROW
	WHEN (OLD.position='Faculty')
	EXECUTE PROCEDURE appoint();