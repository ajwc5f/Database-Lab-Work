SELECT fname, lname FROM person WHERE uid IN (
	SELECT university.uid FROM university WHERE city = "Columbia");