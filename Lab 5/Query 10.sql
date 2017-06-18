SELECT countrylanguage.language, country.name, country.Population, countrylanguage.Percentage FROM countrylanguage INNER JOIN country ON countrylanguage.countrycode = country.code WHERE countrylanguage.isofficial = 'T' ORDER BY (countrylanguage.Percentage*country.Population/100) DESC;