<?php
// Headers
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
include_once '../../models/establiment.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment = new establiment($dbConn);

if (isset($_REQUEST['nom'])) {
	$establiment->setNom($_REQUEST['nom']);
} else {
	die();
}

//Establiments array;
$establiments_arr = array();


$result = $establiment->readByNom();

while ($row = $result->fetch_assoc()){
    $establiment_item = array(
        'id' => $row['id'],
        'nom' => $row['nom'],
        'correu_electronic' => $row['correu_electronic'],
        'num_comensals' => $row['num_comensals'],
        'telefon' => $row['telefon'],
		'poblacio_id' => $row['Poblacio_id'],
		'password' => $row['password'],
		'descripcio' => $row['descripcio']
    );
    array_push($establiments_arr, $establiment_item);
}

//Return JSON
echo json_encode($establiments_arr);

?>