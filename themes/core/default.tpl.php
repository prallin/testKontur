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
        <link rel="stylesheet" href="<?php echo $kontur->data['stylesheetNormalize']; ?>"/>
        <link rel="stylesheet" href="<?php echo $kontur->data['stylesheetMain']; ?>"/>          
        <?php if(isset($kontur->data['style'])){
        	echo $kontur->data['style']; 
        	}    
		  ?>
        <script src="<?php echo $kontur->data['modernizr']; ?>"></script>

        </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="header-container">
            <header class="wrapper clearfix">
            	<?=$header?>
            	<?=$menu?>
            </header>
        </div>
        <div class="main-container">
            <div class="main wrapper clearfix">
            	<?=get_messages_from_session()?>
            	<?=@$main?>
            	<?=render_views()?>
             	<div class="debug"><?=get_debug()?></div>
             </div> <!-- #main -->
        </div> <!-- #main-container -->

			<div id="footer"><?=$footer?></div>


        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
   		
   		<script>window.jQuery || document.write('<script src="<?php echo $kontur->data['jquery']; ?>"><\/script>')</script>
        <script src="<?php echo $kontur->data['JSmain']; ?>"></script>
        <script src="<?php echo $kontur->data['JSplugins']; ?>"></script>



        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-34999928-2'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>