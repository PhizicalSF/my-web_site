<?php if(count($errMsg)>0):?>
    <?php foreach ($errMsg as $error):?>
        <li><?=$error;?></li>
        <?php endforeach;?>
        <?php endif?>