<?php
/**
* Standard controller layout.
* 
* @package konturCore
*/
class CCIndex implements IController {

   /**
    * Implementing interface IController. All controllers must have an index action.
    */
   public function Index() {   
      global $kontur;
      $kontur->data['title'] = "me-sida för gustav söderström och kontur mitt cms";
	  $kontur->data['main'] = <<<EOD
	  
				<article>
					<header>
						<h1>Bakgrund</h1>
						<p>
							Jag är föd i Skellefteå men bor just nu i Lviv i Ukraina med sambo och katt och är för närvarande tjänstledig från mitt arbete i Göteborg som tekniker och handledare i digitalamedier på ett företag som håller på med support för kulturtidskrifter och kulturentreprenörer. Det innebär att jag har haft hand om systemunderhåll på mac datorer och drivit ett litet webbhotell. Handlett i bland annat i videoredigering, adobe-program, wordpress. Har byggt flera enklare webbplatser och har haft flera olika roller i några mer avancerade webbprojekt. Men jag har alltid fått ta in någon för att lösa programmeringen när det har blivit lite mer krångligt.
						</p>
					</header>
					<section>
						<h2>Tidigare studier</h2>
						<p>
							Sedan 2 år så har jag studerat programmering och webbutveckling på distans.
							Nu i våras så läset jag Designmönster med Java på Mittuniversitetet.
							På Högskolan i väst har jag läst Webbutveckling med delkurser som exempelvis php, mysql, xml, html.
						</p>
					</section>
					<section>
						<h2>Förväntningar</h2>
						<p>
							Min förhoppning på kursen ska göra mig mer säker på php, MVC, CMS system och knyta i hopp kunskaperna från mina tidigare kurser.
						</p>
					</section>
				</article>
EOD;
	  
   }

}       