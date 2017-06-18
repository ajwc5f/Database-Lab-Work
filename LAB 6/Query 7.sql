SELECT fname, lname FROM person INNER JOIN body_composition USING (pid) WHERE (age > 30) 
INTERSECT
SELECT fname, lname FROM person INNER JOIN body_composition USING (pid) WHERE (height > 65);
