<?php
// Remove blow comments from header If  you are making calls from another server
/*
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
*/
error_reporting(E_ALL);
ini_set('display_errors',1);
$hostname = "localhost";
$username = "root";
$password = "root";
$dbname = "pincodes";
$q = $_GET['q'];
if(isset($q) || !empty($q)) {
	$con = mysqli_connect($hostname, $username, $password, $dbname);
    $query = "SELECT * FROM pincodes WHERE pincode LIKE '$q%'";
    $result = mysqli_query($con, $query);
    $res = array();
    while($resultSet = mysqli_fetch_assoc($result)) {
     $res[$resultSet['id']]['id'] =  $resultSet['divisionname']."-".$resultSet['egionname']."-".$resultSet['circlename']."-".$resultSet['taluk']."-".$resultSet['statename'];
     $res[$resultSet['id']]['value'] =  "Pincode: ".$resultSet['pincode'].", ".$resultSet['divisionname'].", ".$resultSet['egionname'].", ".$resultSet['circlename'].", ".$resultSet['taluk'].", ".$resultSet['statename'];
    $res[$resultSet['id']]['label'] =   "Pincode: ".$resultSet['pincode'].", ".$resultSet['divisionname'].", ".$resultSet['egionname'].", ".$resultSet['circlename'].", ".$resultSet['taluk'].", ".$resultSet['statename'];
    
    }
    if(!$res) {
    	$res[0] = 'Not found!';
    }
    echo json_encode($res);
}

?>
