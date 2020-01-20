<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');  //On or Off

//*********************************************************
// *** Include Section
//*********************************************************
require_once "class/Database.php";
require_once "class/Books.php";

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
$booksBacklog = getBooksBacklog($db, $admin, $selected_language);
$booksInProgress = getBooksInProgress($db, $admin, $selected_language);
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
	createAdminPart($cdlanguage);
}
?>
    	<!-- end admin section -->
        <div class="alert alert-danger col-md-4">
            <h1 class="text-center"><?php echo $backlog; ?></h1>
        
        	<?php createBacklogTable($booksBacklog, count($booksInProgress), $titlebuttonshow); ?>
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
			<?php echo getBooksDone($db, $admin, $selected_language, $titlebuttonshow, $totalbooks, $totalpages); ?>
        </div>
    </main>
    <footer>
    </footer>
</div>
</body>
</html>

<?php
/***  Tiles section ***/
function createTiles($admin, $ftrows, $selected_language){
	$books = [];	
	foreach ($ftrows as $ftrow){
		$books[] = createTile($admin, $ftrow, $selected_language);
	}
	return $books;
}

function createTile($admin, $ftrow, $selected_language){
    $idbook	= $ftrow['idbook'];
    /* the image */
	
	$booksObj	= new Books();
	$nmfile	= $booksObj->getImage($idbook);
	
	$html	= "<div id='book" . $idbook . "' class='row item'>\n";
	$html	.= "  <div>\n";
	if ($admin){
    	$html	.= "    <header>\n";
		$html	.= "      <a class='btn btn-danger' href='administrator/edit_book.php?nmaction=delete&idbook=" . $idbook . "'><i class='fa fa-trash-o fa-lg'></i></a>\n";
		$html	.= "      <a class='btn btn-primary' href='administrator/edit_book.php?nmaction=moveback&idbook=" . $idbook . "'><i class='fa fa-arrow-left fa-lg'></i></a>\n";
		$html	.= "      <a class='btn btn-primary' href='administrator/edit_book.php?nmaction=moveforward&idbook=" . $idbook . "'><i class='fa fa-arrow-right fa-lg'></i></a>\n";
		$html	.= "      <a class='btn btn-primary' href='administrator/edit_book.php?nmaction=edit&idbook=" . $idbook . "'><i class='fa fa-pencil-square-o fa-lg'></i></a>\n";
		$html	.= "    </header>\n";
	}
	
	$href	= "book.php?id=" . $idbook . (empty($selected_language) ? "" : "&selected_language=" . $selected_language ) . "";
	
	$html	.= "    <div class='row'>\n";
	$html	.= "      <div class='col-md-4 text-center'>\n";
	$html	.= "        <a href='" . $href . "'>\n";
	$html	.= "          <img src='" . $nmfile . "' class='bookcover'>\n";
	$html	.= "        </a>\n";
	$html	.= "      </div>\n";
	$html	.= "      <div class='col-md-6 booktitle'>\n";
	$html	.= "        <a href='" . $href . "'>\n";
	$html	.= "          <p class='title'>" . $ftrow['nmtitle'];
    if (!empty($ftrow['nmsubtitle'])){
        $html	.= "<br/>" . $ftrow['nmsubtitle'];
    }
	$html	.= "</p>\n";
	$html	.= "          <p class='author'>" . $ftrow['nmauthor'] . "</p>\n";
	$html	.= "<small>ISBN " . $ftrow['nrisbn'] . "<br/>" . $ftrow['nrpages'] . " pag.</small>\n";
	$html	.= "        </a>\n";
	$html	.= "        <br />\n";
	$html	.= "      </div>\n";
	$html	.= "    </div>\n";
	$html	.= "    <hr>\n";
	$html	.= "  </div>\n";
	$html	.= "</div>\n";
	
	return $html;
}

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

function createAdminPart($cdlanguage){
	?>
    <form action="administrator/submit_book.php" enctype="multipart/form-data" method="POST">
        <div class="form-group">
            <label for="nmtitle">Title</label>
            <input type="text" id="nmtitle" name="nmtitle" class="form-control"<?php
            if(isset($nmtitle)){
                echo " value='" . $nmtitle . "'";
            }
            ?>>
        </div>
        <div class="form-group">
            <label for="nmsubtitle">Sub Title</label>
            <input type="text" id="nmsubtitle" name="nmsubtitle" class="form-control"<?php
            if(isset($nmsubtitle)){
                echo " value='" . $nmsubtitle . "'";
            }
            ?>>
        </div>
        <div class="form-group">
            <label for="nmauthor">Auteur</label>
            <input type="text" id="nmauthor" name="nmauthor" class="form-control"<?php
            if(isset($nmauthor)){
                echo " value='" . $nmauthor . "'";
            }
            ?>>
        </div>
        <div class="form-group">
            <label for="nrisbn">ISBN</label>
            <input type="text" id="nrisbn" name="nrisbn" class="form-control"<?php
            if(isset($nrisbn)){
                echo " value='" . $nrisbn . "'";
            }
            ?>>
        </div>
        <div class="form-group">
            <label for="nrpages">Aantal Pagina's</label>
            <input type="text" id="nrpages" name="nrpages" class="form-control"<?php
            if(isset($nrpages)){
                echo " value='" . $nrpages . "'";
            }
            ?>>
        </div>
        <div class="form-group">
            <label for="nrorderbol">Bol.com bestelnummer</label>
            <input type="text" id="nrorderbol" name="nrorderbol" class="form-control"<?php
            if(isset($nrorderbol)){
                echo " value='" . $nrorderbol . "'";
            }
            ?>>
        </div>
        <div class="form-group">
            <label for="cdlanguage">Taal</label>
            <select id="cdlanguage" name="cdlanguage" class="form-control">
                <option value="NL"<?php
                if(!isset($nmtitle) or $cdlanguage==="NL"){
                    echo " selected";
                }
            ?>>Nederlands</option>
                <option value="EN"<?php
                if($cdlanguage==="EN"){
                    echo " selected";
                }
            ?>>Engels</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cdkeep">Houden</label>
            <select id="cdkeep" name="cdkeep" class="form-control">
                <option value="1" selected>Houden</option>
                <option value="0">Weggeven</option>
            </select>
        </div>
        <!-- upload the image -->
        <div class="form-group">
            <label for="cdimage">Selecteer een afbeelding</label>
            <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
            <input type="file" id="fileselect" name="fileselect[]" accept="image/jpeg" />
        </div>
        
        <!-- hidden stuff -->
        <input type="hidden" id="cdkeep" name="cdkeep"<?php
            if(isset($nmtitle)){
                echo " value='" . $cdkeep . "'";
            } else {
                echo " value='1'";
            }
            ?>>
        <input type="hidden" id="cdstatus" name="cdstatus"<?php
            if(isset($nmtitle)){
                echo " value='" . $cdstatus . "'";
            } else {
                echo " value='B'";
            }
            ?>>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <?php
}


/** data retrieval **/
function getBooksBacklog($db, $admin, $selected_language){
	$booksObj = new Books($db);
	$ftrows = $booksObj->getLibrary($selected_language);

	return createTiles($admin, $ftrows, $selected_language);
}

function getBooksInProgress($db, $admin, $selected_language){
	$booksObj = new Books($db);
	$ftrows = $booksObj->getCurrentlyReading($selected_language);

	return createTiles($admin, $ftrows, $selected_language);
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

function getBooksDone($db, $admin, $selected_language, $titlebuttonshow, $totalbooks, $totalpages){
	$booksObj = new Books($db);
	$ftrows = $booksObj->getReadBooks($selected_language);

	$years = [];
	foreach ($ftrows as $ftrow){
		$dtfinished = DateTime::createFromFormat("Y-m-d", $ftrow['dtfinished']);
		$years[]	= $dtfinished->format("Y");
	}
	$years	= array_unique($years);
	
	$html	= "";
	foreach($years as $year){
		/* get the totals */
		$result = $booksObj->countReadBooksPerYear($selected_language, $year); 
		$bookcount = $result[0]['books'];

		/* get the books finished that year */
		$books = $booksObj->getAllBooksReadPerYear($selected_language, $year);
		$pagescount = $result[0]['pages'];
		$pagesaverage = number_format(($pagescount / getNumberOfDays($year)), 0);

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
			$html.= createTile($admin, $book, $selected_language);
		}
		$html	.= "    </td>\n";
		$html	.= "  </tr>\n";
		$html	.= "</table>\n";
	}
	
	return $html;
}
?>
