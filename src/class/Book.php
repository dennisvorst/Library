<?php
require_once "Database.php";
require_once "Bookstate.php";

class Book
{
	private $_db;
	private $_idbook;
	private $_cdkeep = true;
	private $_nmtitle;
	private $_nmsubtitle;
	private $_nmauthor;
	private $_nrpages;
	private $_nrisbn;
	private $_cdlanguage = "NL";
	private $_nrorderbol;
	private $_ftreview;

	private $_filename;
	private $_bookstates;


	function __construct(Database $db = null, int $id = null)
	{
		if (empty($db))
		{
			$this->_db = new Database();
		} else {
			$this->_db = $db;
		}

		if (!empty($id))
		{
			$this->_idbook = $id;
			$this->_getBook();
			$this->_getCover();
		}
	}

	private function _getBook()
	{
		$sql 	= "SELECT * FROM books WHERE idbook = $this->_idbook";
		$row =  $this->_db->queryDb($sql);
		$this->setProperties($row[0]);
	}

	function setProperties(array $row)
	{
		$this->_idbook		= $row['idbook'];
		$this->_cdkeep		= $row['cdkeep'];
		$this->_nmtitle		= $row['nmtitle'];
		$this->_nmsubtitle	= $row['nmsubtitle'];
		$this->_nmauthor	= $row['nmauthor'];
		$this->_nrpages		= $row['nrpages'];
		$this->_nrisbn		= $row['nrisbn'];
		$this->_cdlanguage	= $row['cdlanguage'];
		$this->_nrorderbol	= $row['nrorderbol'];
		$this->_ftreview	= $row['ftreview'];
	}

	function editBook()
	{
		?>
		<form action="administrator/submit_book.php" enctype="multipart/form-data" method="POST">
			<div class="form-group">
				<label for="nmtitle">Title</label>
				<input type="text" id="nmtitle" name="nmtitle" class="form-control"<?php
				if(isset($this->_nmtitle)){
					echo " value='" . $this->_nmtitle . "'";
				}
				?>>
			</div>
			<div class="form-group">
				<label for="nmsubtitle">Sub Title</label>
				<input type="text" id="nmsubtitle" name="nmsubtitle" class="form-control"<?php
				if(isset($this->_nmsubtitle)){
					echo " value='" . $this->_nmsubtitle . "'";
				}
				?>>
			</div>
			<div class="form-group">
				<label for="nmauthor">Auteur</label>
				<input type="text" id="nmauthor" name="nmauthor" class="form-control"<?php
				if(isset($this->_nmauthor)){
					echo " value='" . $this->_nmauthor . "'";
				}
				?>>
			</div>
			<div class="form-group">
				<label for="nrisbn">ISBN</label>
				<input type="text" id="nrisbn" name="nrisbn" class="form-control"<?php
				if(isset($this->_nrisbn)){
					echo " value='" . $this->_nrisbn . "'";
				}
				?>>
			</div>
			<div class="form-group">
				<label for="nrpages">Aantal Pagina's</label>
				<input type="text" id="nrpages" name="nrpages" class="form-control"<?php
				if(isset($this->_nrpages)){
					echo " value='" . $this->_nrpages . "'";
				}
				?>>
			</div>
			<div class="form-group">
				<label for="nrorderbol">Bol.com bestelnummer</label>
				<input type="text" id="nrorderbol" name="nrorderbol" class="form-control"<?php
				if(isset($this->_nrorderbol)){
					echo " value='" . $this->_nrorderbol . "'";
				}
				?>>
			</div>
			<div class="form-group">
				<label for="cdlanguage">Taal</label>
				<select id="cdlanguage" name="cdlanguage" class="form-control">
					<option value="NL"<?php
					if($this->_cdlanguage ==="NL"){
						echo " selected";
					}
				?>>Nederlands</option>
					<option value="EN"<?php
					if($this->_cdlanguage ==="EN"){
						echo " selected";
					}
				?>>Engels</option>
				</select>
			</div>
			<div class="form-group">
				<label for="cdkeep">Houden</label>
				<select id="cdkeep" name="cdkeep" class="form-control">
				<option value="1"<?php echo ($this->_cdkeep? " selected" : "" ); ?>>Houden</option>
				<option value="0"<?php echo (!$this->_cdkeep? " selected" : "" ); ?>>Weggeven</option>
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
				if($this->_cdkeep){
					echo " value='1'";
				} else {
					echo " value='0'";
				}
				?>>
			<input type="hidden" id="cdstatus" name="cdstatus"<?php
				if(isset($nmtitle)){
					echo " value='" . $this->_cdstatus . "'";
				} else {
					echo " value='B'";
				}
				?>>
			<button type="submit" class="btn btn-default">Submit</button>
		</form>
		<?php
	}

	function showBook() : string
	{
		$nmfile = $this->_getCover();

		$html = "<div class='row'>\n";
		$html .= "  <h1>" . $this->_nmtitle . "</h1>\n";

		if (!empty($this->_nmsubtitle)){
			$html .= "  <h1>" . $this->_nmsubtitle . "</h1>\n";
		}

		$html .= "  <h2>" . $this->_nmauthor . "</h2>\n";
		$html .= "</div>\n";
		$html .= "<div class='row'>\n";
		$html .= "  <img src='" . $nmfile . "' alt='" . $this->_nmtitle . " cover'>\n";
		$html .= "</div>\n";
		$html .= "<div class='row'>\n";
		$html .= "  <p>ISBN " . $this->_nrisbn . "</p>\n";
		$html .= "  <p>" . $this->_nrpages . " pagina's</p>\n";
		$html .= "</div>\n";

		if (!empty($this->_nrorderbol)){
			$html .= "<div class='row'>\n";
			$html .= "</div>\n";
		}
		$html .= $this->_showStates();

		return $html;
	}

	private function _getCover() : string
	{
		if (empty($this->_filename))
		{
			/* the image */
			$this->_filename = "./covers/" . $this->_idbook;
			if (file_exists($this->_filename . ".jpg")){
				$this->_filename .= ".jpg";
			} elseif (file_exists($this->_filename . ".gif")){
				$this->_filename .= ".gif";
			}
		}
		return $this->_filename;
	}

	function getTitle() : string
	{
		return $this->_nmtitle;
	}

	function getAuthor() : string
	{
		return $this->_nmauthor;
	}

	private function _getStates()
	{
//		print_r("Book::_getStates</br>\n");

		if (empty($this->_bookstates))
		{
			$sql = "SELECT * FROM bookstates WHERE idbook = $this->_idbook";
			$rows =  $this->_db->queryDb($sql);

			foreach ($rows as $row)
			{
				$state = new Bookstate($this->_db, $row);
				$this->_bookstates[] = $state;
			}
		}
		return $this->_bookstates;
	}

	private function _showStates() : string
	{
//		print_r("Book::_showStates");

		$html = "";
		$states = $this->_getStates();
		print_r($states);
		foreach ($states as $state)
		{
			$html .= $state->showState();
		}
		return $html;
	}

	function createTile(bool $admin, string $cdstatus, string $selected_language = null) : string
	{
		/**
		 * B = backlog
		 * I = in progress
		 * D = done
		 */
		$href	= "book.php?id=" . $this->_idbook . (empty($selected_language) ? "" : "&selected_language=" . $selected_language ) . "";

		$html = "<div id='book" . $this->_idbook . "'  class='row item'>\n";
		$html .= "  <div>\n";

		if ($admin)
		{
			$html .= "    <header>\n";
			switch ($cdstatus)
			{
				case "B":
					$html .= "      <a class='btn btn-danger' href='administrator/edit_book.php?nmaction=deleteBook&idbook=" . $this->_idbook . "'><i class='fa fa-trash-o fa-lg'></i></a>\n";
					$html .= "      <a class='btn btn-primary' href='administrator/edit_book.php?nmaction=startReading&idbook=" . $this->_idbook . "'><i class='fa fa-arrow-right fa-lg'></i></a>\n";
					$html .= "      <a class='btn btn-primary' href='administrator/edit_book.php?nmaction=editBook&idbook=" . $this->_idbook . "'><i class='fa fa-pencil-square-o fa-lg'></i></a>\n";
					break;
				case "I":
					$html .= "      <a class='btn btn-danger' href='administrator/edit_book.php?nmaction=stopReading&idbook=" . $this->_idbook . "'><i class='fa fa-trash-o fa-lg'></i></a>\n";
					$html .= "      <a class='btn btn-primary' href='administrator/edit_book.php?nmaction=finishReading&idbook=" . $this->_idbook . "'><i class='fa fa-arrow-right fa-lg'></i></a>\n";
					$html .= "      <a class='btn btn-primary' href='administrator/edit_book.php?nmaction=editState&idbook=" . $this->_idbook . "'><i class='fa fa-pencil-square-o fa-lg'></i></a>\n";
					break;
				case "D":
					$html .= "      <a class='btn btn-primary' href='administrator/edit_book.php?nmaction=editState&idbook=" . $this->_idbook . "'><i class='fa fa-pencil-square-o fa-lg'></i></a>\n";
					break;
				break;
			}
			$html .= "    </header>\n";
		}
		$html .= "    <div class='row'>\n";
		$html .= "      <div class='col-md-4 text-center'>\n";
		$html .= "        <a href='" . $href . "'>\n";
		$html .= "          <img src='" . $this->_getCover() . "' class='bookcover'>\n";
		$html .= "        </a>\n";
		$html .= "      </div>\n";
		$html .= "      <div class='col-md-6 booktitle'>\n";
		$html .= "        <a href='" . $href . "'>\n";
		$html .= "          <p class='title'>" . $this->_nmtitle . (empty($this->_nmsubtitle) ? "" : "<br/>" . $this->_nmsubtitle) . "</p>\n";
		$html .= "          <p class='author'>" . $this->getAuthor() . "</p>\n";
		$html .= "          <small>ISBN " . $this->_nrisbn . "<br/>" . $this->_nrpages . " pag.</small>\n";
		$html .= "        </a>\n";
		$html .= "      </div>\n";
		$html .= "    </div>\n";
		$html .= "  </div>\n";
		$html .= "</div>\n";
		$html .= "<hr>\n";

		return $html;
	}

	/** states functions */
	function startReading() : void
	{
//		print_r("Book::startReading</br>\n");
		if (!$this->_isReading())
		{
			$row['idbook'] = $this->_idbook;
			$state = new Bookstate($this->_db, $row);
			$state->startReading();
		}
	}

	function stopReading() : void
	{
		if ($this->_isReading())
		{
			$state = $this->_getReadingState();
			$state->stopReading();
		}
	}

	function finishReading() : void
	{
//		print_r("Book::finishReading</br>\n");
		if ($this->_isReading())
		{
			$state = $this->_getReadingState();
			$state->finishReading();
		}

	}

	function _isReading() : bool
	{
//		print_r("Book::_isReading</br>\n");
		if (!empty($this->_getStates()))
		{
			foreach ($this->_getStates() as $state)
			{
				if ($state->isReading())
				{
//					print_r("Book is being read!</br>");
					return true;
				}
			}
		}
		return false;
	}

	function _getReadingState() : Bookstate
	{
		foreach ($this->_bookstates as $state)
		{
			if ($state->isReading())
			{
				return $state;
			}
		}
	}
}
?>