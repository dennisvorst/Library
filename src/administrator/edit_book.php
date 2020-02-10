<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

//*********************************************************
// *** Include Section
//*********************************************************
require_once "../class/Database.php";
require_once "../class/Book.php";

$nmaction	= $_GET['nmaction'];
$idbook		= $_GET['idbook'];

$db = new DataBase();
$bookObj = new Book($db, $idbook);


switch($nmaction){
	case "startReading":
		$bookObj->startReading();
		break;
	case "StopReading":
		$bookObj->stopReading();
		break;
	case "finishReading":
		$bookObj->finishReading();
		break;
	case "delete":
		$sql = "DELETE FROM books WHERE idbook = " . $idbook;
		$ftrow = $db->updateDb($sql);
		break;
	case "edit":
		$sql = "SELECT * FROM books WHERE idbook = " . $idbook;
		$ftrow = $db->queryDb($sql);
		$ftrow = $ftrow[0];

		$fields	= array_keys($ftrow);
		$query	= "";
		foreach ($fields as $field){
			$query .= "&" . $field . "=" . $ftrow[$field];
		}

		$url = $_SERVER['HTTP_REFERER'] . $query;
		header('Location: ' . $url);

		break;
		
	case "update":
		$review = $_GET['ftreview'];
		if (empty($review)){
			$sql = "UPDATE books SET ftreview = NULL WHERE idbook = " . $idbook;
		} else {
			$sql = "UPDATE books SET ftreview = '" . $review . "' WHERE idbook = " . $idbook;
		}
		$ftrow = $db->updateDb($sql);
		$ftrow = $ftrow[0];
		
//		print_r($_GET);
	case "store":
}

/* redirect to the root path */
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>