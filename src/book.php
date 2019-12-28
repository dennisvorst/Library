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
require_once "class/Books.php";
require_once "class/Database.php";
$db = new DataBase();
$booksObj = new Books($db);

$admin = 0;
$id = $_GET['id'];
if(isset($_GET['admin'])){
	$admin = $_GET['admin'];
}

if (empty($id)){
	return;
} else {
	$idbook = $id;
	$ftrow = $booksObj->getBook($idbook);
	$nmfile	= $booksObj->getImage($idbook);
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
	<title><?php echo $ftrow['nmtitle'] . " - " . $ftrow['nmauthor']; ?></title>
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

	    <div class="row">
            <h1><?php echo $ftrow['nmtitle']; ?></h1>
			<?php
            if (!empty($ftrow['nmsubtitle'])){
                echo "<h1>" . $ftrow['nmsubtitle'] . "</h1>";
            }
            ?>
            <h2><?php echo $ftrow['nmauthor']; ?></h2>
        </div>
	    <div class="row">
            <img src="<?php echo $nmfile; ?>" alt="<?php echo $ftrow['nmtitle']; ?> cover">
        </div>
	    <div class="row">
            <p>ISBN <?php echo $ftrow['nrisbn']; ?></p>
            <p><?php echo $ftrow['nrpages'] . " " . $pageslabel; ?></p>
        </div>
        <?php
		if (!empty($ftrow['nrorderbol'])){
        ?>
	    <div class="row">
			<a target="_blank" href="https://partnerprogramma.bol.com/click/click?p=1&amp;t=url&amp;s=53053&amp;f=BTN&amp;url=https%3A%2F%2Fwww.bol.com%2Fnl%2Fp%2F<?php echo spacesToHyphen($ftrow['nmtitle']); ?>%2F<?php echo $ftrow['nrorderbol']; ?>%2F%3FsuggestionType%3Dtypedsearch&amp;name=<?php echo spacesToTwenty($ftrow['nmtitle']); ?>" target="_blank"><img id="promobtn" src="<?php echo $buttonimage; ?>" title="<?php echo $buttonlabel; ?>" alt="<?php echo $buttonlabel; ?>"></a>
        </div>
		<?php
		}

		/* review part only show the review when it is read. ie cdstatus = Done */
		$bookstates = $booksObj->getBookStates($idbook);
		foreach ($bookstates as $bookstate)
		{

			if ($admin){
				if (empty($bookstate['dtfinished']))
				{
					{
						?>
						<form action="administrator/edit_book.php" enctype="multipart/form-data" method="GET">
							<div class="form-group">
								<label for="ftreview">Review</label>
								<textarea class="form-control" rows="5" id="ftreview" name="ftreview"><?php echo $bookstate['ftreview']; ?></textarea>
							</div>
							<div>
								<input id="idbook" name="idbook" type="hidden" value="<?php echo $bookstate['idbook']; ?>">
								<input id="nmaction" name="nmaction" type="hidden" value="update">
							</div>
	
							<button type="submit" class="btn btn-default">Submit</button>
						</form>
						<?php
					}
				}
			} else {
				$review = $bookstate['ftreview'];
				if (!empty($review)){
				?>
				<div class="row">
					<h2>Review</h2>
					<?php echo $review; ?>
				</div>
				<?php
				}
			}
		}
		
		?>

	</div>
</body>
</html>
