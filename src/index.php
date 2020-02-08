<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

//*********************************************************
// *** Include Section
//*********************************************************
require_once "class/Database.php";
require_once "class/Library.php";
require_once "class/Book.php";

$db = new DataBase();

/* init */
$admin = false;
$cdlanguage = "NL";
$selected_language = null;
if (isset($_GET['language']) and $_GET['language'] !== "ALL"){
	$selected_language = $_GET['language'];
}
unset($_GET['language']);

$params = array_keys($_GET);
foreach($params as $param){
	if ($param !== "admin" and isset($_GET[$param])){
		${$param} = $_GET[$param];
	}
}
if (isset($_GET["admin"]) and $_GET["admin"] == 1){
	$admin = true;
}

switch ($selected_language){
	case "EN":
		$backlog		= "Backlog";
		$inprogress		= "Reading";
		$done			= "Done";
		$backlog		= "Backlog";
		$formtitle		= "My Books";
		$formsubtitle	= "Only English books.";
		$alltitles		= "All Titles";
		$nltitles		= "Dutch Only";
		$entitles		= "English Only";
		$titlebuttonshow	= "Show Titles";
		$titlebuttonhide	= "Hide Titles";
		$totalpages			= " pages";
		$totalbooks			= " books read, totalling ";
		$languagelabel		= "Show me";
		break;
	default :
		$backlog		= "Op de stapel";
		$inprogress		= "Aan het lezen";
		$done			= "Gelezen";
		$formtitle		= "Mijn Boekenlijst";
		$formsubtitle	= ($selected_language === "NL" ? "Alleen Nederlandse boeken." : "");
		$alltitles		= "Alle Titels";
		$nltitles		= "Alleen Nederlands";
		$entitles		= "Alleen Engels";
		$titlebuttonshow	= "Toon Titels";
		$titlebuttonhide	= "Verberg Titels";
		$totalpages			= " pagina's";
		$totalbooks			= " boeken gelezen, in totaal ";
		$languagelabel		= "Toon mij";
		break;
}

/* init */
$booksInLibraryObj = new Library();
$booksInLibraryObj->getBooks($selected_language, "B");
$booksInLibrary = $booksInLibraryObj->createTiles($admin, "B", $selected_language);

$booksInProgressObj = new Library();
$booksInProgressObj->getBooks($selected_language, "I");
$booksInProgress = $booksInProgressObj->createTiles($admin, "I", $selected_language);
$numberOfBooksInProgress = $booksInProgressObj->getNumberOfBooks();

$booksDoneObj = new Library();

?>
<!doctype html>
<html>
<head>
	<title>Boekenlijst van Dennis Vorst</title>
      <meta name="description" content="Free Web tutorials">
	  <meta name="keywords" content="boeken, boekenlijst, schrijver, beoordeling, inspiratie">
	  <meta name="author" content="Dennis Vorst">

	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script language="javascript">
    /* show or hide the table rows*/
    function toggleRows(v_elementid, v_displayid){
        /* show or display the element */
        var v_element = document.getElementById(v_elementid);
        var v_text = document.getElementById(v_displayid);

        if(v_element.style.display == "table-row") {
            v_element.style.display = "none";
            v_text.innerHTML = "<?php echo $titlebuttonshow; ?>";
        }
        else {
            v_element.style.display = "table-row";
            v_text.innerHTML = "<?php echo $titlebuttonhide; ?>";
        }
    }
    </script>

	<!-- initiate font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

	<link rel="stylesheet" href="css/books.css">
</head>
<body>
<div id="outer" class="container">
    <header class="text-center">
		<h1><?php echo $formtitle; ?></h1>
		<p><?php echo $formsubtitle; ?></p>
    </header>
    <nav>
    	<form id="select_language" >
        <?php echo $languagelabel; ?>:
        <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-primary<?php echo (empty($selected_language) ? " active" : "");?>">
	            <input type="radio" name="language" autocomplete="off" value="ALL" onChange="document.getElementById('select_language').submit();"><?php echo $alltitles; ?>
			</label>
            <label class="btn btn-primary<?php echo ($selected_language === "NL" ? " active" : "");?>">
	            <input type="radio" name="language" autocomplete="off" value="NL" onChange="document.getElementById('select_language').submit();"><?php echo $nltitles; ?>
			</label>
            <label class="btn btn-primary<?php echo ($selected_language === "EN" ? " active" : "");?>">
	            <input type="radio" name="language" autocomplete="off" value="EN" onChange="document.getElementById('select_language').submit();"><?php echo $entitles; ?>
            </label>
        </div>
        </form>
    </nav>
	<main>
    	<!-- start admin section -->
<?php
if ($admin){
	$bookObj = new Book();
	$bookObj->editBook();
}
?>
    	<!-- end admin section -->
        <div class="alert alert-danger col-md-4">
            <h1 class="text-center"><?php echo $backlog; ?></h1>

			<?php
			createBacklogTable($booksInLibrary, $numberOfBooksInProgress, $titlebuttonshow);
			?>
        </div>
        <div class="alert alert-warning col-md-4 col-centered">
            <h1 class="text-center"><?php echo $inprogress; ?></h1>
            <!-- Titles -->
            <div>
	        <!-- Start getting the in progress items -->
            <?php
			foreach ($booksInProgress as $book){
				echo $book;
			}
            ?>
	        <!-- Done getting the in progress items -->
            </div>
        </div>
        <div class="alert alert-success col-md-4 col-centered">
            <h1 class="text-center"><?php echo $done; ?></h1>
			<?php
			echo getBooksDone($booksDoneObj, $admin, $selected_language, $titlebuttonshow, $totalbooks, $totalpages);
			?>
        </div>
    </main>
    <footer>
    </footer>
</div>
</body>
</html>

<?php

function createBacklogTable($books, $count, $titlebuttonshow){
?>
<table width="100%">
    <!-- As much of the backlog as i am currently reading -->
    <tr>
        <td>
        <?php
		while($count > 0){
			echo $books[0];
			unset($books[0]);
			$books = array_values($books);
			$count--;
		}
		?>
        </td>
    </tr>
	<!-- The rest of it -->
	<?php
	if (count($books) > 0){
	?>
    <tr>
    	<td class="text-center">
			<button id="displayBacklog" type="button" class="btn btn-danger" onClick="javascript:toggleRows('Backlog', 'displayBacklog');"><?php echo $titlebuttonshow; ?></button>
        </td>
	</tr>
    <tr id="Backlog" style="display: none">
        <td colspan="2">
            <!-- Titles -->
            <div>
            <!-- Start getting the backlog items -->
            <?php
			foreach ($books as $book){
				echo $book;
			}
            ?>
            <!-- Done getting the backlog items -->
            </div>
        </td>
    </tr>
    <?php
	}
	?>
</table>
<?php
}

function getNumberOfDays(int $year) : int
{
	$start = new DateTime($year . "-01-01");
	$today = new DateTime();
	if ($year != $today->format("Y"))
	{
		$today = new DateTime($year . "-12-31");
	}
	return $today->diff($start)->format("%a");
}

function getBooksDone(Library $booksDoneObj, string $admin, string $selected_language = null, $titlebuttonshow, $totalbooks, $totalpages) : string
{
//	$ftrows = $booksDoneObj->getReadBooks($selected_language);

	$years = $booksDoneObj->getYears();
	$html	= "";
	foreach($years as $year){
		/* get the totals */
		$result = $booksDoneObj->countReadBooksPerYear($selected_language, $year);
		$bookcount = $result['books'];

		/* get the books finished that year */
		$books = $booksDoneObj->getAllBooksReadPerYear($selected_language, $year);
		$pagescount = $result['pages'];
		$pagesaverage = number_format(($pagescount/getNumberOfDays($year)), 0);

		$html	.= "<table width='100%'>\n";
		$html	.= "  <tr>\n";
		$html	.= "    <td class='text-center'>\n";
		$html	.= "      <h2>" . $year . "</h2>\n";
		$html	.= "      <p>" . $bookcount . $totalbooks . $pagescount . $totalpages . " (" . $pagesaverage . " p.p.d.)</p>\n";

		$html	.= "    </td>\n";
		$html	.= "  </tr>\n";

		$html	.= "  <tr>\n";
		$html	.= "    <td class='text-center'>\n";

		$html	.= "      <button id='display" . $year . "' class='btn btn-success' onClick=\"javascript:toggleRows('" . $year . "', 'display" . $year . "');\" >" . $titlebuttonshow . "</button>\n";
		$html	.= "    </td>\n";
		$html	.= "  </tr>\n";
		$html	.= "  <tr id='" . $year . "' style='display: none'>\n";
		$html	.= "    <td>\n";
		foreach ($books as $book){
			$html.= $book->createTile($admin, "D", $selected_language);
		}
		$html	.= "    </td>\n";
		$html	.= "  </tr>\n";
		$html	.= "</table>\n";
	}

	return $html;
}
?>
