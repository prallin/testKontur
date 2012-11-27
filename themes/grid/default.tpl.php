<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?= $title ?></title>

        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <!-- stylesheet    -->
        <link rel='stylesheet' href='<?= $stylesheet ?>'/>       
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div class="header-container">
            <header class="wrapper clearfix">
                <div id='login-menu'><?= login_menu() ?></div>
                <?= $header ?>
                <?= $menu ?>
            </header>
        </div>
        <div id='outer-wrap-triptych'>
            <div id='inner-wrap-triptych'>
                <div id='triptych-first'>Triptych first</div>
                <div id='triptych-middle'>Triptych middle</div>
                <div id='triptych-last'>Triptych last</div>
            </div>
        </div>

        <div class="main-container">
            <div class="main wrapper clearfix">
                <?= get_messages_from_session() ?>
                <?= @$main ?>
                <?= render_views() ?>
                <div class="debug"><?= get_debug() ?></div>
            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <div id="footer"><?= $footer ?></div>

    </body>
</html>