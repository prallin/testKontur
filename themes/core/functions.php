<?php
/**
 * Helpers for the template file.
 */

/**
 * Add static entries in the template file.
 */

$kontur -> data['header'] = '<h1 class="title">me-sida för gustav söderström </h1><h2>och "kontur" mitt mvc-ramverk</h3>';

$kontur -> data['menu'] = '<nav>
                    <ul>
                        <li><a href="' . base_url() . 'page/view/4">home</a></li>
                        <li><a href="' . base_url() . 'index">index</a></li>
                        <li><a href="' . base_url() . 'guestbook">gästbok</a></li>
                        <li><a href="' . base_url() . 'report">redovisning</a></li>
                        <li><a href="' . base_url() . 'source">källkod</a></li>
                        <li><a href="' . base_url() . 'developer">utvecklare</a></li>  
                        <li><a href="' . base_url() . 'blog">blog</a></li>                
                    </ul>
                </nav>';

$kontur -> data['footer'] = '<div class="footer-container">
        	<footer class="wrapper">  
                <p><nav>© 2012 Gustav Söderström : <ul><li><a href="' . base_url() . 'page/view/5">About page</a></li><li><a href="' . base_url() . 'page/view/6">Download page</a></li><ul></nav></p>	
            </footer>
        </div>';
