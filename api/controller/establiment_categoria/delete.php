<?php
// Headers
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
include_once '../../models/establiment_categoria.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//establiment_categoria object
$establiment_categoria = new establiment_categoria($dbConn);

//Get establiment_categoria properties
if (isset($_REQUEST['Establiment_id'])) {
    $establiment_categoria->setEstabliment_id($_REQUEST['Establiment_id']);
}else{
    die();
}

//Delete establiment_categoria
if ($establiment_categoria->delete()){
    echo json_encode(array('result' => '1'));
} else {
	echo json_encode(array('result' => '0'));
}
?>