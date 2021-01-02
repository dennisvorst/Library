<?php
require_once "Database.php";

class Library{
	private $_db;
	private $_books = [];
	private $_years = [];

	function __construct(Database $db)
	{
		$this->_db = $db;
	}

	function getBooks(string $selected_language = null, string $cdstatus = null, bool $unreadBooksOnly = false) : void
	{
		/**
		 * Status backlog, in progress, done 
		 * $unreadBooksOnly = True then show only the books that were not read yet.
		 */

		 /** init  */
		$sql = "";
		$where = "";
		$orderBy = "";

		switch ($cdstatus)
		{
			case "D" :
				/** Done  */
				$sql 	= "SELECT * FROM books b, bookstates bs"; 
				$where = "b.idbook = bs.idbook 
						AND bs.dtfinished IS NOT NULL";
				$orderBy = "bs.dtfinished DESC";

				break;
			case "I" :
				/** in progress */
				$sql 	= "SELECT * FROM books b, bookstates bs"; 
				$where = "b.idbook = bs.idbook 
						AND bs.dtfinished IS NULL";
				break;
		
			case "B":
			default:
				/** backlog  */
				$sql = "SELECT * FROM books b";
				if ($unreadBooksOnly)
				{
					$where = "idbook NOT IN (SELECT idbook FROM bookstates)";
				} 
				$orderBy = "b.nmtitle, b.nmsubtitle, b.nmauthor";
		}

		if (!empty($selected_language)){
			if (empty($where))
			{
				$where = "b.cdlanguage = '" . $selected_language . "'";
			} else {
				$where .= " AND b.cdlanguage = '" . $selected_language . "'";
			}
		}

		$sql .= (empty($where) ? "" : " WHERE " . $where) . (empty($orderBy) ? "" : " ORDER BY " . $orderBy);

		$rows = $this->_db->queryDb($sql);
		$this->_setBooks($rows);
	}

	private function _setBooks(array $rows) : array
	{
		if (empty($this->_books)) 
		{
			foreach ($rows as $row)
			{
				$book = new Book($this->_db);
				$book->setProperties($row);
				$this->_books[] = $book;
			}
		}
		return $this->_books;
	}

	function getLibrary(string $selected_language = null) : array
	{
		$this->getBooks($selected_language);
		return $this->_books;
	}

	function getReadBooks(string $selected_language = null) : array
	{
		$this->getBooks($selected_language, "D");
		return $this->_books;
	}

	function getCurrentlyReading(string $selected_language = null) : array
	{
		$this->getBooks($selected_language, "I");
		return $this->_books;
	}

	function getNumberOfBooks() : int
	{
		return count($this->_books);
	}

	function countReadBooksPerYear(string $selected_language = null, int $year) : array
	{
		$sql = "SELECT COUNT(*) AS books, SUM(nrpages) AS pages FROM books b, bookstates bs WHERE b.idbook = bs.idbook AND bs.dtfinished BETWEEN '" . $year . "-01-01' AND '" . $year . "-12-31'";
		if (!empty($selected_language)){
			$sql 	.= 	" AND b.cdlanguage = '" . $selected_language . "' ";
		}
		$ftrow = $this->_db->queryDb($sql);
		return $ftrow[0];
	}

	function getAllBooksReadPerYear(string $selected_language = null, int $year) : array
	{
		$sql = "SELECT * FROM books b, bookstates bs WHERE b.idbook = bs.idbook AND bs.dtfinished BETWEEN '" . $year . "-01-01' AND '" . $year . "-12-31'";
		if (!empty($selected_language)){
			$sql 	.= 	" AND b.cdlanguage = '" . $selected_language . "'";
		}
		$sql 	.= " ORDER BY bs.dtfinished DESC";

		$this->_books = [];
		$this->_setBooks($this->_db->queryDb($sql));
		return $this->_books;
	}

	function createTiles(string $admin, string $selected_language = null) : array 
	{
		$tiles = [];
		if (!empty($this->_books))
		{
			foreach ($this->_books as $book){
				if (!empty($book)) 
				{
					$tiles[] = $book->createTile($admin, $selected_language);
				}
			}
		}
		return $tiles;
	}

	function getYears() : array
	{
		if (empty($this->_years)) 
		{
			$sql = "SELECT DISTINCT YEAR(dtfinished) AS year FROM bookstates WHERE dtfinished IS NOT NULL GROUP BY year DESC";
			$years = $this->_db->queryDb($sql);
			foreach ($years as $year)
			{
				$this->_years[] = $year['year'];
			}

		}
		return $this->_years;
	}

}
?>