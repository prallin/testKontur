<?php

/**
 * Class för User in kontur
 * @package konturCore
 */
class CMUser extends CObject implements CHasSQL, ArrayAccess, IModule {

    /**
     * Properties
     */
    public $profile = array();
    public $data = array();

    /**
     * Constructor
     */
    public function __construct($kontur = null) {
        parent::__construct($kontur);
        $profile = $this->session->GetAuthenticatedUser();
        $this->profile = is_null($profile) ? array() : $profile;
        $this['isAuthenticated'] = is_null($profile) ? false : true;
    }

    /**
     * Implementing ArrayAccess for $this->profile
     */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->profile[] = $value;
        } else {
            $this->profile[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->profile[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->profile[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->profile[$offset]) ? $this->profile[$offset] : null;
    }

    /**
     * Implementing interface IHasSQL. Encapsulate all SQL used by this class.
     *
     * @param string $key the string that is the key of the wanted SQL-entry in the array.
     */
    public static function SQL($key = null) {
        $queries = array(
            'drop table user' => "DROP TABLE IF EXISTS User;",
            'drop table group' => "DROP TABLE IF EXISTS Groups;",
            'drop table user2group' => "DROP TABLE IF EXISTS User2Groups;",
            'create table user' => "CREATE TABLE IF NOT EXISTS User (id INTEGER PRIMARY KEY, acronym TEXT KEY, name TEXT, email TEXT, algorithm TEXT, salt TEXT, password TEXT, created DATETIME default (datetime('now')), updated DATETIME default NULL);",
            'create table group' => "CREATE TABLE IF NOT EXISTS Groups (id INTEGER PRIMARY KEY, acronym TEXT KEY, name TEXT, created DATETIME default (datetime('now')), updated DATETIME default NULL);",
            'create table user2group' => "CREATE TABLE IF NOT EXISTS User2Groups (idUser INTEGER, idGroups INTEGER, created DATETIME default (datetime('now')), PRIMARY KEY(idUser, idGroups));",
            'insert into user' => 'INSERT INTO User (acronym,name,email,algorithm,salt,password) VALUES (?,?,?,?,?,?);',
            'insert into group' => 'INSERT INTO Groups (acronym,name) VALUES (?,?);',
            'insert into user2group' => 'INSERT INTO User2Groups (idUser,idGroups) VALUES (?,?);',
            'check user password' => 'SELECT * FROM User WHERE (acronym=? OR email=?);',
            'get group memberships' => 'SELECT * FROM Groups AS g INNER JOIN User2Groups AS ug ON g.id=ug.idGroups WHERE ug.idUser=?;',
            'update profile' => "UPDATE User SET name=?, email=?, updated=datetime('now') WHERE id=?;",
            'update password' => "UPDATE User SET algorithm=?, salt=?, password=?, updated=datetime('now') WHERE id=?;",
            'select * user' => "SELECT * FROM User;",
            'select * group' => "SELECT * FROM Groups;",
            'delete group' => "DELETE FROM Groups WHERE id=?;",
            'select id group' => "SELECT * FROM Groups WHERE id=?;",
            'update group' => "UPDATE Groups SET acronym=?, name=? WHERE id=?;",
            'delete user' => "DELETE FROM User WHERE id=?;",
            'select id user' => "SELECT * FROM User WHERE id=?;",
            'update user profile' => "UPDATE User SET acronym=?, name=?, email=?, updated=datetime('now') WHERE id=?;",
            'delete user2group' => "DELETE FROM User2Groups WHERE idUser=? AND idGroups=?;",
        );
        if (!isset($queries[$key])) {
            throw new Exception("No such SQL query, key '$key' was not found.");
        }
        return $queries[$key];
    }

    /**
     * Login by autenticate the user and password. Store user information in session if success.
     *
     * Set both session and internal properties.
     *
     * @param string $akronymOrEmail the emailadress or user akronym.
     * @param string $password the password that should match the akronym or emailadress.
     * @returns booelan true if match else false.
     */
    public function Login($akronymOrEmail, $password) {
        $user = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('check user password'), array($akronymOrEmail, $akronymOrEmail));
        $user = (isset($user[0])) ? $user[0] : null;
        if (!$user) {
            return false;
        } else if (!$this->CheckPassword($password, $user['algorithm'], $user['salt'], $user['password'])) {
            return false;
        }
        unset($user['algorithm']);
        unset($user['salt']);
        unset($user['password']);
        if ($user) {
            $user['isAuthenticated'] = true;
            $user['groups'] = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('get group memberships'), array($user['id']));
            foreach ($user['groups'] as $val) {
                if ($val['id'] == 1) {
                    $user['hasRoleAdmin'] = true;
                }
                if ($val['id'] == 2) {
                    $user['hasRoleUser'] = true;
                }
            }
            $this->profile = $user;
            $this->session->SetAuthenticatedUser($this->profile);
        }
        return ($user != null);
    }

    /**
     * Logout. Clear both session and internal properties.
     */
    public function Logout() {
        $this->session->UnsetAuthenticatedUser();
        $this->profile = array();
        $this->AddMessage('success', "You have logged out.");
    }

    /**
     * Save user profile to database and update user profile in session.
     *
     * @returns boolean true if success else false.
     */
    public function Save() {
        $this->db->ExecuteQuery(self::SQL('update profile'), array($this['name'], $this['email'], $this['id']));
        $this->session->SetAuthenticatedUser($this->profile);
        return $this->db->RowCount() === 1;
    }

    /**
     * Change user password.
     *
     * @param $plain string the new password
     * @returns boolean true if success else false.
     */
    public function ChangePassword($plain) {
        $password = $this->CreatePassword($plain);
        $this->db->ExecuteQuery(self::SQL('update password'), array($password['algorithm'], $password['salt'], $password['password'], $this['id']));
        return $this->db->RowCount() === 1;
    }

    /**
     * Create password.
     *
     * @param $plain string the password plain text to use as base.
     * @param $algorithm string stating what algorithm to use, plain, md5, md5salt, sha1, sha1salt. 
     * defaults to the settings of site/config.php.
     * @returns array with 'salt' and 'password'.
     */
    public function CreatePassword($plain, $algorithm = null) {
        $password = array(
            'algorithm' => ($algorithm ? $algorithm : CKontur::Instance()->config['hashing_algorithm']),
            'salt' => null
        );
        switch ($password['algorithm']) {
            case 'sha1salt': $password['salt'] = sha1(microtime());
                $password['password'] = sha1($password['salt'] . $plain);
                break;
            case 'md5salt': $password['salt'] = md5(microtime());
                $password['password'] = md5($password['salt'] . $plain);
                break;
            case 'sha1': $password['password'] = sha1($plain);
                break;
            case 'md5': $password['password'] = md5($plain);
                break;
            case 'plain': $password['password'] = $plain;
                break;
            default: throw new Exception('Unknown hashing algorithm');
        }
        return $password;
    }

    /**
     * Check if password matches.
     *
     * @param $plain string the password plain text to use as base.
     * @param $algorithm string the algorithm mused to hash the user salt/password.
     * @param $salt string the user salted string to use to hash the password.
     * @param $password string the hashed user password that should match.
     * @returns boolean true if match, else false.
     */
    public function CheckPassword($plain, $algorithm, $salt, $password) {
        switch ($algorithm) {
            case 'sha1salt': return $password === sha1($salt . $plain);
                break;
            case 'md5salt': return $password === md5($salt . $plain);
                break;
            case 'sha1': return $password === sha1($plain);
                break;
            case 'md5': return $password === md5($plain);
                break;
            case 'plain': return $password === $plain;
                break;
            default: throw new Exception('Unknown hashing algorithm');
        }
    }

    /**
     * Create new user.
     *
     * @param $acronym string the acronym.
     * @param $password string the password plain text to use as base. 
     * @param $name string the user full name.
     * @param $email string the user email.
     * @returns boolean true if user was created or else false and sets failure message in session.
     */
    public function Create($acronym, $password, $name, $email) {
        $pwd = $this->CreatePassword($password);
        $this->db->ExecuteQuery(self::SQL('insert into user'), array($acronym, $name, $email, $pwd['algorithm'], $pwd['salt'], $pwd['password']));
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to create user.");
            return false;
        }
        return true;
    }

    /**
     * List all users
     */
    public function ListAllUsers() {
        try {
            return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * user', null));
        } catch (Exception $e) {
            echo $e;
            return null;
        }
    }

    /**
     * Lista all groups
     * @return array all groups from db
     */
    public function ListAllGroups() {
        try {
            return $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select * group', null));
        } catch (Exception $e) {
            echo $e;
            return null;
        }
    }

    
    /**
     * Get a group with an id
     * @param type $id
     * @return boolean
     */
    public function getGroup($id) {
        $res = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select id group'), array($id));
        if (empty($res)) {
            $this->AddMessage('error', "Failed to load groupe with id : '$id'.");
            return false;
        } else {
            $this->data = $res[0];
        } return true;
    }
 
    /**
     * get a user's group memberships
     * @param type $id
     * @return type
     */
    public function getGroupMemberships($id){
        $groups = array();
        $groups['groups'] = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('get group memberships'), array($id));
        return $groups;
    }
 
    
    
    
    /**
     * Manage Install User modul
     * @param type $action
     * @return type
     * @throws Exception
     */
    public function Manage($action = null) {
        switch ($action) {
            case 'install':
                try {
                    $this->db->ExecuteQuery(self::SQL('drop table user2group'));
                    $this->db->ExecuteQuery(self::SQL('drop table group'));
                    $this->db->ExecuteQuery(self::SQL('drop table user'));
                    $this->db->ExecuteQuery(self::SQL('create table user'));
                    $this->db->ExecuteQuery(self::SQL('create table group'));
                    $this->db->ExecuteQuery(self::SQL('create table user2group'));
                    $password = $this->CreatePassword('root');
                    $this->db->ExecuteQuery(self::SQL('insert into user'), array('root', 'The Administrator', 'root@dbwebb.se', $password['algorithm'], $password['salt'], $password['password']));
                    $idRootUser = $this->db->LastInsertId();
                    $password = $this->CreatePassword('doe');
                    $this->db->ExecuteQuery(self::SQL('insert into user'), array('doe', 'John/Jane Doe', 'doe@dbwebb.se', $password['algorithm'], $password['salt'], $password['password']));
                    $idDoeUser = $this->db->LastInsertId();
                    $this->db->ExecuteQuery(self::SQL('insert into group'), array('admin', 'The Administrator Group'));
                    $idAdminGroup = $this->db->LastInsertId();
                    $this->db->ExecuteQuery(self::SQL('insert into group'), array('user', 'The Public User Group'));
                    $idUserGroup = $this->db->LastInsertId();
                    $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idAdminGroup));
                    $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idRootUser, $idUserGroup));
                    $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($idDoeUser, $idUserGroup));
                    return array('success', 'Successfully created the database tables and created a default admin user as root:root and an ordinary user as doe:doe.');
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
     * Create a Group
     * @param type $acronym
     * @param type $name
     * @return boolean
     */
    public function CreateGroup($acronym, $name) {
        $this->db->ExecuteQuery(self::SQL('insert into group'), array($acronym, $name));
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to create groupe.");
            return false;
        }
        return true;
    }
    
    /**
     * Save a group
     * @param type $id
     * @param type $acronym
     * @param type $name
     * @return boolean
     */
    public function SaveGroup($id, $acronym, $name) {
        $this->db->ExecuteQuery(self::SQL('update group'), array($acronym, $name, $id));
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to edit and save groupe.");
            return false;
        }
        return true;
    }

    /**
     * Delete a group
     * @param type $id
     * @return boolean
     */
    public function DoDeletegroup($id) {
        $this->db->ExecuteQuery(self::SQL('delete group'), array($id));
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to delete group.");
            return false;
        }
        return true;
    }

    /**
     * Delete a user
     * @param type $id
     * @return boolean
     */
    public function Deleteuser($id) {
        $this->db->ExecuteQuery(self::SQL('delete user'), array($id));
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to delete user.");
            return false;
        }
        return true;
    }

    /**
     * Get a user
     * @param type $id
     * @return boolean
     */
    public function getUser($id) {
        $res = $this->db->ExecuteSelectQueryAndFetchAll(self::SQL('select id user'), array($id));
        if (empty($res)) {
            $this->AddMessage('error', "Failed to load usere with id : '$id'.");
            return false;
        } else {
            $this->data = $res[0];
        } return true;
    }

    /**
     * Save a user
     * @param type $id
     * @param type $acronym
     * @param type $name
     * @param type $email
     * @return boolean
     */
    public function SaveUser($id, $acronym, $name, $email) {
        $this->db->ExecuteQuery(self::SQL('update user profile'), array($acronym, $name, $email, $id));
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to edit and save user.");
            return false;
        }
        return true;
    }

    /**
     * Change User Password
     * @param type $plain
     * @param type $id
     * @return type
     */
    public function ChangeUserPassword($plain, $id) {
        $password = $this->CreatePassword($plain);
        $this->db->ExecuteQuery(self::SQL('update password'), array($password['algorithm'], $password['salt'], $password['password'], $id));
        return $this->db->RowCount() === 1;
    }

    /**
     * User to Leave a Group 
     * @param type $groupeid
     * @param type $userid
     * @return boolean
     */
    public function LeaveGroup($groupeid, $userid) {
        $this->db->ExecuteQuery(self::SQL('delete user2group'), array($userid, $groupeid));
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to Leave groupe.");
            return false;
        }
        return true;
    }

    /**
     * User to Join Group
     * @param type $groupeid
     * @param type $userid
     * @return boolean
     */
    public function JoinGroup($groupeid, $userid) {
        try {
        $this->db->ExecuteQuery(self::SQL('insert into user2group'), array($userid, $groupeid));
        } catch (Exception $e){}
        if ($this->db->RowCount() == 0) {
            $this->AddMessage('error', "Failed to join groupe.");
            return false;
        }
        return true;
    }

}
