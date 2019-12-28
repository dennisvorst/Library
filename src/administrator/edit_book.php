<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

//*********************************************************
// *** Include Section
//*********************************************************
require_once "../class/Database.php";
$db = new DataBase();

$nmaction	= $_GET['nmaction'];
$idbook		= $_GET['idbook'];

switch($nmaction){
	case "delete":
		$sql = "DELETE FROM books WHERE idbook = " . $idbook;
		$ftrow = $db->updateDb($sql);
		break;
	case "moveback":
		/* only reset books that have status in progress. */
		$sql	= "UPDATE books SET cdstatus = 'B' WHERE cdstatus = 'I' AND idbook = " . $idbook;
		$ftrow = $db->updateDb($sql);
		break;

	case "moveforward":
		/* get the record */
		$sql = "SELECT * FROM books WHERE idbook = " . $idbook;
		$ftrow = $db->queryDb($sql);

		/*
		if the status is Backlog move it to In Progress.
		if the status is In Progress move it to Done.
		*/
		$cdstatus	= $ftrow[0]['cdstatus'];
		$values = "";
		switch($cdstatus){
			case "B":
				$values = "cdstatus = 'I', dtstart = '" . date('Y-m-d') . "'";
				break;
			case "I":
				$values = "cdstatus = 'D', dtfinished = '" . date('Y-m-d') . "'";
				break;
			default:
				$values = "cdstatus = 'B'";
		}

		/* update the record */
		$sql	= "UPDATE books SET " . $values . " WHERE idbook = " . $idbook;

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
		
		print_r($_GET);
	case "store":
}

/* redirect to the root path */
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>