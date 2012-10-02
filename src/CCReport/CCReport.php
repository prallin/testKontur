<?php
/**
 * Controller for report
 * För rapporter
 * kurs: Databasdrivna webbapplikationer med PHP och Model View Controller (MVC)
 * 
 * @package konturCore
 */
 
 class CCReport implements IController {
 	
  /**
    * Implementing interface IController. All controllers must have an index action.
   */
	public function Index() {
		global $kontur;
		  $kontur->data['title'] = "Gustav Söderström - redovisning"; 
		  $kontur->data['main'] = <<<EOD
	  
				<article>
                    <header>
                        <h1>Redovisning</h1>
                      
                    </header>
                    <section>
                    	<h2>Moment: Kmom01: En boilerplate</h2>
                        <h3>Utvecklingsmiljö</h2>
                        <p>För att skriva kod använde jag Aptana studio3. Jag brukar använda NetBeans eller Eclipse för Java,  men jag är sugen på att testa framförallt NetBeans för php under kursens gång. Installerade XAMPP som lokal testmiljö.</p>
                        <ul>För övrigt :
                        <li>Mac 10.6.8</li>
                        <li>Firefox, för att kolla resultat </li>
                        <li>Pluggin till firefox - firebug, web developer</li>
                        <li>FileZilla eller Cyberduck som ftp, sftp, ssh</li>
                        </ul>
                    </section>
                    <section>
                        <h3>Bra och dåliga sidor med boilerplate-konceptet.</h3>
                        <p>Det är mycket bra att få en bra grund att bygga vidare på. Praktiskt att ha en färdig css grund som tar hänsyn till många webbläsare och nollställer många variabler. Men när jag när jag validerade html koden för HTML5Boilerplate så fick jag felet "Bad value X-UA-Compatible for attribute http-equiv on element meta". Hittade flera inlägg på bloggar och på forum om saken te.x  <a href="http://blog.yjl.im/2011/01/bad-value-x-ua-compatible-for-attribute.html">bad-value-x-ua-compatible-for-attribute</a> Jag valde att låta koden se ut som från boilerplate och genom det ha kvar valideringsfelet efter som jag litar på att de som har tagit fram  HTML5Boilerplate. Den tilliten är nackdelen med boilerplate.</p>
                    </section>
                      <section>
                        <h2>Arbetet med att framställa min me-sida.</h2>
                        <p>När jag arbetade med att tafram me-sidan så började jag med Layouten utifrån en templet sidan som jag sedan kopierade och ändrade till de andra sidorna. Jag valde att använda php script från mos för att vissa källkod och för att integrera visningen på sidan. När jag testade sidan så hade jag problem i den lokala miljön beroende på . htaccess filen när jag tog bort den så funkade det.</p>
                    </section>
                      <section>
                        <h3>Det intressanta med HTML5Boilerplate</h3>
                        <p>Att kunna få så mycket färdig, testat och strukturerat var väldigt bra. Det var också spännande att experimentera med  <a href="	"> initializr</a></p>
                    </section>
                    
					<section>
                    	<h2>Moment: Kmom02: Grunden till ett MVC-ramverk</h2> 
                       <img src="http://localhost/~gustav/kontur/site/img/seq2.png" alt="seq bild" width="600" height="300" />
                    </section>

                </article>

EOD;

	}
 }
