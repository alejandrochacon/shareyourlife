<article class="hreview open special">
	<?php if (empty($_SESSION['user'])): ?>
		<div class="dhd">
			<h2 class="item title">Hoopla! Sie sind nicht angemeldet</h2>
		</div>
	<?php else: ?>

			<div class="panel panel-default">
				<div class="panel-body">
				<p>Hier hast du die übersicht über dein Konto</p>
                <a href="/user/delete">Konto Löschen</a>
                <p>Hier sind alle deine geuploaded Bilder</p>

                <div class ="bgbild">
                    <?php foreach($images as $img) :
                        $count=0;
                        if ($count==7) {
                            $count=0;
                            echo "</div>";
                            echo '<div class="bgbild" background="/images/bg.jpeg"/>';
                        }
                        $count+=1;
                        ?>

                        <figure class="bilder">
                            <a href= "../images/upload/<?= $img->dateiname ?>">
                                <img src="/images/upload/<?= $img->dateiname ?>" width="140" alt="<?= $img->dateiname ?>" /></a>
                            <figcaption>
                                <?= $img->tags ?>
                            </figcaption>
                            <a href ="/bilder/delete?id=<?= $img->id ?>"> Bild Löschen</a>
                        </figure>
                    <?php endforeach ?>
                </div>
			</div>
	<?php endif ?>
     <link href="/css/style2.css" rel="stylesheet">
</article>
