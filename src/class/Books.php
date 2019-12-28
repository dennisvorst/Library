<?php
class Books{
	function __construct(){}
	
	function get_book($db, $admin, $id){
		/** get a book filtered by id */
		$booklist	= "";
		$ftquery 	= "SELECT * FROM books WHERE idbook = " . $id;
		return $db->queryDb($ftquery);
	}
	
	function getImage($idbook){
		/* the image */
		$nmimage = "./covers/" . $idbook;
		if (file_exists($nmimage . ".jpg")){
			$nmimage .= ".jpg";
		} elseif (file_exists($nmimage . ".gif")){
			$nmimage .= ".gif";
		}
        return $nmimage;
	}

	function get_books($db, $admin, $cdstatus){
		/** get a list of books filtered by status */
		$booklist	= "";
		$ftquery 	= "SELECT * FROM books WHERE CDSTATUS = '" . $cdstatus . "' ";
		switch($cdstatus){
			case "B":
				$ftquery	.= "ORDER BY nmtitle, nmsubtitle, nmauthor";
				break;
			case "D":
				$ftquery	.= "ORDER BY dtfinished DESC";
				break;
		}
		$ftrows		= $db->queryDb($ftquery);
	
		foreach ($ftrows as $ftrow){
			$idbook	= $ftrow['idbook'];
			?>
			
			<div id="book<?php echo $idbook; ?>" class="row item">
				<div>
					<?php
					if ($admin){
					?><header>
						<a class="btn btn-danger" href="administrator/edit_book.php?nmaction=delete&idbook=<?php echo $idbook; ?>"><i class="fa fa-trash-o fa-lg"></i></a>
						<a class="btn btn-primary" href="administrator/edit_book.php?nmaction=move&idbook=<?php echo $idbook; ?>"><i class="fa fa-play fa-lg"></i></a>
						<a class="btn btn-primary" href="administrator/edit_book.php?nmaction=edit&idbook=<?php echo $idbook; ?>"><i class="fa fa-pencil-square-o fa-lg"></i></a>
					</header>
					<?php } ?>
	
					<div class="row">
						<div class="col-md-4 text-center">
							<img src="<?php echo $this->getImage($idbook); ?>" class="bookcover">
						</div>
						<div class="col-md-6 booktitle">
							<p class="title"><?php
							echo $ftrow['nmtitle'];
							if (!empty($ftrow['nmsubtitle'])){
								echo "<br/>" . $ftrow['nmsubtitle'];
							}
							?></p>
							<p class="author"><?php echo $ftrow['nmauthor']; ?></p>
							<small>ISBN <?php echo $ftrow['nrisbn']; ?><br/><?php echo $ftrow['nrpages']; ?> pag.</small>
							<br />
						</div>
					</div>
					<hr>
				</div>
			</div>
			<?php
		}
	}
} 
?>