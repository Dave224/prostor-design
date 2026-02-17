<?php

namespace Components\Product;

use Components\Block\BlockFactory;
use Helpers\ImageCreator;
use Utils\Image;
use Utils\Util;

class ProductModel extends \KT_WP_Post_Base_Model
{

    const PRODUCT_META_STOCK_STATUS_KEY = '_stock_status';
    const PRODUCT_TYPE_VARIABLE = 'variable';
    const STOCK_STATUS_IN_STOCK = 'instock';
    const STOCK_STATUS_OUT_OF_STOCK = 'outofstock';
    const STOCK_STATUS_ON_ORDER = 'onbackorder';
    const STOCK_STATUS_AT_SUPPLIER = 'atsupplier';
    const MIN_NUMBER_OF_PRODUCTS = "minimum_allowed_quantity";
    const MAX_NUMBER_OF_PRODUCTS = "maximum_allowed_quantity";
    const PRODUCT_SHIPPING_CLASS = "product_shipping_class";
    const STOCK_COUNT = "_stock";
    const PRODUCT_LENGTH = "_length";
    const PRODUCT_WIDTH = "_width";
    const PRODUCT_HEIGHT = "_height";
    const PRODUCT_WEIGHT = "_weight";
    const PRODUCT_ATTRIBUTES = "_product_attributes";

    private $BrandModel;
    private $WcProduct;
    private $productGalleryImages;
    private $price;
    private $priceBasic;
    private $priceDiscount;

    function __construct(\WP_Post $post)
    {
        parent::__construct($post, ProductConfig::FORM_PREFIX);
        $this->setWooCommerceProduct();
    }

    public function getImageSize($imageId, $width, $height)
    {
        return Image::getCloudImage($imageId, $width, $height);
    }

    public function renderGalleryDetailImageSrc($ImageId): ?string
    {
        $Image = $this->getImageSize($ImageId, 1270, null);
        return $Image;
    }

    public function renderThumbnail(): ?string
    {
        $ImageId = $this->getThumbnailId();
        $Image = new ImageCreator($ImageId);

        $Image->setSrcWithoutPostfix($this->getImageSize($ImageId, 496, 592));
        $Image->addToSrcset($this->getImageSize($ImageId, 496, 592), "1x");
        $Image->addToSrcset($this->getImageSize($ImageId, 992, 1184), "2x");
        $Image->setClass("intro-section__img");
        $Image->setDraggable(false);

        return $Image->render();
    }

    public function renderThumbnailPopUp(): ?string
    {
        $ImageId = $this->getThumbnailId();
        $Image = new ImageCreator($ImageId);

        $Image->setSrcWithoutPostfix($this->getImageSize($ImageId, 220, 168));
        $Image->addToSrcset($this->getImageSize($ImageId, 220, 168), "1x");
        $Image->addToSrcset($this->getImageSize($ImageId, 440, 336), "2x");
        $Image->setDraggable(false);

        return $Image->render();
    }

    public function renderThumbnailSlider(): ?string
    {
        $ImageId = $this->getThumbnailId();
        $Image = new ImageCreator($ImageId);

        $Image->setSrcWithoutPostfix($this->getImageSize($ImageId, 448, 280));
        $Image->addToSrcset($this->getImageSize($ImageId, 448, 280), "1x");
        $Image->addToSrcset($this->getImageSize($ImageId, 896, 560), "2x");
        $Image->setClass("product-detail-item__img");
        $Image->setDraggable(false);

        return $Image->render();
    }

    public function getGalleryImages(): ?array
    {
        $attachment_ids = $this->WcProduct->get_gallery_image_ids();
        $GalleryImages = [];

        foreach ($attachment_ids as $attachment_id) {
            $ImageUrl = $this->getImageSize($attachment_id, 1270, null);

            $Image = new ImageCreator($attachment_id);
            $Image->setSrcWithoutPostfix($this->getImageSize($attachment_id, 208, null));
            $Image->addToSrcset($this->getImageSize($attachment_id, 208, null), "1x");
            $Image->addToSrcset($this->getImageSize($attachment_id, 416, null), "2x");
            $Image->setDraggable(false);
            $ImageItem = $Image->render();

            $GalleryImage = [
                "ImageUrl" => $ImageUrl,
                "ImageRender" => $ImageItem
            ];
            array_push($GalleryImages, $GalleryImage);
        }
        return $GalleryImages;
    }

    public function setWooCommerceProduct()
    {
        $this->WcProduct = wc_get_product($this->getPostId());
    }

    public function getWooCommerceProduct()
    {
        return $this->WcProduct;
    }

    public function getThumbnailSrc()
    {
        return wp_get_attachment_image_url($this->getThumbnailId());
    }

    public function getFileFormatSizeUnits($fileId)
    {
        $bytes = $this->getFileSize($fileId);
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

    public function getFileSize($fileId)
    {
        return filesize(get_attached_file($fileId));
    }

    //? --- Getry ------------------------------------------------------------

    public function getExcerptClean(): ?string
    {
        return strip_tags($this->getExcerpt() ?? "", "<a><strong><b><i>") ?? null;
    }

    public function getStockStatus()
    {
        if ($this->WcProduct->get_type() === self::PRODUCT_TYPE_VARIABLE) {
            return $this->getVariableProductStockStatus($this->WcProduct);
        }

        return get_post_meta($this->getPostId(), self::PRODUCT_META_STOCK_STATUS_KEY, true);
    }

    public function getStockStatusClass(): string
    {
        $Class = "";

        if ($this->getStockStatus() == self::STOCK_STATUS_IN_STOCK) {
            $Class = "--available";
        }

        if ($this->getStockStatus() == self::STOCK_STATUS_AT_SUPPLIER || $this->getStockStatus() == self::STOCK_STATUS_ON_ORDER) {
            $Class = "--on-the-way";
        }

        if ($this->getStockStatus() == self::STOCK_STATUS_OUT_OF_STOCK) {
            $Class = "--unavailable";
        }

        return $Class;
    }

    public function getStockStatusFancy(): string
    {
        $Value = "";

        if ($this->getStockStatus() == self::STOCK_STATUS_IN_STOCK) {
            $StockCount = get_post_meta($this->getPostId(), self::STOCK_COUNT, true);
            $Value = $StockCount . __(" Skladem", "PD_DOMAIN");
        }

        if ($this->getStockStatus() == self::STOCK_STATUS_AT_SUPPLIER) {
            $Value = __("Skladem u dodavatele", "PD_DOMAIN");
        }

        if ($this->getStockStatus() == self::STOCK_STATUS_ON_ORDER) {
            $Value = __("Na objednání", "PD_DOMAIN");
        }


        if ($this->getStockStatus() == self::STOCK_STATUS_OUT_OF_STOCK) {
            $Value = __("Není skladem", "PD_DOMAIN");
        }

        return $Value;
    }

    public function getMinNumberOfProducts()
    {
        return get_post_meta($this->getPostId(), self::MIN_NUMBER_OF_PRODUCTS, true);
    }

    public function getMaxNumberOfProducts()
    {
        return get_post_meta($this->getPostId(), self::MAX_NUMBER_OF_PRODUCTS, true);
    }

    public function getProductShippingClass()
    {
        return get_post_meta($this->getPostId(), self::PRODUCT_SHIPPING_CLASS, true);
    }

    /**
     * 'Cause WooCommerce is very special :)
     */
    public static function getVariableProductStockStatus($product)
    {
        $status = '';
        foreach ($product->get_available_variations() as $data) {
            $variation = new \WC_Product_Variation($data['variation_id']);

            if ($variation->get_stock_status() === self::STOCK_STATUS_IN_STOCK) {
                return self::STOCK_STATUS_IN_STOCK;
            } else {
                $status = $variation->get_stock_status();
            }
        }

        return $status;
    }

    //* --- Cena
    //* --- Prefix: Price

    public function getPriceWithoutTaxPrice()
    {
        return round(wc_get_price_excluding_tax($this->WcProduct, ["price" => $this->getPriceBasicPrice()]));
    }

    public function getPriceWithoutTaxPriceFancy()
    {
        return Util::fancyPrice($this->getPriceWithoutTaxPrice());
    }

    public function getPriceBasicPrice(): ?string
    {
        if (!Util::issetAndNotEmpty($this->priceBasic)) {
            if ($this->WcProduct->get_type() === self::PRODUCT_TYPE_VARIABLE) {
                /** @var \WC_Product_Variable $variable */
                $variable = $this->WcProduct instanceof \WC_Product_Variable
                    ? $this->WcProduct
                    : new \WC_Product_Variable($this->getPostId());
                $value = $variable->get_variation_regular_price('min');
            } else {
                $value = $this->WcProduct->get_regular_price();
            }

            // Normalize to string or null to make the return type explicit
            $this->priceBasic = Util::issetAndNotEmpty($value) ? (string) $value : null;
        }

        return $this->priceBasic;
    }

    public function getPriceBasicPriceFancy(): ?string
    {
        if ($this->getPriceBasicPrice()) {
            return Util::fancyPrice($this->getPriceBasicPrice());
        }
        return null;
    }

    public function getPriceWithoutTaxDiscountPrice()
    {
        return round(wc_get_price_excluding_tax($this->WcProduct));
    }

    public function getPriceWithoutTaxPriceDiscountFancy()
    {
        return Util::fancyPrice($this->getPriceWithoutTaxDiscountPrice());
    }

    public function getPriceDiscountPrice()
    {
        if (!Util::issetAndNotEmpty($this->priceDiscount)) {
            if ($this->WcProduct->get_type() === self::PRODUCT_TYPE_VARIABLE) {
                /** @var \WC_Product_Variable $variable */
                $variable = $this->WcProduct instanceof \WC_Product_Variable
                    ? $this->WcProduct
                    : new \WC_Product_Variable($this->getPostId());
                $this->priceDiscount = $variable->get_variation_sale_price('min');
            } else {
                $this->priceDiscount = $this->WcProduct->get_sale_price();
            }
        }
        return $this->priceDiscount;
    }

    public function getPriceDiscountPriceFancy()
    {
        return Util::fancyPrice($this->getPriceDiscountPrice());
    }

    public function getPrice()
    {
        if (!Util::issetAndNotEmpty($this->price)) {
            if ($this->WcProduct->get_type() === self::PRODUCT_TYPE_VARIABLE) {
                /** @var \WC_Product_Variable $variable */
                $variable = $this->WcProduct instanceof \WC_Product_Variable
                    ? $this->WcProduct
                    : new \WC_Product_Variable($this->getPostId());
                $this->price = $variable->get_variation_price('min');
            } else {
                $this->price = $this->WcProduct->get_price();
            }
        }
        return $this->price;
    }

    public function getPriceFancy()
    {
        return Util::fancyPrice($this->getPrice());
    }

    public function getCrossSellProductsIds()
    {
        $CrossSellIds = get_post_meta($this->getPostId(), '_crosssell_ids', true);
        return $CrossSellIds;
    }

    //* ---- Produkt parametry

    public function getProductLength()
    {
        return get_post_meta($this->getPostId(), self::PRODUCT_LENGTH, true);
    }

    public function getProductWidth()
    {
        return get_post_meta($this->getPostId(), self::PRODUCT_WIDTH, true);
    }

    public function getProductHeight()
    {
        return get_post_meta($this->getPostId(), self::PRODUCT_HEIGHT, true);
    }

    public function getProductWeight()
    {
        return get_post_meta($this->getPostId(), self::PRODUCT_WEIGHT, true);
    }

    public function getProductDimensions(): string
    {
        $Dimensions = $this->getProductLength() . " x " . $this->getProductWidth() . " x " . $this->getProductHeight();

        return $Dimensions;
    }

    public function getProductAttributes(): ?array
    {
        return get_post_meta($this->getPostId(), self::PRODUCT_ATTRIBUTES);
    }

    public function getProductAttributesTerms(): ?array
    {
        $attribute_taxonomies = wc_get_attribute_taxonomies();

        if ($attribute_taxonomies) {
            foreach ($attribute_taxonomies as $tax) {
                if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) {
                    $terms = get_the_terms($this->getPostId(), wc_attribute_taxonomy_name($tax->attribute_name));
                    if (!is_array($terms)) {
                        continue;
                    }
                    $TermsString = "";
                    $lastElement = end($terms);
                    foreach ($terms as $term) {
                        $TermsString .= $term->name;
                        if ($term != $lastElement) {
                            $TermsString .= ", ";
                        }
                    }
                    $productTerms[$tax->attribute_label] = $TermsString;
                }
            }
        }

        return $productTerms;
    }

    //* Varianty

    public function getProductVariations(): ?array
    {
        if ($this->WcProduct->get_type() === self::PRODUCT_TYPE_VARIABLE) {
            /** @var \WC_Product_Variable $variable */
            $variable = $this->WcProduct instanceof \WC_Product_Variable
                ? $this->WcProduct
                : new \WC_Product_Variable($this->getPostId());
            return $variable->get_available_variations();
        }
        return null;
    }

    public function isVariationsProduct()
    {
        return $this->WcProduct->is_type('variable');
    }

    public function getProductVariantsForSelect($Key): ?string
    {
        $Variants = $this->getProductAttributesTerms();
        $Html = "";
        $Variations = $this->getProductVariations();
        $Prices = [];
        $VariationsIds = [];

        foreach ($Variations as $Variation) {
            array_push($Prices, (int) $Variation["display_regular_price"]);
            array_push($VariationsIds, $Variation["variation_id"]);
        }

        $Iterator = 0;
        foreach ($Variants as $key => $Variant) {

            if ($Key == $key) {
                if ($key == 'Barva') {
                    $key = 'color';
                }
                $Colors = explode(", ", $Variant);
                $iterator = 0;
                foreach ($Colors as $Color) {
                    if (str_contains(array_keys($Variations[0]["attributes"])[0], sanitize_title(strtolower($key)))) {
                        $Price = 'data-price="' . $Prices[$Iterator] . '"';
                        $PriceNoVat = 'data-price-no-vat="' . round(wc_get_price_excluding_tax(wc_get_product($VariationsIds[$Iterator]), [1, $Prices[$Iterator]])) . '"';
                        $VarId = 'data-var-id="' . $VariationsIds[$Iterator] . '"';
                        $Iterator++;
                    }
                    $Html .= '<option ' . $Price . ' ' . $PriceNoVat . ' ' . $VarId . ' value="' . $Color . '" ' . ($iterator == 0 ? "selected" : "") . '> ' . $Color . '</option>';
                    $iterator++;
                }
            }
        }

        return $Html;
    }

    public function getProductDeepVariantsForSelect(): ?string
    {
        $Variants = $this->getProductAttributesTerms();
        $Html = "";

        foreach ($Variants as $key => $Variant) {
            if ($key == "Deep") {
                $Deeps = explode(", ", $Variant);
                $isFirst = true;
                foreach ($Deeps as $Deep) {
                    $Html .= '<option value="' . $Deep . '" ' . ($isFirst ? "selected=\'selected\'" : "") . '> ' . $Deep . '</option>';
                    $isFirst = false;
                }
            }
        }

        return $Html;
    }

    //* --- Podobné produkty

    public function getSimilarProductsIds()
    {
        return $this->WcProduct->get_upsell_ids();
    }

    //* --- Bloky

    public function loopBlocks()
    {
        foreach ($this->getBlockIdsToArray() as $BlockId) {
            $BlockPath = BlockFactory::getBlockPathById($BlockId);
            if ($BlockPath === "") {
                continue;
            }
            if ($BlockId == "title" || $BlockId == "content") {
                $BlockId = $this->getPostId();
            }
            $Block = get_post($BlockId);
            global $post;
            $post = $Block;

            get_template_part($BlockPath);
        }
    }

    public function getBlocksIds()
    {
        $BlocksIds = get_post_meta($this->getPostId(), ProductConfig::BLOCK_INPUT);
        return $BlocksIds = reset($BlocksIds);
    }

    public function getBlockIdsToArray()
    {
        return $BlocksIds = explode(",", $this->getBlocksIds());
    }

    public function isBlocksIds()
    {
        return Util::issetAndNotEmpty($this->getBlocksIds());
    }

    //* --- Parametry
    //* --- Prefix: Params

    public function getParamsTitle()
    {
        return $this->getMetaValue(ProductConfig::PARAMS_TITLE);
    }

    public function getParamsDescription()
    {
        return apply_filters("the_content", $this->getMetaValue(ProductConfig::PARAMS_DESCRIPTION));
    }

    public function getParamsAside()
    {
        return $this->getMetaValue(ProductConfig::PARAMS_ASIDE);
    }

    //* --- Specifikace
    //* --- Prefix: Specification

    public function getSpecificationDynamicField()
    {
        return $this->getMetaValue(ProductConfig::DYNAMIC_SPECIFICATION_FIELD);
    }

    public function getSpecificationDynamicFieldFirstItem()
    {
        return $this->getSpecificationDynamicField()[0][ProductConfig::SPECIFICATION_ITEM];
    }

    //* --- Barvy
    //* --- Prefix: Colors

    public function getColorsDynamicField()
    {
        return $this->getMetaValue(ProductConfig::DYNAMIC_COLORS_FIELD);
    }

    public function getColorsDynamicFieldFirstItem()
    {
        return $this->getColorsDynamicField()[0][ProductConfig::COLORS_TITLE];
    }

    //? --- Issety ------------------------------------------------------

    //* --- Parametry
    //* --- Prefix: Params

    public function isParamsTitle()
    {
        return Util::issetAndNotEmpty($this->getParamsTitle());
    }

    public function isParamsDescription()
    {
        return Util::issetAndNotEmpty($this->getParamsDescription());
    }

    public function isParamsAside()
    {
        return Util::issetAndNotEmpty($this->getParamsAside());
    }

    //* --- Specifikace
    //* --- Prefix: Specification

    public function isSpecificationFieldFirstItem()
    {
        return Util::issetAndNotEmpty($this->getSpecificationDynamicFieldFirstItem());
    }

    //* --- Barvy
    //* --- Prefix: Colors

    public function isColorsFieldFirstItem()
    {
        return Util::issetAndNotEmpty($this->getColorsDynamicFieldFirstItem());
    }

    //* --- Cena
    //* --- Prefix: Price

    public function isPriceBasicPrice()
    {
        return Util::issetAndNotEmpty($this->getPriceBasicPrice());
    }

    public function isPriceDiscountPrice()
    {
        return ($this->getPriceBasicPrice() > $this->getPrice());
    }

    //* --- Produkt parametry

    public function isProductLength(): bool
    {
        return Util::issetAndNotEmpty($this->getProductLength());
    }

    public function isProductWidth(): bool
    {
        return Util::issetAndNotEmpty($this->getProductWidth());
    }

    public function isProductHeight(): bool
    {
        return Util::issetAndNotEmpty($this->getProductHeight());
    }

    public function isProductWeight(): bool
    {
        return Util::issetAndNotEmpty($this->getProductWeight());
    }

    public function isProductDimensions(): bool
    {
        return $this->isProductHeight() || $this->isProductLength() || $this->isProductWidth();
    }

    public function isProductAttributes(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getProductAttributes());
    }

    public function isProductAttributesTerms(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getProductAttributesTerms());
    }

    //* --- Varianty

    public function isProductVariants(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getProductVariations());
    }

    public function isProductDeepVariants(): bool
    {
        return Util::issetAndNotEmpty($this->getProductDeepVariantsForSelect());
    }

    public function isGalleryImages(): bool
    {
        return Util::arrayIssetAndNotEmpty($this->getGalleryImages());
    }


    //* --- Podobné produkty

    public function isSimilarProductsIds()
    {
        return Util::arrayIssetAndNotEmpty($this->getSimilarProductsIds());
    }
}
