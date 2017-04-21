<div class="bgbild" >
    <ul>


       <?php if($images->num_rows < 1){
       ?><p>Keine Suchergebnisse</p>
        <?php

       }

       else{
            $count=0;
         while($bild = $images->fetch_object()) {

            if ($count==5) {
                $count=0;
                echo "</div>";
                echo '<div class="bgbild" >';
            }
            $count+=1;
            ?>
            <li class="bilder">
                <a href="../<?= $bild->pfad ?>">
                    <img src="../<?= $bild->pfad ?>" width="140" alt="Vorschau" />
                </a>

            </li>
        <?php }
       }?>
    </ul>
</div>