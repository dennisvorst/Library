<?php
require_once "Database.php";

class Bookstate
{
    private $_debug = FALSE;

    private $_db;
    private $_idbookstate;
	private $_idbook;
	private $_dtstart;
    private $_dtfinished;

    function __construct(Database $db = null, array $row = null)
    {
        if (!empty($db))
        {
            $this->_db = $db;
        }
        
        if (isset($row['idbookstate'])) $this->_idbookstate = $row['idbookstate'];
        if (isset($row['idbook'])) $this->_idbook = $row['idbook'];
        if (isset($row['dtstart'])) $this->_dtstart = $row['dtstart'];
        if (isset($row['dtfinished'])) $this->_dtfinished = $row['dtfinished'];
    }

    function editState() : string
    {
        ?>
        <form action="administrator/edit_book.php" enctype="multipart/form-data" method="GET">
            <div class="form-group">
                <label for="ftreview">Review</label>
                <textarea class="form-control" rows="5" id="ftreview" name="ftreview"><?php echo $this->_ftreview; ?></textarea>
            </div>
            <div>
                <input id="idbook" name="idbook" type="hidden" value="<?php echo $this->_idbook; ?>">
                <input id="nmaction" name="nmaction" type="hidden" value="update">
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <?php
    }

    function showState() : string
    {
        if ($this->_debug){print_r("Bookstates::showState");} 

        $html = "<div class='form-group'>\n";
        $html .= "  <label for='dtstart'>Gestart</label>\n";
        $html .= "</div>\n";
        $html .= "<div class='form-group'>\n";
        $html .= "  <label for='dtfinished'>Afgerond</label>\n";
        $html .= "</div>\n";
        $html .= "<div class='form-group'>\n";
        $html .= "  <label for='ftreview'>Review</label>\n";
        $html .= "</div>\n";

        return $html;
    }

    function startReading() : void
    {
        $sql = "INSERT INTO `bookstates` (`idbookstate`, `idbook`, `dtstart`, `dtfinished`, `ftreview`) VALUES (NULL, '" . $this->_idbook ."', '" . date('Y-m-d') . "', NULL, NULL)";
        $this->_idbookstate = $this->_db->insertRecord($sql);
    }

    function stopReading() : void
    {
        $sql = "DELETE FROM bookstates WHERE idbookstate = $this->_idbookstate";
    }

    function finishReading() : void
    {
        if ($this->_debug){print_r("Bookstate::finishReading</br>\n");} 

        $sql = "UPDATE bookstates SET dtfinished = '" . date('Y-m-d') . "' WHERE idbookstate = $this->_idbookstate";
        $this->_db->updateDb($sql);
    }

    function isReading() : bool
    {
        if ($this->_debug){print_r("Bookstate::isReading</br>\n");} 

        if ($this->_idbookstate && empty($this->_dtfinished))
        {
            return true;
        } 
        return false;
    }
}
?>
