<div class="bgbild" >
   <?php $count=0;
         foreach($images as $img) :
            
            if ($count==5) {
                $count=0;
                echo "</div>";
                echo '<div class="bgbild" >';
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
        <?php 
        endforeach ?>
</div>