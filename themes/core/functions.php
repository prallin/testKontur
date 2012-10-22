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
                        <li><a href="' . base_url() . 'index">presentation</a></li>
                        <li><a href="' . base_url() . 'guestbook">gästbok</a></li>
                        <li><a href="' . base_url() . 'report">redovisning</a></li>
                        <li><a href="' . base_url() . 'source">källkod</a></li>
                        <li><a href="' . base_url() . 'developer">utvecklare</a></li>    
                    </ul>
                </nav>';

$kontur -> data['footer'] = '<div class="footer-container">
        	<footer class="wrapper">
                <h3>© 2012 Gustav Söderström</h3>
                <p>kurs: Databasdrivna webbapplikationer med PHP och Model View Controller (MVC)</p>
				<p>moment: Kmom03: En gästbok i ditt MVC-ramverk</p>
            </footer>
        </div>';
