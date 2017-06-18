SELECT university_name, city FROM university WHERE NOT EXISTS (
	SELECT uid FROM person WHERE university.uid = person.uid);