<?php

use Utils\Util;
use Components\User\UserConfig;

/* Remove Yoast SEO Social Profiles From All Users
 */

add_filter('user_contactmethods', 'brilo_yoast_seo_admin_user_remove_social');
function brilo_yoast_seo_admin_user_remove_social($contactmethods)
{
    $contactmethods = [];
    return $contactmethods;
}

add_action("show_user_profile", "show_extra_profile_fields_action", 1);
add_action("edit_user_profile", "show_extra_profile_fields_action", 1);

function show_extra_profile_fields_action($user)
{
    $paramsFieldset = UserConfig::getParamsFieldset();
    foreach (array_keys(UserConfig::getParamsKeys()) as $key) {
        $value = get_the_author_meta($key, $user->ID);
        if (isset($value)) {
            $paramsFieldset[$key]->setDefaultValue(is_serialized($value) ? unserialize($value) : $value);
        }
    }
    echo $paramsFieldset->getInputsToTable();
}

add_action("personal_options_update", "update_profile_fields_action", 99);
add_action("edit_user_profile_update", "update_profile_fields_action", 99);

function update_profile_fields_action($userId)
{
    if (current_user_can("edit_user", $userId)) {
        $values = filter_input(INPUT_POST, UserConfig::PARAMS_FIELDSET, FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        foreach (UserConfig::getParamsKeys() as $key => $filter) {
            $value = Util::arrayTryGetValue($values, $key);
            if (isset($value)) {
                if (is_array($value)) {
                    $valueFiltered = array_filter($value, function ($value) use ($filter) {
                        return filter_var($value, $filter);
                    });
                } else {
                    $valueFiltered = filter_var($value, $filter);
                }
                update_user_meta($userId, $key, $valueFiltered);
            }
        }
    }
}
