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
function render_views($region='default') {
  return CKontur::Instance()->views->Render($region);
}

/**
* Check if region has views. Accepts variable amount of arguments as regions.
*
* @param $region string the region to draw the content in.
*/
function region_has_content($region='default'){
    return CKontur::Instance()->views->RegionHasView(func_get_args());
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
 * @return url url to img gravatar
*/
function get_gravatar($size=null) {
  return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim(CKontur::Instance()->user['email']))) . '.jpg?' . ($size ? "s=$size" : null);
}


/**
 * Escape data to make it safe to write in the browser.
 * @return string escapt string
 */
function esc($str) {
  return htmlEnt($str);
}


/**
 * 
 * @param $data string to filter
 * @param $filter string the filter use
 * @return string filterd string
 */
function filter_data($data, $filter) {
    return CMContent::Filter($data, $filter);
}

/**
 * Display diff of time between now and a datetime. 
 *
 * @param $start datetime|string
 * @returns string
 */
function time_diff($start) {
  return formatDateTimeDiff($start);
}

/**
* reflects if user is logged in or not.
*/
function authenticated() {
	$kontur = CKontur::Instance();        
	if($kontur->user['isAuthenticated']){
		return true;
	}
	return false;
}

/**
 * Get list of tools.
 */
function get_tools() {
  global $kontur;
  return <<<EOD
<p>Tools: 
<a href="http://validator.w3.org/check/referer">html5</a>
<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">css3</a>
<a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css21">css21</a>
<a href="http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance">unicorn</a>
<a href="http://validator.w3.org/checklink?uri={$kontur->request->current_url}">links</a>
<a href="http://qa-dev.w3.org/i18n-checker/index?async=false&amp;docAddr={$kontur->request->current_url}">i18n</a>
<!-- <a href="link?">http-header</a> -->
<a href="http://csslint.net/">css-lint</a>
<a href="http://jslint.com/">js-lint</a>
<a href="http://jsperf.com/">js-perf</a>
<a href="http://www.workwithcolor.com/hsl-color-schemer-01.htm">colors</a>
<a href="http://dbwebb.se/style">style</a>
</p>

<p>Docs:
<a href="http://www.w3.org/2009/cheatsheet">cheatsheet</a>
<a href="http://dev.w3.org/html5/spec/spec.html">html5</a>
<a href="http://www.w3.org/TR/CSS2">css2</a>
<a href="http://www.w3.org/Style/CSS/current-work#CSS3">css3</a>
<a href="http://php.net/manual/en/index.php">php</a>
<a href="http://www.sqlite.org/lang.html">sqlite</a>
<a href="http://www.blueprintcss.org/">blueprint</a>
</p>
EOD;
}

function getMenu(){
    global $kontur;
   $menu = '
<a href="' . base_url() . 'page/view/4">home </a>
<a href="' . base_url() . 'index">index </a>
<a href="' . base_url() . 'guestbook">gästbok </a>
<a href="' . base_url() . 'report">redovisning </a>
<a href="' . base_url() . 'source">källkod </a>
<a href="' . base_url() . 'developer">utvecklare </a>
<a href="' . base_url() . 'blog">blog </a>                             
';
   return $menu;
}

