<?php

use Utils\Util;
use Utils\Image;
?>

<h2 class="search-form__heading article-heading">
    <?php _e("Vyhledávání pro:", "PD_DOMAIN"); ?>
</h2>

<form id="search-form" role="search" method="get" class="search-form" action="<?php echo home_url("/"); ?>">
    <input name="s" class="search-form__input" type="text" value="<?= Util::stringEscape(get_search_query(false)); ?>">
    <button class="search-form__submit" type="submit">
        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/magnifier-primary.svg"); ?>" alt="" aria-hidden="true" draggable="false">
    </button>
</form>
