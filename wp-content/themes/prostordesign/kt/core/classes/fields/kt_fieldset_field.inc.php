<?php

/**
 * Field sloužící pro generování dynamických fieldsetů
 * Field na základě receptu na fieldset generuje fieldsety.
 * Recept se skláda z config třídy a jméno fieldsetu.
 * Na config třídě je třeba mít metodu getAllDynamicFieldsets a zde mít fieldset registrovaný.
 * Výsledná kolekce je pak uložena v sežazené poli. Řadit ji lze v administaci pomocí drag and drop.
 * Pro práci je nutný mít vložený a lokalizovaný javascript wp_enqueue_script(KT_DYNAMIC_FIELDSET_SCRIPT);
 * Určeno a testováno pro backend do metaboxů.
 * Rekurzivní definice není dodělaná. Pull request vítán.
 * Třída extenduje kvůli zpětné kompatibilitě třídu KT_Field, avšak mnoho metod z KT_Field nemají efekt, je třeba dávat si na to pozor.
 *
 *
 * @author Jan Pokorný
 */
class KT_Fieldset_Field extends KT_Field
{

    const FIELD_TYPE = "fieldset";

    /**
     * Recept pro vygenerování fieldsetu.
     * Pole [config, fieldset]
     * Př. ["KT_ZZZ_Post_Config", KT_ZZZ_Post_Config::DYNAMIC_FIELDSET"]
     *
     * @var array
     */
    private $fieldsetRecipy;

    /**
     * Seřazené pole hodnot jednotlivých fieldsetů
     *
     * @var array
     */
    private $value;

    /**
     * Výchozí seřazené pole hodnot jednotlivých fieldsetů
     *
     * @var array
     */
    private $defaultValue;

    /**
     *
     * @var array
     */
    private $predefinedValue;

    /**
     * Field který počítá počet dynamických fieldsetů.
     * Nutná informace při ukládaní.
     *
     * @var KT_Hidden_Field
     */
    private $coutField;

    /**
     *
     * @param string $name
     * @param string $label
     * @param array $fieldsetRecipy Recept na fieldset
     */
    public function __construct($name, $label, array $fieldsetRecipy)
    {
        parent::__construct($name, $label);
        $this->fieldsetRecipy = $fieldsetRecipy;
    }

    /**
     * Vraté field type
     *
     * @return string
     */
    public function getFieldType()
    {
        return self::FIELD_TYPE;
    }

    /**
     * Vygeneruje fieldset na základě receptu
     *
     * @return \KT_Form_Fieldset
     */
    public function getFieldset()
    {
        return self::generateFieldset($this->fieldsetRecipy);
    }

    /**
     * Vrátí defaultní hodnotu
     *
     * @return array
     */
    public function getDefaultValue()
    {
        if (KT::arrayIssetAndNotEmpty($this->defaultValue)) {
            return $this->defaultValue;
        } else {
            return $this->getPredefinedValue();
        }
    }

    public function getPredefinedValue()
    {
        if (!isset($this->predefinedValue)) {
            $values = get_option($this->getName());
            $this->predefinedValue = (is_array($values) ? $values : []);
        }
        return $this->predefinedValue;
    }

    /**
     * Provede deserializaci a setne defaultní hodnotu
     *
     * @param array $value
     * @return \KT_Fieldset_Field
     */
    public function setDefaultValue($value)
    {
        $this->defaultValue = maybe_unserialize($value);
        return $this;
    }

    /**
     * Vrátí hodnoty fieldetů
     * POZOR sanitizase probíhá na úrovní filedů ve generované fieldsetu
     *
     * @return array
     */
    public function getValue()
    {
        if (!isset($this->value)) {
            $this->value = $this->prepareValue();
        }
        return $this->value;
    }

    /**
     * Vrátí hodnoty fieldetů
     * POZOR sanitizase probíhá na úrovní filedů ve generované fieldsetu
     *
     * @return array
     */
    public function getCleanValue()
    {
        return $this->getValue();
    }

    /**
     * Vykreslí field
     */
    public function renderField()
    {
        echo $this->getField();
    }

    /**
     *
     * @return boolean
     */
    public function Validate()
    {
        $count = KT::tryGetInt($this->getCoutField()->getValue());
        for ($i = 0; $i < $count; $i++) {
            // Vygenerování příslušného fieldsetu
            $fieldset = $this->getFieldset();
            $postPrefix = $fieldset->getName() . "-" . $i;
            $fieldset->setPostPrefix($postPrefix);
            // Kontrola odelasní dat
            if (!isset($_REQUEST[$postPrefix])) {
                continue;
            }
            foreach ($fieldset->getFields() as $field) {
                if (!$field->Validate()) {
                    $this->setError(__("Error at dynamic form", "KT_CORE_DOMAIN"));
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Vratí field pro vykreslení
     * @return string
     */
    public function getField()
    {
        return $this->getFieldHeader() . $this->getFieldBody() . $this->getFieldFooter();
    }

    /**
     * Ajax callback pro generování fieldsetů
     */
    public static function ajaxGenerateFieldset()
    {
        $class = filter_input(INPUT_GET, "config", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fieldSet = filter_input(INPUT_GET, "fieldset", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $number = filter_input(INPUT_GET, "number", FILTER_SANITIZE_NUMBER_INT);
        if ($class && $fieldSet && $number) {
            $fieldSet = self::generateFieldset([$class, $fieldSet]);
            $fieldSet->setPostPrefix($fieldSet->getName() . "-" . ($number - 1));
            echo self::getFieldsetHtml($fieldSet);
        }
        wp_die();
    }

    /**
     * Vratí záhlaví fieldu
     *
     * @return string
     */
    private function getFieldHeader()
    {
        $fieldWrapp = "<div class=\"fieldset-field\" id=\"{$this->getName()}\" >";
        /*$fieldWrapp .= "<table>";
        $fieldWrapp .= "<thead><tr>";
        $fieldWrapp .= "<td style=\"width:10px\" ></td>"; // Drag and drop sloupec
        foreach ($this->getFieldset()->getFields() as $field) {
            $fieldWrapp .= "<td>{$field->getLabel()}</td>";
        }
        $fieldWrapp .= "<td></td>"; // odebrat tlačíko
        $fieldWrapp .= "</tr></thead>";*/
        return $fieldWrapp;
    }

    /**
     * Vratí tělo fieldu
     * @return string
     */
    private function getFieldBody()
    {
        $fieldWrapp = "<ul class = \"sets fieldset-field-list\" data-fieldset=\"{$this->fieldsetRecipy[1]}\" data-config=\"{$this->fieldsetRecipy[0]}\">";
        // Vygeneruje fieldsety na základě defaultValues nebo alepoň jeden prazdný
        $i = 0;
        do {
            $fieldSet = $this->getFieldset();
            $fieldSet->setPostPrefix($fieldSet->getName() . "-" . $i);
            if (isset($this->getDefaultValue()[$i])) {
                $fieldSet->setFieldsData($this->getDefaultValue()[$i]);
            }
            $fieldWrapp .= self::getFieldsetHtml($fieldSet);
            $i++;
        } while ($i < count($this->getDefaultValue()));
        $fieldWrapp .= "</ul>";
        $fieldWrapp .= "</div>";
        return $fieldWrapp;
    }

    /**
     * Vratí konec fieldu
     *
     * @return string
     */
    private function getFieldFooter()
    {
        $fieldWrapp = $this->getCoutField()->getField();
        $fieldWrapp .= "<button class=\"btn-add-field\">" . __("Přidat položku", "KT_CORE_DOMAIN") . "
         <svg aria-hidden=\"true\" focusable=\"false\" data-prefix=\"fas\" data-icon=\"plus\" class=\"svg-inline--fa fa-plus fa-w-14\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\">
                <path fill=\"currentColor\" d=\"M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z\"></path>
            </svg>
        </button>";
        $fieldWrapp .= "</div>";
        return $fieldWrapp;
    }

    /**
     * Vratí seřazené pole s odeslanými hodnoty
     * @return array
     */
    private function prepareValue()
    {
        $finalValue = [];
        // Počet vygenerovaných fieldů uživatelem
        $count = KT::tryGetInt($this->getCoutField()->getValue());
        for ($i = 0; $i < $count; $i++) {
            // Vygenerování příslušného fieldsetu
            $fieldset = $this->getFieldset();
            $postPrefix = $fieldset->getName() . "-" . $i;
            $fieldset->setPostPrefix($postPrefix);
            // Kontrola odelasní dat
            if (!isset($_REQUEST[$postPrefix])) {
                continue;
            }
            //Sběr dat
            $fieldsetValues = [];
            foreach ($fieldset->getFields() as $field) {
                $fieldsetValues[$field->getName()] = $field->getValue();
            }
            $finalValue[] = $fieldsetValues;
        }
        return $finalValue;
    }

    /**
     * Vygeneruje fieldset na základě receptu
     *
     * @param array $recipy
     * @return type
     * @throws Exception
     */
    private static function generateFieldset(array $recipy)
    {
        $fieldsets = call_user_func([$recipy[0], "getAllDynamicFieldsets"]);
        if (!$fieldsets) {
            throw new Exception("Cannot find getAllDynamicFieldsets() method on {$recipy[0]}");
        }
        if (!isset($fieldsets[$recipy[1]])) {
            throw new Exception("Cannot find fieldset {$recipy[0]} on {$recipy[1]}");
        }
        return $fieldsets[$recipy[1]];
    }

    /**
     * Vygenruje fieldy z fieldsetu do tabulky fieldů
     * @param KT_Form_Fieldset $fieldset
     * @return string
     */
    private static function getFieldsetHtml(KT_Form_Fieldset $fieldset)
    {
        $fieldWrapp = "";
        foreach ($fieldset->getFields() as $field) {
            /* @var $field \KT_Field */
            if ($field->getDefaultValue() == null) {
                $fieldWrapp .= "<li class='fieldset-field-item set'><strong>Tato položka je prázdná</strong>";
            } else {
                if ($field->getFieldType() == "media") {
                    $ImageUrl = wp_get_attachment_url($field->getDefaultValue());
                    $fieldWrapp .= "<li class='fieldset-field-item set'><img src='{$ImageUrl}' />";
                } else {
                    $fieldWrapp .= "<li class='fieldset-field-item set'><strong>{$field->getDefaultValue()}</strong>";
                }
            }
            break;
        }
        $fieldWrapp .= "
                        <a target=\"_blank\" class='edit-dynamic-fieldset-item admin-modal-dynamic-fieldset-open'>
                        " . __("Upravit", "KT_CORE_DOMAIN") . "
                        <svg aria-hidden=\"true\" focusable=\"false\" data-prefix=\"far\" data-icon=\"edit\" class=\"svg-inline--fa fa-edit fa-w-18\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 576 512\">
                            <path fill=\"#000\" d=\"M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z\"></path>
                        </svg>
                    </a>
                    ";
        $fieldWrapp .= "<a class=\"remove-fieldset\">" . __("Remove", "KT_CORE_DOMAIN") . "
                    <svg aria-hidden=\"true\" focusable=\"false\" data-prefix=\"far\" data-icon=\"trash-alt\" class=\"svg-inline--fa fa-trash-alt fa-w-14\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 448 512\">
                    <path fill=\"currentColor\" d=\"M268 416h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12zM432 80h-82.41l-34-56.7A48 48 0 0 0 274.41 0H173.59a48 48 0 0 0-41.16 23.3L98.41 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16v336a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM171.84 50.91A6 6 0 0 1 177 48h94a6 6 0 0 1 5.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0 0 12-12V188a12 12 0 0 0-12-12h-24a12 12 0 0 0-12 12v216a12 12 0 0 0 12 12z\"></path>
                    </svg>
                    </a>";
        //$fieldWrapp .= "</ul>";
        $fieldWrapp .= self::getFieldsetModal($fieldset);
        $fieldWrapp .= "</li>";
        return $fieldWrapp;
    }

    /**
     * Vygenruje fieldy z fieldsetu do modalu s fieldy
     * @param KT_Form_Fieldset $fieldset
     * @return string
     */
    private static function getFieldsetModal(KT_Form_Fieldset $fieldset)
    {
        $fieldModal = "<section class=\"admin-modal-dynamic-fieldset\">
                        <div class=\"admin-modal-content\">

                            <header class=\"admin-modal-header\">
                                <h2 class=\"admin-modal-heading\">" . __("Úprava položky", "KT_CORE_DOMAIN") . "</h2>
                            </header>

                        <div class=\"admin-modal-body\">";

        $fieldModal .= "<ul>";
        foreach ($fieldset->getFields() as $field) {
            /* @var $field \KT_Field */
            $fieldModal .= "<li class='dynamic-fieldset-label'>{$field->getLabel()}</li>";
            $fieldModal .= "<li class='dynamic-fieldset-input'>{$field->getField()}</li>";
        }
        $fieldModal .= "</ul>";
        $fieldModal .= "</div>";
        $fieldModal .= " <div class=\"admin-modal-dynamic-fieldset-close\">
                                        <svg aria-hidden=\"true\" focusable=\"false\" data-prefix=\"far\" data-icon=\"times-circle\" role=\"img\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 512 512\">
                                            <path fill=\"#000\" d=\"M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm101.8-262.2L295.6 256l62.2 62.2c4.7 4.7 4.7 12.3 0 17l-22.6 22.6c-4.7 4.7-12.3 4.7-17 0L256 295.6l-62.2 62.2c-4.7 4.7-12.3 4.7-17 0l-22.6-22.6c-4.7-4.7-4.7-12.3 0-17l62.2-62.2-62.2-62.2c-4.7-4.7-4.7-12.3 0-17l22.6-22.6c4.7-4.7 12.3-4.7 17 0l62.2 62.2 62.2-62.2c4.7-4.7 12.3-4.7 17 0l22.6 22.6c4.7 4.7 4.7 12.3 0 17z\"></path>
                                        </svg>
                                    </div>";
        $fieldModal .= "<footer class=\"admin-modal-footer\">
                                        <button class=\"admin-modal-dynamic-fieldset-close-close button-primary button\">
                                            " . __("Potvrdit změny", "KT_CORE_DOMAIN") . "
                                        </button>

                                    </footer>
                        </div>
                        </section>";

        return $fieldModal;
    }

    /**
     * Vratí hidden field pro počétaní vygenrovaný fieldsetů
     * @return KT_Hidden_Field
     */
    private function getCoutField()
    {
        if (!isset($this->coutField)) {
            $this->coutField = new KT_Hidden_Field("ff_count-" . $this->getName(), "");
            $this->coutField->setPostPrefix($this->getName())
                ->setDefaultValue(($this->getDefaultValue()) ? count($this->getDefaultValue()) : 1)
                ->addAttrClass("ff_count");
        }
        return $this->coutField;
    }
}
