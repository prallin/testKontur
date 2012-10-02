<?php
/**
 * Helpers for the template file.
 */

/**
 * Add static entries in the template file.
 */
 

$kontur -> data['header'] = <<<EOD

<h1 class="title">me-sida för gustav söderström </h1>
<h2>och "kontur" mitt mvc-ramverk</h3>
				<nav>
                    <ul>
                        <li><a href="index">presentation</a></li>
                        <li><a href="report">redovisning</a></li>
                        <li><a href="source">källkod</a></li>
                        <li><a href="developer">utvecklare</a></li>
                    </ul>
                </nav>
							
EOD;

$kontur -> data['footer'] = <<<EOD

<div class="footer-container">
        	<footer class="wrapper">
                <h3>© 2012 Gustav Söderström</h3>
                <p>kurs: Databasdrivna webbapplikationer med PHP och Model
View Controller (MVC)</p>
<p>moment: Kmom02: Grunden till ett MVC-ramverk</p>
            </footer>
        </div>

EOD;
