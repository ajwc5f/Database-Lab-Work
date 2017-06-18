SELECT pid FROM participated_in WHERE activity_name = 'running' 
UNION 
SELECT pid FROM participated_in WHERE activity_name = 'racquetball'