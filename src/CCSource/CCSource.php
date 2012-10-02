<?php
/**
 * Controller for Source to display the Source, helpful methods for the developer.
 * 
 * @package konturCore
 */
class CCSource implements IController {
	
	/**
    * Implementing interface IController. All controllers must have an index action.
   */
	public function Index() {
		
		global $kontur;
		$sourceBasedir=dirname(KONTUR_SITE_PATH);  // Which directory to display
		//$sourceBasedir=dirname(__FILE__);  // Which directory to display
		$sourceBaseUrl="?";      // What is the base url of of this script?
		$sourceNoEcho=true;      // Do not echo result, store in $sourceBody instead
		$sourceNoIntro=true;     // Do not display the intro, I want to write my own header and ingress
		include("source.php");
		$pageStyle=$sourceStyle; // $sourceStyle contains the CSS you need to present the HTML, put in HTML head.
		$pageBody=$sourceBody;   // The actual content of source.php, echo it out.
		//$this->Source_include();
		$kontur->data['title'] = "Källkod";
		$kontur->data['style'] = "<style type='text/css'><?=$sourceStyle?></style>";
		$kontur->data['main'] = <<<EOD

				<article>
					<header>
						  <h1>Visning av källkod</h1>
  						<?=$pageBody?>				
				</article>
EOD;
	}
	

}
