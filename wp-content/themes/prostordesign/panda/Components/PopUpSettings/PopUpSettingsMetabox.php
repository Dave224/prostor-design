<?php

namespace Components\PopUpSettings;


//* --- popup settings ------------------------

\KT_MetaBox::createMultiple(PopUpSettingsConfig::getAllNormalFieldsets(), POPUP_SETTINGS_PAGE_SLUG, \KT_MetaBox_Data_Type_Enum::OPTIONS);

$popUpMetaboxes = \KT_MetaBox::createMultiple(PopUpSettingsConfig::getAllSideFieldsets(), POPUP_SETTINGS_PAGE_SLUG, \KT_MetaBox_Data_Type_Enum::OPTIONS, false);
foreach ($popUpMetaboxes as $popUpMetabox) {
    $popUpMetabox->setContext(\KT_MetaBox::CONTEXT_SIDE);
    $popUpMetabox->register();
}
