<?php
$ordner = "../public/images/upload";
$alledateien = scandir($ordner); //Ordner "files" auslesen
 
foreach ($alledateien as $bild) { // Ausgabeschleife
	$bildinfo = pathinfo($ordner."/".$bild);
	$size = ceil(filesize($ordner."/".$bild)/1024);
	if ($bild != "." && $bild != ".."  && $bild != "_notes" && $bildinfo['basename'] != "Thumbs.db") { 
 ?>
    <li>
        <a href="<?php echo "../images/upload/".$bildinfo['basename'];?>">
        <img src="<?php echo "../images/upload/".$bildinfo['basename'];?>" width="140" alt="Vorschau" /></a> 
        <span><?php echo $bildinfo['filename']; ?> (<?php echo $size ; ?>kb)</span>
    </li>
<?php
 };
 };
?>
</ul>