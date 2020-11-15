<?php
/* for testing purposes */
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

/* include section */
require_once "../class/MysqlTable.php";

/*** init ***/
$fturl = "";

//print_r($_GET);
//print_r($_POST);

/*** get the variables ***/
$ftkeys = array_keys($_POST);
foreach ($ftkeys as $key){
	${$key} = $_POST[$key];
}

/* create the MysqlTable object */
$tableObject	= new MysqlTable($nmtable);
if (empty($tableObject)) {print_r("Table Object is empty<br/>");}

/* get the primary key */
$ftprimarykey 	= $tableObject->getPrimaryKeyField();
if (empty($ftprimarykey)) {print_r("Primary key not allowed to be empty<br/>");}


switch ($mode){
	case "Store":
		/* find the updated records and store them */
		$ftfields = $tableObject->getFieldNames();
		if (empty($ftfields)) {print_r("Field list is empty<br/>");}

		/* calcultate the number of records present by determining the number of primary keys */
		$nrtotrecs = 1;
		while (array_key_exists($ftprimarykey . $nrtotrecs, $_POST)){
			$nrtotrecs++;
		}

		/* step through the records */
		for ($i=0; $i < $nrtotrecs; $i++){
			/* create a single record string */
			$ftvalues = array();
			for ($j=0; $j < count($ftfields); $j++){
				/* we are using the index i since that represents the current record we are looking at. */
				if (array_key_exists($ftfields[$j] . $i, $_POST)){
					$ftvalues[$ftfields[$j]] = $_POST[$ftfields[$j] . $i];
				} else {
					/* it is probably a boolean that did not change value  */
					$ftvalues[$ftfields[$j]]	= 0;
				}
			}

			/* if the PK value is empty perform an insert */
			if (empty($_POST[$ftprimarykey . $i])){
				/* insert, the id of the recors is returned to the primary key field in the POST parameters. */
				$POST[$ftprimarykey . $i] = $tableObject->insertOccurence($ftvalues);
			} else {
				/* update */
				$tableObject->updateOccurence($ftvalues);
			}
		}//endfor

		/* then redirect it to the single record via the index.php */
		/* create the header */
		/* after the store we always return to the full table */
		$ftkeys = array("nmtable", "mode", "nmorderby");
		foreach ($ftkeys as $ftkey){
			if (array_key_exists($ftkey, $_POST)){
				if (empty($fturl)){
					$fturl = $ftkey . "=" . $_POST[$ftkey];
				} else {
					$fturl .= "&" . $ftkey . "=" . $_POST[$ftkey];
				}
			}
		}
//		break;
		$_POST['mode']	= "update";

	case "update";
		/* create the url */
		$ftkeys = array("nmtable", "mode", "nmorderby");
		foreach ($ftkeys as $ftkey){
			if (array_key_exists($ftkey, $_POST)){
				if (empty($fturl)){
					$fturl = $ftkey . "=" . $_POST[$ftkey];
				} else {
					$fturl .= "&" . $ftkey . "=" . $_POST[$ftkey];
				}
			}
		}
		break;


	case "Delete":
		/* filter the ids for deletion */

		/* make a list of PK numbers for deletion */
		$i =1;
		while (array_key_exists($ftprimarykey . $i, $_POST)){
			/* only delete where the check is on. */
			if (array_key_exists("check" . $i, $_POST)){
//				$entityObj->deleteOccurence($_POST[$ftprimarykey . $i]);
				$tableObject->deleteOccurence($_POST[$ftprimarykey . $i]);
			}
			$i++;
		}

		/* redirect back to the list of records from that particular table via index.php */
		/* create the header */
		$ftkeys = array("nmtable", "nmorderby");
		foreach ($ftkeys as $ftkey){
			if (array_key_exists($ftkey, $_POST)){
				if (empty($fturl)){
					$fturl = $ftkey . "=" . $_POST[$ftkey];
				} else {
					$fturl .= "&" . $ftkey . "=" . $_POST[$ftkey];
				}
			}
		}
		break;

	case "Cancel":
		/* redirect back to the list of records from that particular table via index.php */
		/* create the header */
		$ftkeys = array("nmtable", "nmorderby");
		foreach ($ftkeys as $ftkey){
			if (empty($fturl)){
				$fturl = $ftkey . "=" . $_POST[$ftkey];
			} else {
				$fturl .= "&" . $ftkey . "=" . $_POST[$ftkey];
			}
		}
		break;

	default:
		break;
}
/**
[PHP_SELF] => /admin/process_input.php	- contains the current file
[HTTP_REFERER] => http://boeken.dennisvorst.nl/
- contains the refering file, may be empty when the script file is refered directly.
- We are referring to eihter the index.php in the root or in the admin file.
[SERVER_NAME] => boeken.dennisvorst.nl			- is the name of the server we are working on
So if the NAME_REFERER name looks like the "http://" . $_SERVER[HTTP_REFERER] . "/" we refer back to index.php otherwise we go to admin/index.php.
- So how do i refer to a file on folder up?
- apparently the referer can also contain the querystring after the ?.
*/
$nmfile = $_SERVER['HTTP_REFERER'];
$nrpos = strpos($_SERVER['HTTP_REFERER'], "?");
if ($nrpos > 0) {
	$nmfile =  substr($nmfile, 0, $nrpos);
}
if (!strpos($_SERVER['HTTP_REFERER'], "index.php")){
	$nmfile = $_SERVER['HTTP_REFERER'] . "index.php";
}
header("Location: " . $nmfile . "?" . $fturl);
//print_r($nmfile . "?" . $fturl);

?>