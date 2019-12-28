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

	function startReading(int $id)
	{
		$sql = "INSERT INTO `bookstates` (`idbookstate`, `idbook`, `cdkeep`, `cdlanguage`, `cdstatus`, `dtstart`, `dtfinished`, `ftreview`) VALUES (NULL, $id, '1', 'NL', 'B', '2019-12-28', NULL, NULL)";

		$ftrows	= $db->insertQuery($ftquery);
	}

	function finishReading(int $id)
	{
		$sql = "UPDATE bookstatus SET finishdate =  WHERE iodbook = $id";
		$ftrows	= $db->updateDb($ftquery);
	}

	function stopReading(int $id)
	{
		$sql = "DELETE FROM bookstatus WHERE iodbook = $id";
		$ftrows	= $db->updateDb($ftquery);
	}

} 
?>