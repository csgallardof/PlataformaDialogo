<?php
//setting header to json
header('Content-Type: application/json');
//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'inteligencia');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("select solucions.responsable_solucion, count(actividades.id) as total
from solucions
inner join actor_solucion on solucions.id = actor_solucion.solucion_id
inner join actividades on solucions.id = actividades.solucion_id
inner join users on actor_solucion.user_id = users.id
where solucions.sector_id = 7
group by solucions.responsable_solucion order by total desc");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
