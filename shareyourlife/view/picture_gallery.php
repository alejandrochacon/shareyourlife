<?php
$ordner = "../public/images/upload";
$alledateien = scandir($ordner); //Ordner "files" auslesen
$count=0;
echo('<div class="bgbild" background="/images/bg.jpeg"/>');
foreach ($alledateien as $bild) { // Ausgabeschleife
	if ($count==7) {
		$count=0;
		echo "</div>";
		echo '<div class="bgbild" background="/images/bg.jpeg"/>';
	}
	$count+=1;
	$bildinfo = pathinfo($ordner."/".$bild);
	$size = ceil(filesize($ordner."/".$bild)/1024);
	if ($bild != "." && $bild != ".."  && $bild != "_notes" && $bildinfo['basename'] != "Thumbs.db") { 
 ?>
	<link href="/css/style2.css" rel="stylesheet">
    <li class="bilder">
    	
        <a href="<?php echo "../images/upload/".$bildinfo['basename'];?>">
        <img src="<?php echo "../images/upload/".$bildinfo['basename'];?>" width="140" alt="Vorschau" /></a> 
    </li>

<?php
 };
 };
?>
</ul>
</div>