<?php
/**
 * A guestbook controller as an example to show off some basic controller and model-stuff.
 *
 * @package KonturCore
 */
class CCGuestbook extends CObject implements IController {

	private $guestbookModel;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->guestbookModel = new CMGuestbook();
	}

	/**
	 * Implementing interface IController. All controllers must have an index action.
  
	 **/
	 public function Index() {
    $this->views->SetTitle('Kontur Guestbook Example');
    $this->views->AddInclude(__DIR__ . '/index.tpl.php', array(
      'entries'=>$this->guestbookModel->ReadAll(), 
      'formAction'=>$this->request->CreateUrl('', 'handler')
    ));
  }
	

	/**
	 * Add a entry to the guestbook.
	 */
	public function Handler() {
		if (isset($_POST['doAdd'])) {
			//$this -> SaveNewToDatabase(strip_tags($_POST['newEntry']));
			$this->guestbookModel->Add(strip_tags($_POST['newEntry']));
		} elseif (isset($_POST['doClear'])) {
			//$this -> DeleteAllFromDatabase();
			$this->guestbookModel->DeleteAll();
		} elseif (isset($_POST['doCreate'])) {
			//$this -> CreateTableInDatabase();
			$this->guestbookModel->Init();
		}
		$this->RedirectTo($this->request->CreateUrl($this->request->controller));
		//header('Location: ' . $this -> request -> CreateUrl('guestbook'));
		//$this->RedirectTo($this->request->CreateUrl($this->request->controller));
	}

	/**
	 * Save a new entry to database.
	 */
	private function SaveNewToDatabase($entry) {
		$this -> db -> ExecuteQuery(self::SQL('insert into guestbook') , array($entry));
		$this->session->AddMessage('success', 'Successfully inserted new message.');
		if ($this -> db -> rowCount() != 1) {
			echo 'Failed to insert new guestbook item into database.';
		}
	}

	/**
	 * Delete all entries from the database.
	 */
	private function DeleteAllFromDatabase() {
		$this -> db -> ExecuteQuery(self::SQL('delete from guestbook'));
		$this->session->AddMessage('info', 'Removed all messages from the database table.');
	}

	/**
	 * Read all entries from the database.
	 */
	private function ReadAllFromDatabase() {
		try {
			$this -> db -> SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this -> db -> ExecuteSelectQueryAndFetchAll(self::SQL('select * from guestbook'));
		} catch(Exception $e) {
			return array();
		}
	}

	/**
	 * Save a new entry to database.
	 */
	private function CreateTableInDatabase() {
		try {
			$this -> db -> ExecuteQuery(self::SQL('create table guestbook'));
			$this->session->AddMessage('notice', 'Successfully created the database tables (or left them untouched if they already existed).');			
		} catch(Exception$e) {
			die("$e<br/>Failed to open database: " . $this -> config['database'][0]['dsn']);
		}
	}

	/**
	 * Implementing interface IHasSQL. Encapsulate all SQL used by this class.
	 *
	 * @param string $key the string that is the key of the wanted SQL-entry in the array.
	 */

	public static function SQL($key = null) {
		$queries = array(
		'create table guestbook' => "CREATE TABLE IF NOT EXISTS Guestbook (id INTEGER PRIMARY KEY, entry TEXT, created DATETIME default (datetime('now')));", 
		'insert into guestbook' => 'INSERT INTO Guestbook (entry) VALUES (?);', 
		'select * from guestbook' => 'SELECT * FROM Guestbook ORDER BY id DESC;', 
		'delete from guestbook' => 'DELETE FROM Guestbook;', );

		if (!isset($queries[$key])) {
			throw new Exception("No such SQL query, key '$key' was not found.");
		}

		return $queries[$key];
	}

}
