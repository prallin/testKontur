<?php
/**
 * Helpers for theming, available for all themes in their template files and functions.php.
 * This file is included right before the themes own functions.php
 */
 

/**
 * Print debuginformation from the framework.
 */
function get_debug() {
  // Only if debug is wanted.
  $kontur = CKontur::Instance();  
  if(empty($kontur->config['debug'])) {
    return;
  }
  
  // Get the debug output
  $html = null;
  if(isset($kontur->config['debug']['db-num-queries']) && $kontur->config['debug']['db-num-queries'] && isset($kontur->db)) {
    $flash = $kontur->session->GetFlash('database_numQueries');
    $flash = $flash ? "$flash + " : null;
    $html .= "<p>Database made $flash" . $kontur->db->GetNumQueries() . " queries.</p>";
  }    
  if(isset($kontur->config['debug']['db-queries']) && $kontur->config['debug']['db-queries'] && isset($kontur->db)) {
    $flash = $kontur->session->GetFlash('database_queries');
    $queries = $kontur->db->GetQueries();
    if($flash) {
      $queries = array_merge($flash, $queries);
    }
    $html .= "<p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $queries) . "</pre>";
  }    
  if(isset($kontur->config['debug']['timer']) && $kontur->config['debug']['timer']) {
    $html .= "<p>Page was loaded in " . round(microtime(true) - $kontur->timer['first'], 5)*1000 . " msecs.</p>";
  }    
  if(isset($kontur->config['debug']['kontur']) && $kontur->config['debug']['kontur']) {
    $html .= "<hr><h3>Debuginformation</h3><p>The content of CKontur:</p><pre>" . htmlent(print_r($kontur, true)) . "</pre>";
  }    
  if(isset($kontur->config['debug']['session']) && $kontur->config['debug']['session']) {
    $html .= "<hr><h3>SESSION</h3><p>The content of CKontur->session:</p><pre>" . htmlent(print_r($kontur->session, true)) . "</pre>";
    $html .= "<p>The content of \$_SESSION:</p><pre>" . htmlent(print_r($_SESSION, true)) . "</pre>";
  }    
  return $html;
}


/**
 * Get messages stored in flash-session.
 */
function get_messages_from_session() {
  $messages = CKontur::Instance()->session->GetMessages();
  $html = null;
  if(!empty($messages)) {
    foreach($messages as $val) {
      $valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
      $class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
      $html .= "<div class='$class'>{$val['message']}</div>\n";
    }
  }
  return $html;
}


/**
 * Prepend the base_url.
 */
function base_url($url=null) {
  return CKontur::Instance()->request->base_url . trim($url, '/');
}


/**
 * Create a url to an internal resource.
 *
 * @param string the whole url or the controller. Leave empty for current controller.
 * @param string the method when specifying controller as first argument, else leave empty.
 * @param string the extra arguments to the method, leave empty if not using method.
 */
function create_url($urlOrController=null, $method=null, $arguments=null) {
  return CKontur::Instance()->request->CreateUrl($urlOrController, $method, $arguments);
}


/**
 * Prepend the theme_url, which is the url to the current theme directory.
 */
function theme_url($url) {
  $kontur = CKontur::Instance();
  return "{$kontur->request->base_url}themes/{$kontur->config['theme']['name']}/{$url}";
}


/**
 * Return the current url.
 */
function current_url() {
  return CKontur::Instance()->request->current_url;
}


/**
 * Render all views.
 */
function render_views() {
  return CKontur::Instance()->views->Render();
}

/**
* Login menu. Creates a menu which reflects if user is logged in or not.
*/
function login_menu() {
	$kontur = CKontur::Instance();
	if($kontur->user['isAuthenticated']){
		$items = "<a href='" . create_url('user/profile') . "'><img class='gravatar' src='" . get_gravatar(20) . "' alt=''> " . $kontur->user['acronym'] . "</a> ";
		if($kontur->user['hasRoleAdmin']){
		$items .= "<a href='" . create_url('acp') . "'>acp</a> ";
		}
		$items .= "<a href='" . create_url('user/logout') . "'>logout</a> ";
	} 
	 
	else {
		 $items = "<a href='" . create_url('user/login') . "'>login</a> ";
	}
	return "<nav>$items</nav>";
}

/**
* Get a gravatar based on the user's email.
*/
function get_gravatar($size=null) {
  return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim(CKontur::Instance()->user['email']))) . '.jpg?' . ($size ? "s=$size" : null);
}


