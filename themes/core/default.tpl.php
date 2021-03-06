<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?=$title?></title>
        
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        
        <!-- stylesheet    -->
        <link href='<?= $stylesheet ?>normalize.css' rel="stylesheet" media="screen">
        <link href='<?= $stylesheet ?>main.css' rel="stylesheet" media="screen">
        <?php if(isset($kontur->data['style'])){
        	echo $kontur->data['style']; 
        	}    
		  ?>
       <script src='<?= $javascript ?>vendor/modernizr-2.6.1.min.js'></script>

        </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="header-container">
            <header class="wrapper clearfix">
            	<div id='login-menu'><?=login_menu()?></div>
            	<?=$header?>
            	<?=$menu?>
            </header>
        </div>
               <?php if (region_has_content('flash')): ?>
            <div id='outer-wrap-flash'>
                <div id='inner-wrap-flash'>
                    <div id='flash'><?= render_views('flash') ?></div>
                </div>
            </div>
        <?php endif; ?>
        
        <div class="main-container">
            <div class="main wrapper clearfix">
            	<?=get_messages_from_session()?>
            	<?=@$main?>
                <?=render_views('primary')?>
            	<?=render_views()?>
             	<div class="debug"><?=get_debug()?></div>
             </div> <!-- #main -->
        </div> <!-- #main-container -->
        
        </div>
        <div id="footer"><div class="footer-container">
        	<footer class="wrapper">  
                <p><?=$footer?></p>	
            </footer></div> 
    </body>
</html>