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
		$kontur -> data['title'] = "Gustav Söderström - redovisning";
		$kontur -> data['main'] = <<<EOD
	  
				<article>
                    <header>
                        <h1>Redovisning</h1>
                      
                    </header>
                    <section>
                    	<h2>Moment: Kmom01: En boilerplate</h2>
                        <h3>Utvecklingsmiljö</h3>
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
                    	<h3>Mitt ramverk</h3>
                    	<p>Valde namnet "kontur" till mitt ramverk för att det ska ge en kontur till informationen den ska hantera. Här är Länken: <a href="
http://www.student.bth.se/~guse12/kontur/01/">kontur</a></p>                       
                    </section>
                 	 <section>
                        <h3>MVC tutorial </h3>
                        <p>För utom "Lydia så valde jag att arbeta med tutorial <a href="http://net.tutsplus.com/tutorials/php/create-your-first-tiny-mvc-boilerplate-with-php/">Tiny MVC Boilerplate</a> I den saknades många av de delar som finns i "Lydia".  Men den var väldigt bra för att skapa en grundförståelse för hur ett mvc-ramverk fungerar. Jag gjorde ett sequence diagram över "Tiny MVC Boilerplate" </p><p><img src="http://www.student.bth.se/~guse12/kontur/01/site/img/seq2.png" /> </p><p>Det kan vara lite långsamt att titta på video tutorial men den här var bra på att förklara hur delarna i ett MVC hänger ihop.</p>
                     </section>
                    <section>
                        <h3>Grundstrukturen i mitt MVC ramverk</h3>
                        <p>Valde att arbetade igenom lydia tutorial och ändra den koden till att heta kontur och komplettera med Controllers för de delar som behövdes för att bygga upp en liknande sida som på kurs moment Kmom01.
Integrera htmlboiler plate med cms var krångligt arbete framförallt för att mvc-ramverket tar över hur url'erna skapas. Till exempel med javascript och css.
Hade problem med länkarna till css det var svårt att få rätt kommatering runt sökvägen till css dokumentet.
Tillslut löste jag det med att skriva ut css koden med en echo istället för med en kort php tag. Gjorde även en ny controller för att vissa källkod och använde där samma php script från <a href="http://github.com/mosbth/Utility">Mikael Roos </a> som under föregående kurs moment.
När jag publicerade "kontur på student servern så dök det upp flera problem men tillslut så hittade jag att det var rättighetsproblem med flera filer och framförallt .htaccess filen som jag hade glömt att ändra RewriteBase till rätt för student servern. Eftersom "Lydia" använder Reflection API i Controllern så använder "kontur" det också.</p>
                     </section>
					 <section>
                        <h3>Publicerat på github</h3>
                        <p>Har skapat kontot och repository <a href="https://github.com/prallin/testKontur">testKontur</a> på github. 
Det var svårt att få github att funka smidigt med aptana studio även om det står i deras dokumentation att det ska gå. Jag valde istället att arbeta med terminalen för att hantera github.
Efter många tester och olika repository som jag tog bort. För att börja om för att det blev fel filer i den. Så lyckades jag tillslut med en. Så nu återstår det att få in nya versioner i samma repository men det antar jag får bli till nästa uppgift.
                        </p>
                     </section>
				 
					 <section>
                    	<h2>Kmom03: En gästbok i ditt MVC-ramverk</h2>
                    	<h3>Codelgniter</h3>
                    	<p>När jag laddade ner  CodeIgniter och konfigurerade för det nya projektet gästbok.
Funderade ett tag på hur uppdateringar av codelgniter går till <a href="http://codeigniter.com/user_guide/installation/upgrading.html">och läste om det.</a> 

Jag valde att arbeta utifrån <a href="http://codeigniter.com/user_guide/tutorial/index.html">tutorialn</a> som fins i CI's user guide för att bygga<a href="http://www.student.bth.se/~guse12/CIguestbook/index.php/news"> en enkel nyhetssida.</a> 


Det var väldigt  lätt att följa tutorial och mycket roligt att det var så enkelt att komma igång med CI. 
Sedan byggde jag  <a href="http://www.student.bth.se/~guse12/CIguestbook/index.php/guestbook">en gästbok</a> utifrån den kunskapen som jag fick i tutorialn.
och arbetade vidare med att flytta över layout (css) från kursens tidigare moment. 
Det svåraste var att få ordning på url'er för css dokumenten och länkarna i menyn, men hittade ganska snabbt url-helper så det fixade sig med att konstruera en link tag. Läste igenom  CI 's  olika intro texterna under "General Topics" för att få en överblick på CI.

Jag arbetade även igenom <a href="http://dbwebb.se/kunskap/kom-igang-med-codeigniter">CI tutorialn på dbwebb.</a> 
 
Det är därför som det har blivit två stycken <a href="http://www.student.bth.se/~guse12/CIguestbook/index.php/guestbook2">gästböcker på min sida</a> med lite olika utseende. 


Kickade även på <a href="http://codeigniter.com/tutorials/">två video tutorial</a>, tyvärr var dessa två till tidigare versioner av CI men det var en då lärorikt och ett sätt att förstå tänket med CI</p>
                    
                    </section>
                 	 <section>
                        <h3>Mitt egna ramverk "kontur" med gästbok</h3>
                        <p>Arbetade igenom andra andra stycket med Lydia och omarbetade koden så att det skulle passa mitt egna ramverk Kontur.
Hade inte tidigare testat sqlite och jag visste inte att det vara så enkelt att sätta upp en  databas (efter lite strul med rättigheter).
Det här kursmomentet och avsnitt av lydia tutorial var bra på att vissa separeringen av databas, sql-frågor, html-kod och tillslut modell för kodstrukturering.
                        </p>
                     </section>
                      <section>
                        <h3>Länkar</h3>
                        <p>
                        <a href="http://www.student.bth.se/~guse12/kontur/02/index">Kontur med gästbok version 2</a> <br />
 <a href="http://www.student.bth.se/~guse12/CIguestbook/">Gästbok med Codelgniter</a> <br />
<a href="https://github.com/prallin/testKontur">Kontur på github </a> <br />
Här var det lite problem när jag gjorde min commit så följde bara meddelandet med och inte tag'en som jag skapat lokalt för min nya version.
<br /> <a href="http://www.student.bth.se/~guse12/kontur/02/report">Rapport</a></p>

                     </section>
     	 <section>
                    	<h2>Moment: Kmom04: Modeller för login, användare och grupper</h2>
                    	<h3>För sök med zend</h3>
                    	<p>Försökte installera zend på min lokala utvecklings miljö men det visade sig svårt för att jag använde XAMPP på mac som inte har blivit uppdaterad på länge, men efter myckt trixande så fick jag själva zend biblioteket och php att funka. Men de till hörande Zend Tool har jag inte lyckats installera, de vill inte vara exekverbar och påverka den katalog och installation av zend som jag tycker. Antar att den enklaste lösningen är att använda något färdig konfigurerat server lösning från zend. Just nu fick jag lägga ner mina försök för den här gången och valde istället att gå vidare med CI .</p>
                    </section>
                 	 <section>
                        <h3>Formulärhantering i codeigniter</h3>
                        <p>Jag valde att arbeta utifrån:<a href="http://codeigniter.com/user_guide/libraries/form_validation.html">codeigniter user guide form validation</a> Det var mycket enkelt att skapa validiering och nya formulär i CI. Med hjälp av Form Helpers och Form Validation från libraries. Möjligheten att skapa en form_validation.php i config mapen som stälde in rätt validiering för formuläret var mycket praktisk. Även funktionen  set_error_delimiters  för att sätta vilken html kod som Form Helper via form_error skriver ut.
Även om den inte visade alla de delar som lydia-tutorial så borde det inte vara så svårt att skapa en login funktion liknande den. Jag la till ett skapa användare formulär till guestbook siten: <a href="http://www.student.bth.se/~guse12/CIguestbook/index.php/member">CIguestbook</a></p>
                     </section>
                     <section>
                        <h3>Kontur</h3>
                        <p>För mitt egna cms-system valde jag att följa lydia-tutorialn och den strategi för formulärhantering. För mig var arrayAccess något nytt och det tog tid att få det att fungera.  Det var även bra att kunna köra sqlLit från terminalen det gav lite mer verktyg att arbeta med. Lösen ordet följer också lydia dvs sha1 och saltat. Att integrera gravatar med kontur var väldigt fint och enklare en jag vågat tro. Index sidan på kontur blev ett exempel på  Reflection API och att visa vilka kontrollers som är tillgängliga. Login med validiering fins i övre vänstra hörnet på siten: <a href="http://www.student.bth.se/~guse12/kontur/03/">kontur version 3</a></p>
                     </section>
                      <section>
                        <h3>Länkar</h3>
                        <p>
							<a href="http://codeigniter.com/user_guide/libraries/form_validation.html">Codeigniter form validation</a> <br />
							<a href="http://www.student.bth.se/~guse12/CIguestbook/index.php/member">Mitt codeigniter exempel</a> <br />
							<a href="http://www.student.bth.se/~guse12/kontur/03/">Mitt CMS kontur exempel</a> <br />
							<a href="https://github.com/prallin/testKontur">koden för kontur på github</a> <br />
							<a href="http://www.student.bth.se/~guse12/kontur/03/report/">Den här rapporten</a> <br />
						</p>
                     </section>
                     
                     <section>
                     <h2>Moment: Kmom05: Innehåll</h2>
                     <h3>Skapa och spara webbplatsens innehåll</h3>
                     <p>Jag utgick från Lydia tutorial för att lägatill skapa, spara och ändra  hantering till mitt cms Kontur.  Valde att att kontrollerar om användaren var inloggad för att kunna ändra och lägga till innehåll genom att visa eller dölja CRUD och init actions. Men via index-sidan som listar alla controller och funktioner så går det att komma runt den kontrollen.</p>
                     </section>
                     <section>                   
                     <h3>Filtrera</h3>
                     <p>Jag la till stöd för Markdown. När jag gjorde implementationen av Markdown så utgick jag från Lydia tutorialns avsnitt om HTMLPurifier. Det kanske onödigt krångligt att skapa ett eget objekt för filtret efter som Markdown i sig självt inte är beroende av det. Men det kändes rätt endå att sträva efter ett mer objektorienterat arbetsätt. </p>
                     </section>
                     <section>                   
                     <h3>XSS</h3>
                     <p>Efter att ha läst materialet eller rättare sagt delar av så testa jag  några olika XSS och de olika filterna.  Den enklaste testen  med ett javascript resulterade i att de som inte funkade var php och markdown båda exekverade scriptet. plain och bbcode skrevut scriptet på sidan. html och htmlpurify togbort skriptet helt. Min reaktion var oj så mycket som krävs för att säkra upp en webbplats som tillåter användare att lägga in material i någon form. Det blir antagligen till att hitta färdiga lösningar som kan lösa endel av problematiken och testa och testa igen... Bäst tyckte jag om htmlpurify som hanterade filtreringen och formateringen på ett väldigt fint sätt.  Här kan jag se att det borde gå lät att lägga till en WYSIWYG editor tex. <a href="http://www.tinymce.com/">tinymce</a> och använda htmlpurify på ett fint sätt.</p>
                     </section>
                     <h3>Länkar</h3>
                     <p>
                     <a href="http://www.student.bth.se/~guse12/kontur/04/">Mitt CMS kontur exempel</a> <br />
                     <a href="https://github.com/prallin/testKontur">koden för kontur på github</a> <br />
                     <a href="http://www.student.bth.se/~guse12/kontur/04/report/">Den här rapporten</a> <br />
                     </p>
                     </section>
					 
                </article>

EOD;

	}

}
