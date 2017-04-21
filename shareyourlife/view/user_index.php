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
			</div>
	<?php endif ?>
</article>
