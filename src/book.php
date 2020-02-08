<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

$selected_language = "";
if (isset($_GET['selected_language'])){
	$selected_language	= $_GET['selected_language'];
}

switch($selected_language){
	case "EN":
		$backlink		= "Back to the hompeage";
		$pageslabel		= "pages";
		$buttonlabel	= "Buy at bol.com";
		$buttonimage	= "images/btn_promo_buy_dark_large.png";
		break;
	default:
		$backlink		= "Terug naar de hoofdpagina";
		$pageslabel		= "pagina's";
		$buttonlabel	= "Koop bij bol.com";
		$buttonimage	= "https://www.bol.com/nl/upload/partnerprogramma/promobtn/btn_promo_koop_dark_large.png";
}

//*********************************************************
// *** Include Section
//*********************************************************
require_once "class/Database.php";
require_once "class/Book.php";

$db = new DataBase();
//$libraryObj = new Library($db);

$admin = 0;
$id = $_GET['id'];
if(isset($_GET['admin'])){
	$admin = $_GET['admin'];
}

if (empty($id)){
	return;
} else {
	$idbook = $id;
	$bookObj = new Book($db, $id);
}

function spacesToTwenty($input){
	/* translate spaces to %20 */
	return strtr($input, array(" "=>"%20"));
}
function spacesToHyphen($input){
	/* translate spaces to %20 */
	return strtr($input, array(" "=>"-"));
}

?>
<!doctype html>
<html>
<head>
	<title><?php echo $bookObj->getTitle() . " - " . $bookObj->getAuthor(); ?></title>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- initiate font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

	<link rel="stylesheet" href="css/books.css">
</head>
<body>
	<div class="container text-center">
		<?php 
		if ($admin)
		{
			$bookObj->editBook();
		} else {
			echo $bookObj->showBook();
		}
		?>
	</div>
</body>
</html>
