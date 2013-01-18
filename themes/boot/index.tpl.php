<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'/>
        <title><?= $title ?></title>
        <link rel='shortcut icon' href='<?= theme_url($favicon) ?>'/>
        <!-- css and Bootstrap -->
        <link href='<?=theme_url($stylesheet) ?>' rel="stylesheet" media="screen">
       
    </head>
    <body>
        <div class="row-fluid well">
            <div class="span1"><a href='<?= base_url() ?>'><img id='site-logo' src='<?= theme_url($logo) ?>' alt='logo' width='<?= theme_url($logo_width) ?>' height='<?= theme_url($logo_height) ?>' /></a></div>
            <div class="span7"><h1><a href='<?= base_url() ?>'><?= $header ?></a><small> <?= $slogan ?></small></h1></div>
            <div class="span2 offset1"><?= login_menu() ?></div>
            <div class="span8" id="navbar"><?=render_views('navbar')?></div>           
        </div>
         <?php if (region_has_content('flash')): ?>
            <div class="row-fluid">
                <div class='span10 offset1'>
                    <div><?= render_views('flash') ?></div>
                </div>
            </div>
        <?php endif; ?>
        
             <?php if (region_has_content('featured-first', 'featured-middle', 'featured-last')): ?>
            <div class="row-fluid">
                <div class="span10 offset1">
                    <div class="span3"><?= render_views('featured-first') ?></div>
                    <div class="span3"><?= render_views('featured-middle') ?></div>
                    <div class="span3"><?= render_views('featured-last') ?></div>
                </div>
            </div>
        <?php endif; ?>
        

        <div class="row-fluid">
            <div class="span4 offset1"><?= get_messages_from_session_theme() ?></div>
        </div>
        <div class="row-fluid">
            <div class="span7 offset1"><?= @$main ?><?= render_views('primary') ?><?= render_views() ?></div>
            <div id='sidebar' class="span2 offset1"><?=render_views('sidebar')?></div>
        </div>
        
        <?php if (region_has_content('triptych-first', 'triptych-middle', 'triptych-last')): ?>
        <div class="row-fluid"">
            <div class="span10 offset1">
                <div class="span3"><?= render_views('triptych-first') ?></div>
                <div class="span3"><?= render_views('triptych-middle') ?></div>
                <div class="span3"><?= render_views('triptych-last') ?></div>
            </div>
        </div>
        <?php endif; ?>       
       
        <?php if (region_has_content('footer-column-one', 'footer-column-two', 'footer-column-three', 'footer-column-four')): ?>
           <div class="row-fluid well">
            <div class="span10 offset1">
                <div class="span3"><?= render_views('footer-column-one') ?></div>
                <div class="span3"><?= render_views('footer-column-two') ?></div>
                <div class="span3"><?= render_views('footer-column-three') ?></div>
                <div class="span3"><?= render_views('footer-column-four') ?></div>
            </div>
           </div>
        <?php endif; ?>
        <div class="row-fluid well">
            <div class="span10 offset1"><?= $footer ?></div>
        </div>
        <?=get_debug() ?>
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src='<?= $javascript ?>bootstrap.js'></script>
    </body>
</html>