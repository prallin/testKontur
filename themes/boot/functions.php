<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function getMenuThem(){
    $url = current_url();
    $m = array('home'=> base_url() . 'page/view/4',
        'index'=> base_url() . 'index',
        'gästbok'=> base_url() . 'guestbook',
        'redovisning'=> base_url() . 'report',
        'källkod'=> base_url() . 'source',
        'utvecklare'=> base_url() . 'developer',
        'blog'=> base_url() . 'blog',
        );
    
    $menu ='<ul class="nav nav-pills">';
    foreach($m as $key => $value) {
            //echo "$key is at $v";
            if ($value === $url) {
                $menu .= '<li  class="active"><a href="'.$value.'">'.$key.'</a></li>';
            } else {
                $menu .= '<li><a href="'.$value.'">'.$key.'</a></li>';
            }
        }
    $menu .= '</ul>';
    
    return $menu;
 
}
/**
 * Get messages stored in flash-session.
 */
function get_messages_from_session_theme() {
  $messages = CKontur::Instance()->session->GetMessages();
  $html = null;
  if(!empty($messages)) {
    foreach($messages as $val) {
      $valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
      $class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
      $html .= "<div class='label label-$class'>{$val['message']}</div>\n";
    }
  }
  return $html;
}

?>
