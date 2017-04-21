<div class="bgbild" background="/images/bg.jpeg" >
    <ul>
        <?php foreach($images as $img) :
            $count=0;
            if ($count==7) {
                $count=0;
                echo "</div>";
                echo '<div class="bgbild" background="/images/bg.jpeg"/>';
            }
            $count+=1;
            ?>
        <li class="bilder">
            <a href="/images/upload/<?= $img->dateiname ?>">
                <img src="/images/upload/<?= $img->dateiname ?>" width="140" alt="Vorschau" />
            </a>
            <figcaption>
                <ul> <li>Tags</li></ul>   <?= $img->tags ?>
            </figcaption>
        </li>
        <?php endforeach ?>
    </ul>
</div>