README

##Installation
1. Clona från: https://github.com/prallin/testKontur.git
2. Ändra rättigheter rekursiv på mappen och filer site/data till läsa och skriva. Terminal i terminal: chmod -R 777 site/data
3. Ändra RewriteBase till rätt sökväg i .htaccess filen se exempel i .htaccess filen.
4. Öppna webbläsaren och gå till sökvägen där webbplatsen är installerad och följ instruktionerna.


##Anpassning av ramverket
För att skapa ett "childe" tema samt en blog och en sida.

Standardtema "boot" för Konturi är baserat på Lydias men skiljer sig på att den använder sig av bootstrap och därigenom skiljer sig t.ex  fonter, färger och formulär. 
Att bygga en egen anpassad webbplats utifrån ramverket gör lättas genom att skapa ett "childe" themes i site mappen och genom att göra ändringar i site/config.php filen. Följ nedan stående punkter:
1. Skapa en mapp i site/themes med namn på temat som ska skapas.
2. Skapa och placera en css fil i den ny tema mappen.  I det css dokumentet kan förändringar från grund temat göras.  Viktigt är att importera grund temat (det som ska ärvas). Genom att längst upp i dokumentet skriva: @import url(../../../themes/boot/style.css);
3. Lägg även in filen med den logotyp du vill använda på sidan i den nya mappen. 
4. Ändringar i site/config.php för att skapa och aktivera ett "childe" themes.
	a. Leta upp stycket kommenterat med "Settings for the childe theme 'myboottheme'". kopiera det och kommentera ut det.
	b. I kopian så ändra inställningarna för 'name' så att det är det nya temat som du vill skapa. 'path' är sökvägen till din nyskapade tema map. 'stylesheet' är namnet på din nya css fil.
	c. Här går det även att ändra på den fasta informationen på den nya webbplatsen så som:  'header' är titel på sidan, 'slogan' är slogan som vissas under header, 'footer' är sid sid foten.
	d. För att lägga in din nya loggo ändra på värdet på 'logo' till rätt filnamn. Ändra även på 'logo_width', 'logo_height' så att värdet stämmer med pixel antalet på den nya loggan.
	e. Navigeringsmenyn ändras under stycket 'menu_to_region' => array('my-navbar' => 'navbar'), Där 'my-navbar' ska byttas ut mot den nya menyn som du vill skapa t.ex 'mysite-navbar'
	f. Skapa och lägg till din meny. Leta upp stycket  kommenterat med "Define menus." Där kan du lägga till din nya menyn.  Genom att lägga 'mysite-navbar' på liknande sätt som 'mu-navbar' exempelvis:
''mysite-navbar' => array(
        'home' => array('label' => 'About Me', 'url' => 'mysite'),
        'blog' => array('label' => 'My Blog', 'url' => 'mysite/blog'),
        'guestbook' => array('label' => 'Guestbook', 'url' => 'mysite/guestbook'),
    ),'

##Att skapa en blog, en sida görs enklast genom att skapa en mapp med kontroller med tillhörande templet fil under site/src. Följ nedanstående punkter:
1. Skapa en mapp i site/src med namn på den kontroller du vill skapa namnet ska börja med CC. Det kan vara t.ex CCMysite.
2. I mappen site/src/CCMycontroller fins exempel på en controller CCMycontroller.php kopiera in den i din nya mapp och döp om den så att den har samma namn som din mapp (med fil ändelse .php).
3. I det dokumentet ska du byta class namn från CCMycontroller till det du valt t.ex: CCMysite
4. I mappen site/src/CCMycontroller fins exempel på fyra template filer:  blog.tpl.php,  page.tpl.php för att visa blog respektive page. Det fins även en error.tpl.php som vissas när besökaren går in på en sida som den inte har rättigheter till. Det fins även en guestbook.tpl för en gästbokssida. kopiera in dessa fyra filer  till din nya controller mapp (CCMysite).
5. Ändringar i site/config.php för att aktivera din nya controller.  Lägg till och aktivera controllern i arrayen $kontur->config['controllers']  Genom att lägga till raden: 'mysite' => array('enabled' => true, 'class' => 'CCMysite'), Där 'mysite' kan bytas ut till början på url som du vill ha och 'CCMysite' ska vara namnet på den controller som du skapat.
6. Nu ska det gå att titta på webbplatsen.
7. Ett förslag är att ändra i routing table förslagsvis lägga till /eller ändra den befintliga till routing regel  : '' => array('enabled' => true, 'url' => 'mysite'),  En som för base url  är tom och pekar på den controller som man vill ska vara först. Det för att hindra att installationen(index) kommer upp.



version 7 - dokumentation
version 6 -
version 5 - 
version 4 -
version 3 -
version 2 - 
version 1 - test av github