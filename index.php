<?php

/**
 * Kontur MVC är byggt och inspererad på Lydia av Mikael Roos (mos@dbwebb.se)
 * kurs: Databasdrivna webbapplikationer med PHP och Model View Controller (MVC)
 * 
 * Av: Gustav Söderström
 */

// PHASE: BOOTSTRAP
//
define('KONTUR_INSTALL_PATH', dirname(__FILE__));
define('KONTUR_SITE_PATH', KONTUR_INSTALL_PATH . '/site');

require(KONTUR_INSTALL_PATH.'/src/bootstrap.php');

$kontur = CKontur::Instance();

//
// PHASE: FRONTCONTROLLER ROUTE
//

$kontur->FrontControllerRoute();

//
// PHASE: THEME ENGINE RENDER
//

$kontur->ThemeEngineRender();
