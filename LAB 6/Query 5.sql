SELECT activity_name FROM activity WHERE activity_name NOT IN (
	SELECT participated_in.activity_name FROM participated_in);