<?php

use Utils\Util;
use Utils\Image;

$languages = icl_get_languages();
$FlagLang = ICL_LANGUAGE_CODE;
if (ICL_LANGUAGE_CODE === "cs") {
    $FlagLang = "cz";
}
?>

<div class="header-language-switcher">
    <div class="header-language-switcher__current">
        <?php echo strtoupper(ICL_LANGUAGE_CODE === "cs" ? "cz" : ICL_LANGUAGE_CODE); ?>
        <img src="" data-src="<?= Image::imageGetUrlFromTheme("svg/arrow-small.svg"); ?>" alt="" aria-hidden="true" draggable="false">
    </div>

    <?php if (Util::arrayIssetAndNotEmpty($languages)) { ?>
        <ul class="header-language-switcher__list">
            <?php

            foreach ($languages as $language) {
                $languageCode = $language["language_code"];
                if ($languageCode === ICL_LANGUAGE_CODE) {
                    continue;
                }
                $languageTitle = strtoupper($languageCode === "cs" ? "cz" : $languageCode);
                $languageUrl = $language["url"];
                $languageName = $language["native_name"];
                echo "<li><a class='header-main__lang-link' href=\"{$languageUrl}\" title=\"{$languageName}\" rel=\"alternate\" hreflang=\"{$languageCode}\">{$languageTitle}</a></li>";
            }
            ?>
        </ul>
    <?php } ?>
</div>
