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
 */
function create_url($url=null) {
  return CKontur::Instance()->request->CreateUrl($url);
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