<?php

namespace Utils;

use Components\ThemeSettings\ThemeSettingsFactory;

class Util
{

    public static function renderAnalyticsHeaderCode()
    {
        $ThemeModel = ThemeSettingsFactory::create();
        if ($ThemeModel->isAnalyticsHeaderCode()) {
            echo $ThemeModel->getAnalyticsHeaderCode();
        }
    }

    public static function renderAnalyticsBodyCode()
    {
        $ThemeModel = ThemeSettingsFactory::create();
        if ($ThemeModel->isAnalyticsBodyCode()) {
            echo $ThemeModel->getAnalyticsBodyCode();
        }
    }

    public static function renderCompatibilityScript()
    {
        echo "<!--[if lt IE 9]><script src=\"https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js\"></script><script src=\"https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js\"></script><![endif]-->";
    }

    public static function getTranslatesByKeys(array $Translates, array $Keys)
    {
        $Items = [];

        foreach ($Keys as $Key => $KeyConstant) {

            foreach ($Translates as $TranslateKey => $TranslateValue) {
                if ($KeyConstant == $TranslateKey) {
                    array_push($Items, $TranslateValue);
                    break;
                }
            }
        }
        return $Items;
    }

    public static function getTermsIdsByPostId($Id, $TermKey)
    {
        $TermObjects = wp_get_post_terms($Id, $TermKey);
        $TermNames = [];

        /** @var \WP_Term $Term */
        foreach ($TermObjects as $Term) {
            array_push($TermNames, $Term->term_id);
        }
        return $TermNames;
    }

    public static function getSectionClasses($pTop, $pBot, $divider): string
    {
        $classes = "";

        if (!$pTop) {
            $classes .= "--p-top-0 ";
        }

        if (!$pBot) {
            $classes .= "--p-bottom-0 ";
        }

        if ($divider) {
            $classes .= "--divider ";
        }

        return $classes;
    }


    //? --- KT FUNCTIONS --------------------------------

    /**
     * Kontrola na isset a ! empty v "jednom" kroku
     *
     * @author Martin Hlaváč
     *
     * @param mixed $value
     * @return boolean
     */
    public static function issetAndNotEmpty($value)
    {
        return isset($value) && !empty($value);
    }

    /**
     * Kontrola, zda je zadaný parameter přiřezený, typu pole a má jeden nebo více záznamů
     *
     * @author Martin Hlaváč
     *
     * @param array $array
     * @return boolean
     */
    public static function arrayIssetAndNotEmpty($array = null)
    {
        return isset($array) && is_array($array) && count($array) > 0;
    }

    /**
     * Ze zadaného pole odstraní zadaný klíč (i s hodnotou)
     *
     * @author Martin Hlaváč
     *
     * @param array $haystack
     * @param int|string $needle
     * @return array
     */
    public static function arrayRemoveByKey(array $haystack, $needle)
    {
        if (array_key_exists($needle, $haystack)) {
            unset($haystack[$needle]);
        }
        return $haystack;
    }


    /**
     * Kontrola na ! isset nebo empty v "jednom" kroku
     *
     * @author Martin Hlaváč
     * @link http://www.ktstudio.cz
     *
     * @param mixed $value
     * @return boolean
     */
    public static function notIssetOrEmpty($value)
    {
        return !isset($value) || empty($value);
    }


    /**
     * Kontrola hodnoty, jestli je číselného typu, resp. int a případné přetypování nebo rovnou návrat, jinak null
     *
     * @author Martin Hlaváč
     *
     * @param number $value
     * @return integer|null
     */
    public static function tryGetInt($value)
    {
        if (isset($value) && is_numeric($value)) {
            if (is_int($value)) {
                return $value;
            }
            return (int) $value;
        }
        if ($value === "0") {
            return (int) 0;
        }
        return null;
    }

    /**
     * Vrátí hodnotu pro zadaný klíč pokud existuje nebo výchozí zadanou hodnotu (NULL)
     *
     * @author Martin Hlaváč
     *
     * @param array $array
     * @param string $key
     * @param string $defaultValue
     * @return mixed type|null
     */
    public static function arrayTryGetValue(array $array, $key, $defaultValue = null)
    {
        if (isset($key)) {
            if (array_key_exists($key, $array)) {
                return $array[$key];
            }
        }
        return $defaultValue;
    }


    /**
     * Na základě zadaných parametrů vrátí řetezec pro programové odsazení tabulátorů s případnými novými řádky
     *
     * @author Martin Hlaváč
     *
     * @param integer $tabsCount
     * @param string $content
     * @param boolean $newLineBefore
     * @param boolean $newLineAfter
     * @return string
     */
    public static function getTabsIndent($tabsCount, $content = null, $newLineBefore = false, $newLineAfter = false)
    {
        $result = "";
        if ($newLineBefore == true) {
            $result .= "\n";
        }
        $result .= str_repeat("\t", $tabsCount);
        if (self::issetAndNotEmpty($content)) {
            $result .= $content;
        }
        if ($newLineAfter == true) {
            $result .= "\n";
        }
        return $result;
    }

    /**
     * Prověří, zda zadaný parametr je ve formátu pro ID v databázi
     * Je: Setnutý, není prázdný a je větší než 0
     *
     * @author Tomáš Kocifaj
     *
     * @param mixed $value
     * @return boolean
     */
    public static function isIdFormat($value)
    {
        $id = self::tryGetInt($value);
        if ($id > 0) {
            return true;
        }
        return false;
    }

    /**
     * Vrátí aktuální URL na základě nastavení APACHE HTTP_HOST a REQUEST_URI
     *
     * @author Martin Hlaváč
     *
     * @param boolean $fullUrl - true i s pametry, false bez
     * @return string
     */
    public static function getRequestUrl($fullUrl = true)
    {
        $requestUrl = "http";
        if (self::arrayTryGetValue($_SERVER, "HTTPS") == "on") {
            $requestUrl .= "s";
        }
        $requestUrl .= "://";
        $serverPort = $_SERVER["SERVER_PORT"];
        $serverName = $_SERVER["SERVER_NAME"];
        $httpHost = $_SERVER["HTTP_HOST"];
        $serverKey = (uString::stringEndsWith($httpHost, $serverName)) ? $httpHost : $serverName;
        $serverUri = ($fullUrl) ? $_SERVER["REQUEST_URI"] : $_SERVER["REDIRECT_URL"];
        if ($serverPort == "80" || $serverPort == "443") {
            $requestUrl .= "{$serverKey}{$serverUri}";
        } else {
            $requestUrl .= "{$serverKey}:{$serverPort}{$serverUri}";
        }
        return $requestUrl;
    }

    /**
     * Vrátí (aktuální) IP adresu z pole $_SERVER
     *
     * @author Martin Hlaváč
     * @link http://www.ktstudio.cz
     *
     * @return string
     */
    public static function getIpAddress()
    {
        $ip = self::arrayTryGetValue($_SERVER, "HTTP_CLIENT_IP")
            ?: self::arrayTryGetValue($_SERVER, "HTTP_X_FORWARDED_FOR")
            ?: self::arrayTryGetValue($_SERVER, "REMOTE_ADDR");
        return $ip;
    }

    /**
     * Escapování HTML atribuntů v zadaném textu (+ trim) nebo null
     *
     * @author Martin Hlaváč
     * @link http://www.ktstudio.cz
     *
     * @param string $text
     * @return string
     */
    public static function stringEscape($text)
    {
        if (self::issetAndNotEmpty($text)) {
            return esc_attr(trim($text));
        }
        return null;
    }

    /**
     * Returns page id by template file name
     *
     * @param string $template name of template file including .php
     */

    public static function getPageIdByTemplate($template)
    {
        $args = [
            'post_type' => 'page',
            'nopaging' => true,
            'meta_key' => '_wp_page_template',
            'meta_value' => $template
        ];
        $pages = get_posts($args);
        return $pages;
    }

    /**
     * Vypíše požadované menu bez "obalujícího" divu
     *
     * @author Martin Hlaváč
     * @link http://www.ktstudio.cz
     *
     * @param string $themeLocation
     * @param int $depth
     * @param \Walker_Nav_Menu $customWalker
     * @param array $customArgs
     */
    public static function theWpNavMenuWithSpan($themeLocation, $depth = 0, \Walker_Nav_Menu $customWalker = null, array $customArgs = null)
    {
        $defaults = array(
            "theme_location" => $themeLocation,
            "container" => false,
            "depth" => $depth,
            "items_wrap" => '%3$s',
            "fallback_cb" => false,
            'link_before' => '<span>',
            'link_after' => '</span>',
        );
        if (self::issetAndNotEmpty($customWalker)) {
            $defaults["walker"] = $customWalker;
        }
        $args = wp_parse_args($customArgs, $defaults);
        wp_nav_menu($args);
    }


    public static function fancyPrice(string $price): string
    {
        // Get currency code and resolve display label (special case for CZK)
        $currencyCode = get_woocommerce_currency();
        $currencyLabel = ($currencyCode === 'CZK') ? 'Kč' : $currencyCode;

        // Normalize input and detect if it's strictly digits (ignoring whitespace)
        $raw = (string) $price;
        $isDigitsOnly = preg_match('/^\s*\d+\s*$/', $raw) === 1;

        // For digits-only values, strip spaces before formatting to avoid parsing surprises
        if ($isDigitsOnly) {
            $normalized = preg_replace('/\s+/', '', $raw);
            $formatted = number_format($normalized, 0, '-', ' ');
        } else {
            // Preserve previous behavior: let PHP coerce non-digit strings when formatting
            $formatted = number_format($price, 0, '-', ' ');
        }

        // Build suffix and CZK-specific note
        $suffix = '&nbsp;' . $currencyLabel;
        if ($currencyCode === 'CZK' && !$isDigitsOnly) {
            $suffix .= ' bez DPH';
        }

        return $formatted . $suffix;
    }

    /**
     * Vypíše stránkování určené pro WP loopu v bootstrap stylu dle WordPressu
     *
     * @author Martin Hlaváč
     * @link http://www.ktstudio.cz
     *
     * @param boolean $previousNext
     * @param string $customClass
     * @param \WP_Query $query
     * @param string $customStyle
     * @global integer $paged
     * @global \WP_Query $wp_query
     */
    public static function customBootstrapPaginateLinks($previousNext = true, $customClass = null, \WP_Query $query = null, $customStyle = null)
    {
        global $wp_query;
        global $paged;
        $current = self::tryGetInt($paged) ?: 1;
        $pages = self::tryGetInt(($query ?? $wp_query)->max_num_pages);
        $paginateLinks = paginate_links([
            "base" => str_replace(PHP_INT_MAX, "%#%", esc_url(get_pagenum_link(PHP_INT_MAX))),
            "format" => "?paged=%#%",
            "current" => $current,
            "total" => $pages,
            "type" => "array",
            "show_all" => false,
            "prev_next" => $previousNext,
            "prev_text" => "<img src=\"\" data-src=\"" . get_template_directory_uri() . "/images/svg/arrow-small.svg\" alt=\"\"> Předchozí",
            "next_text" => "Další <img src=\"\" data-src=\"" . get_template_directory_uri() . "/images/svg/arrow-small.svg\" alt=\"\">",
        ]);
        if (self::arrayIssetAndNotEmpty($paginateLinks)) {
            echo "<ul class=\"pagination $customClass\"$customStyle>";
            foreach ($paginateLinks as $index => $link) {
                $activeClass = \KT::stringContains($link, "current") ? " class=\"active\"" : "";
                $nextClass = \KT::stringContains($link, "next") ? " class=\"next\"" : "";
                $prevClass = \KT::stringContains($link, "prev") ? " class=\"prev\"" : "";

                echo "<li$activeClass $nextClass $prevClass>$link</li>";
            }
            echo "</ul>";
        }
    }

    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 0) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 0) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 0) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

}
