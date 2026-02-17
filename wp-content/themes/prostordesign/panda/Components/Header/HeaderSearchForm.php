<?php

use Utils\Svg;
?>

<form class="header-search__inner " action="<?= home_url("/"); ?>">
    <input id="s" name="s" class="header-search__input" type="text" placeholder=" <?php _e("Hledat na...", "PD_DOMAIN"); ?>">

    <button class="header-search__submit" type="submit">
        <?= Svg::renderSvg("magnifier"); ?>
    </button>

</form>
<div class="header-search__button">
    <?= Svg::renderSvg("search"); ?>
</div>
