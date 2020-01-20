<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

//print_r($_FILES);
//print_r($_POST);


//*********************************************************
// *** Include Section
//*********************************************************
require_once "../class/Database.php";
$db = new DataBase();


$keys = array_keys($_POST);
foreach ($keys as $key){
	${$key} = $_POST[$key];
}

$values = "";
if (isset($idbook)){
	$values	.= $idbook;
} else {
	$values	.= "NULL";
}

if (isset($cdkeep)){
	$values	.= ", " . $cdkeep;
} else {
	$values	.= ", NULL";
}
if (isset($nmtitle)){
//	$values	.= ", '" . $nmtitle . "'";
	/* prepare the quotes for insert into the database */
	$values	.= ", '" . mysqli_real_escape_string($db->getConnection(), $nmtitle) . "'";
} else {
	$values	.= ", NULL";
}
if (isset($nmsubtitle)){
//	$values	.= ", '" . $nmsubtitle . "'";
	$values	.= ", '" . mysqli_real_escape_string($db->getConnection(), $nmsubtitle) . "'";
} else {
	$values	.= ", NULL";
}
if (isset($nmauthor)){
//	$values	.= ", '" . $nmauthor . "'";
	$values	.= ", '" . mysqli_real_escape_string($db->getConnection(), $nmauthor) . "'";
} else {
	$values	.= ", NULL";
}
if (isset($nrpages)){
	$values	.= ", " . $nrpages;
} else {
	$values	.= ", NULL";
}
if (isset($nrisbn)){
	$values	.= ", " . $nrisbn;
} else {
	$values	.= ", NULL";
}
if (isset($cdlanguage)){
	$values	.= ", '" . $cdlanguage . "'";
} else {
	$values	.= ", NULL";
}

if (isset($ftreview)){
	$values	.= ", '" . $ftreview . "'";
} else {
	$values	.= ", NULL";
}

$sql = "INSERT INTO `books` (`idbook`, `cdkeep`, `nmtitle`, `nmsubtitle`, `nmauthor`, `nrpages`, `nrisbn`, `cdlanguage`, `ftreview`) VALUES (" . $values . ")";
//print_r($sql);
/* insert the record */
$id = $db->insertRecord($sql);

/* move the image */
if (isset($id)){
	move_uploaded_file ($_FILES['fileselect']['tmp_name'][0], "../covers/" . $id . ".jpg");
}

/* redirect to the root path */
header('Location: ' . $_SERVER['HTTP_REFERER']);

?>