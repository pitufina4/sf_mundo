

SELECT pa.nombre FROM mundo.pais pa
INNER JOIN mundo.presidente pe
INNER JOIN mundo.region r
ON pa.id = pe.pais_id and pa.id=r.pais_id;






los nombres de los paises;

SELECT pa.nombre FROM mundo.pais pa;






Localidad de mas habitantes a menos;

SELECT * FROM mundo.localidad lo
ORDER BY lo.habitantes desc;



Localidad con más habitantes;

SELECT * FROM mundo.localidad lo
ORDER BY lo.habitantes desc limit 1;




Saber el número total de provincias;

SELECT COUNT(pro.id) FROM mundo.provincia pro;



Me da el numero de habitantes de cada provincia;

SELECT pro.nombre, SUM(lo. habitantes) FROM mundo.provincia pro
INNER JOIN mundo.localidad lo ON pro.id = lo.provincia_id
GROUP BY pro.id
ORDER BY pro.nombre;



Numero total de habitantes del mundo;

SELECT SUM(lo.habitantes) FROM mundo.localidad lo;