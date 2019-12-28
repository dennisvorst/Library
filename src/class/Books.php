<?php
require_once "Database.php";

class Books{
	private $_db;
	private $_states;

	function __construct(Database $db = null)
	{
		if (empty($db))
		{
			$this->_db = new Database();

		} else {
			$this->_db = $db;

		}
	}

	function getBook($idbook){
		/** get a book filtered by id */
		$booklist	= "";
		$sql 		= "SELECT * FROM books WHERE idbook = " . $idbook ;
		$ftrows 	=  $this->_db->queryDb($sql);
		return $ftrows[0];
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

	function getBookStates($idbook) : array
	{
		$sql 	= "SELECT * FROM bookstates WHERE idbook = $idbook ORDER BY dtstart";
		return $this->_db->queryDb($sql);
	}

	function startReading(int $id)
	{
		$sql = "INSERT INTO `bookstates` (`idbookstate`, `idbook`, `cdkeep`, `cdlanguage`, `cdstatus`, `dtstart`, `dtfinished`, `ftreview`) VALUES (NULL, $id, '1', 'NL', 'B', '" . date('Y-m-d') . "', NULL, NULL)";
		$ftrows	= $db->insertQuery($sql);
	}

	function finishReading(int $id)
	{
		$sql = "UPDATE bookstatus SET finishdate =  WHERE iodbook = $id";
		$ftrows	= $db->updateDb($sql);
	}

	function stopReading(int $id)
	{
		$sql = "DELETE FROM bookstatus WHERE iodbook = $id";
		$ftrows	= $db->updateDb($sql);
	}

	function getLibrary(string $selected_language = null) : array
	{
		$sql 	= "SELECT * FROM books";
		if (!empty($selected_language)){
			$sql 	.= 	" WHERE cdlanguage = '" . $selected_language . "' ";
		}
		$sql 	.= " ORDER BY nmtitle, nmsubtitle, nmauthor";
		return $this->_db->queryDb($sql);
	}

	function getReadBooks(string $selected_language = null) : array
	{
		/** read books have an end date */
		$sql 	= "SELECT * FROM books b, bookstates bs WHERE b.idbook = bs.idbook AND bs.dtfinished IS NOT NULL";
		if (!empty($selected_language)){
			$sql 	.= 	" AND b.cdlanguage = '" . $selected_language . "' ";
		}
		$sql	.= " ORDER BY bs.dtfinished DESC";
		return $this->_db->queryDb($sql);
	}

	function getCurrentlyReading(string $selected_language = null) : array
	{
		/** books that are currently being read have a bookstate record but no enddate.  */
		$sql 	= "SELECT * FROM books b, bookstates bs WHERE b.idbook = bs.idbook AND bs.dtfinished IS NULL";
		if (!empty($selected_language)){
			$sql 	.= 	" AND b.cdlanguage = '" . $selected_language . "' ";
		}
		return $this->_db->queryDb($sql);
	}

	function countReadBooksPerYear(string $selected_language = null, int $year) : array
	{
		$sql = "SELECT COUNT(*) AS books, SUM(nrpages) AS pages FROM books b, bookstates bs WHERE b.idbook = bs.idbook AND bs.dtfinished BETWEEN '" . $year . "-01-01' AND '" . $year . "-12-31'";
		if (!empty($selected_language)){
			$sql 	.= 	" AND b.cdlanguage = '" . $selected_language . "' ";
		}

		return $this->_db->queryDb($sql);
	}

	function getAllBooksReadPerYear(string $selected_language = null, int $year) : array
	{
		$sql = "SELECT * FROM books b, bookstates bs WHERE b.idbook = bs.idbook AND bs.dtfinished BETWEEN '" . $year . "-01-01' AND '" . $year . "-12-31'";
		if (!empty($selected_language)){
			$sql 	.= 	" AND b.cdlanguage = '" . $selected_language . "'";
		}
		$sql 	.= " ORDER BY bs.dtfinished DESC";
		return $this->_db->queryDb($sql);
	}
}
?>