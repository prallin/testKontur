<?php
/**
 * Description of CMContent,php
 *
 * @author gustav
 */
class CMContent extends CObject implements CHasSQL, ArrayAccess, IModule {

    /**
     * propertis
     * @var type 
     */
    public $data;

    /**
     * Construktor
     * @param type $id
     */
    public function __construct($id = null) {
        parent::__construct();

        if ($id) {

            $this->LoadById($id);
        } else {

            $this->data = array();
        }
    }

    /**
     * SQL 
     * @param type $key
     * @param type $args
     * @return type
     * @throws Exception
     */
    public static function SQL($key = null, $args = null) {
        $order_order = isset($args['order-order']) ? $args['order-order'] : 'ASC';
        $order_by = isset($args['order-by']) ? $args['order-by'] : 'id';

        $queries = array(
            'drop table content' => "DROP TABLE IF EXISTS Content;",
            'drop table content2group' => "DROP TABLE IF EXISTS Content2Groups;",
            'create table content2group' => "CREATE TABLE IF NOT EXISTS Content2Groups (idContent INTEGER, idGroups INTEGER, created DATETIME default (datetime('now')), PRIMARY KEY(idContent, idGroups));",
            'create table content' => "CREATE TABLE IF NOT EXISTS Content (id INTEGER PRIMARY KEY, key TEXT KEY, type TEXT, title TEXT, data TEXT, filter TEXT, idUser INT, created DATETIME default (datetime('now')), updated DATETIME default NULL, deleted DATETIME default NULL, FOREIGN KEY(idUser) REFERENCES User(id));",
            'insert content' => 'INSERT INTO Content (key,type,title,data,filter,idUser) VALUES (?,?,?,?,?,?);',
            'insert into content2group' => 'INSERT INTO Content2Groups (idContent,idGroups) VALUES (?,?);',
            'select * by id' => 'SELECT c.*, u.acronym as owner FROM Content AS c INNER JOIN User as u ON c.idUser=u.id WHERE c.id=? AND deleted IS NULL;',
            'select * by key' => 'SELECT c.*, u.acronym as owner FROM Content AS c INNER JOIN User as u ON c.idUser=u.id WHERE c.key=? AND deleted IS NULL;',
            'select * by type' => "SELECT c.*, u.acronym as owner FROM Content AS c INNER JOIN User as u ON c.idUser=u.id WHERE type=? AND deleted IS NULL ORDER BY {$order_by} {$order_order};",
            'select *' => 'SELECT c.*, u.acronym as owner FROM Content AS c INNER JOIN User as u ON c.idUser=u.id WHERE deleted IS NULL;',
            'update content' => "UPDATE Content SET key=?, type=?, title=?, data=?, filter=?, updated=datetime('now') WHERE id=?;",
            'update content as deleted' => "UPDATE Content SET deleted=datetime('now') WHERE id=?;",
            'get group memberships' => "SELECT * FROM Groups AS g INNER JOIN Content2Groups AS ug ON g.id=ug.idGroups WHERE ug.idContent=?;",
            'delete content2group' => "DELETE FROM Content2Groups WHERE idContent=? AND idGroups=?;",
        );
        if (!isset($queries[$key])) {
            throw new Exception("No such SQL query, key '$key' was not found.");
        }
        return $queries[$key];
    }

    /**
     * Manage is used by the installation process
     * @param type $action installation process to be called 
     * @return array messages about status
     * @throws Exception if it does not work
     */
    public function Manage($action = null) {
        switch ($action) {
            case 'install' :
                try {
                    $this->db->ExecuteQuery(self::SQL('drop table content'));
                    $this->db->ExecuteQuery(self::SQL('drop table content2group'));
                    $this->db->ExecuteQuery(self::SQL('create table content'));
                    $this->db->ExecuteQuery(self::SQL('create table content2group'));
                    $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world', 'post', 'Hello World', "This is a demo post.\n\nThis is another row in this demo post.", 'plain', '1'));
                    $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world-again', 'post', 'Hello World Again', "This is another demo post.\n\nThis is another row in this demo post.", 'plain', '1'));
                    $this->db->ExecuteQuery(self::SQL('insert content'), array('hello-world-admin', 'post', 'Hello World Administratör', "Det här är en test post som bara sak ses av administratörer.\n\n som inte vissas när användaren inte är inloggad.", 'plain', '1'));
                    $this->db->ExecuteQuery(self::SQL('insert content'), array('home', 'page', 'Home page', "<article><header><h1>Bakgrund</h1><p>Jag är föd i Skellefteå men bor just nu i Lviv i Ukraina med sambo och katt och är för närvarande tjänstledig från mitt arbete i Göteborg som tekniker och handledare i digitalamedier på ett företag som håller på med support för kulturtidskrifter och kulturentreprenörer. Det innebär att jag har haft hand om systemunderhåll på mac datorer och drivit ett litet webbhotell. Handlett i bland annat i videoredigering, adobe-program, wordpress. Har byggt flera enklare webbplatser och har haft flera olika roller i några mer avancerade webbprojekt. Men jag har alltid fått ta in någon för att lösa programmeringen när det har blivit lite mer krångligt.</p></header><section><h2>Tidigare studier</h2><p>Sedan 2 år så har jag studerat programmering och webbutveckling på distans. Nu i våras så läset jag Designmönster med Java på Mittuniversitetet. På Högskolan i väst har jag läst Webbutveckling med delkurser som exempelvis php, mysql, xml, html.</p></section><section><h2>Förväntningar</h2><p>Min förhoppning på kursen ska göra mig mer säker på php, MVC, CMS system och knyta i hopp kunskaperna från mina tidigare kurser.</p></section></article>", 'htmlpurify', '1'));
                    $this->db->ExecuteQuery(self::SQL('insert content'), array('about', 'page', 'About page', "This is a demo page, this could be your personal home-page.\n\n Kontur is a PHP MVC at: https://github.com/prallin/testKontur it is based on Lydia tutorial at: http://dbwebb.se/lydia/tutorial.", 'plain', '1'));
                    $this->db->ExecuteQuery(self::SQL('insert content'), array('download', 'page', 'Download page', "This is a demo page, this could be your personal download-page.\n\nYou can download your own copy of kontur from https://github.com/prallin/testKontur", 'plain', '1'));
                    $this->db->ExecuteQuery(self::SQL('insert into content2group'), array('1', '2'));
                    $this->db->ExecuteQuery(self::SQL('insert into content2group'), array('2', '2'));
                    $this->db->ExecuteQuery(self::SQL('insert into content2group'), array('3', '1')); 
                    $this->db->ExecuteQuery(self::SQL('insert into content2group'), array('4', '2')); 
                    $this->db->ExecuteQuery(self::SQL('insert into content2group'), array('5', '2')); 
                    $this->db->ExecuteQuery(self::SQL('insert into content2group'), array('6', '2')); 
                    return array('success', 'Successfully created the database tables and created a default "Hello World" blog post, owned by you.');
                } catch (Exception$e) {
                    die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
                }
                break;
            default :
                throw new Exception('Unsupported action for this module.');
                break;
        }
    }

    /**
     * Implementing ArrayAccess for $this->data
     */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * Save content. If it has a id, use it to update current entry or else insert new entry.
     *
     * @returns boolean true if success else false.
     */
    public function Save() {
        $msg = null;
        if ($this['id']) {
            $this->db->ExecuteQuery(self::SQL('update content'), array($this['key'], $this['type'], $this['title'], $this['data'], $this['filter'], $this['id']));
            $msg = 'update';
        } else {
            $this->db->ExecuteQuery(self::SQL('insert content'), array($this['key'], $this['type'], $this['title'], $this['data'], $this['filter'], $this->user['id']));
            $this['id'] = $this->db->LastInsertId();
            $msg = 'created';
        }
        $rowcount = $this->db->RowCount();
        if ($rowcount) {
            $this->AddMessage('success', "Successfully {$msg} content '" . htmlEnt($this['key']) . "'.");
        } else {
            $this->AddMessage('error', "Failed to {$msg} content '" . htmlEnt($this['key']) . "'.");
        }
        return $rowcount === 1;
    }

    /**
     * List all content.
     * @returns array with listing or null if empty.
     */
    public function ListAll($args = null) {
        try {
            if (isset($args) && isset($args['type'])) {
                $res = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * by type', $args), array($args['type']));
                $resSelect = array();    
                foreach ($res as $val) {
                    if ($this->checkGroup($val['id'])) {
                        array_push($resSelect, $val);
                    } 
                }         
                return $resSelect;
            } else {
                return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select *', $args));
            }
        } catch (Exception $e) {
            echo $e;
            return null;
        }
    }

    /**
     * Delete content. Set its deletion-date to enable wastebasket functionality.
     */
    public function Delete() {
        if ($this['id']) {
            $this->db->ExecuteQuery(self::SQL('update content as deleted'), array($this['id']));
        }
        $rowcount = $this->db->RowCount();
        if ($rowcount) {
            $this->AddMessage('success', "Successfully set content '" . htmlEnt($this['key']) . "' as deleted.");
        } else {
            $this->AddMessage('error', "Failed to set content '" . htmlEnt($this['key']) . "' as deleted.");
        }
        return $rowcount === 1;
    }

    /**
     * Load content by id.
     *
     * @param id integer the id of the content.
     * @returns boolean true if success else false.
     */
    public function LoadById($id) {
        $res = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * by id'), array($id));
        if (empty($res)) {
            $this->AddMessage('error', "Failed to load content with id '$id'.");
            return false;
        } else {
            $this->data = $res[0];
        }
        return true;
    }

    /**
     * Filter content according to a filter.
     *
     * @param $data string of text to filter and format according its filter settings.
     * @returns string with the filtered data.
     */
    public static function Filter($data, $filter) {
        switch ($filter) {
            /* comment out to protect from php and html, Cross site Scripting XSS  
              case 'php': $data = nl2br(makeClickable(eval('?>'.$data))); break;
              case 'html': $data = nl2br(makeClickable($data)); break;
             */
            case 'markdown': $data = nl2br(Cmarkdown::DoMarkdown($data));
                break;
            case 'bbcode': $data = nl2br(bbcode2html(htmlEnt($data)));
                break;
            case 'htmlpurify': $data = nl2br(CHTMLPurifier::Purify($data));
                break;
            case 'plain':
            default: $data = nl2br(makeClickable(htmlEnt($data)));
                break;
        }
        return $data;
    }

    /**
     * Get the filtered content.
     *
     * @returns string with the filtered data.
     */
    public function GetFilteredData() {
        return $this->Filter($this['data'], $this['filter']);
    }

    /**
     * Returns array of the content group membership
     * @param type $id
     * @return type
     */
    public function GetGroupMemberships($id) {
        $groups = array();
        $groups['groups'] = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('get group memberships'), array($id));
        return $groups;
    }

    /**
     * Removes membership of group for current content
     * @param type $groupeid
     * @param type $contentid
     * @return boolean
     */
    public function LeaveGroup($groupeid, $contentid) {
        $this->db->ExecuteQuery(self::SQL('delete content2group'), array($contentid, $groupeid));
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to Leave groupe.");
            return false;
        }
        return true;
    }

    /**
     * Adds group membership to content
     * @param type $groupeid
     * @param type $contentid
     * @return boolean
     */
    public function JoinGroup($groupeid, $contentid) {
        try {
            $this->db->ExecuteQuery(self::SQL('insert into content2group'), array($contentid, $groupeid));
        } catch (Exception $e) {
            
        }
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to join groupe.");
            return false;
        }
        return true;
    }

    /**
     * Checks contents groups against the user groups
     * If the user is not logged in it is set to the public group 2
     * @param type $goupid
     * @return boolean
     */
    public function checkGroup($contentid) {
        if ($this->session->GetAuthenticatedUser()) {
            $Usergroups = $this->user->getGroupMemberships($this->user->profile['id']);
        } else {       
            $Usergroups = array("groups" => array("id" => '2'));
        }
        $Contentgroups = $this->GetGroupMemberships($contentid);
        foreach ($Contentgroups["groups"] as $cgroups) {
            foreach ($Usergroups["groups"] as $ugroups) {
                if ($cgroups["id"] === $ugroups["id"]) {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }


}

?>
