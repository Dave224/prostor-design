<?php

use Components\Block\BlockConfig;
use Components\Block\BlockFactory;
use Components\BlockQuery\BlockQueryFactory;
use Utils\Util;

//* --- Endpoints ------

add_action("rest_api_init", "addGetBlocksAll");
function addGetBlocksAll()
{
    register_rest_route("brilo", "blocks", [
        "methods"  => "GET",
        "callback" => "getBlocks",
        'permission_callback' => '__return_true',

    ]);
}

add_action("rest_api_init", "addGetBlocksByIds");
function addGetBlocksByIds()
{
    register_rest_route("brilo", "blocks/(?P<blocks_ids>[\d,\,\b(title|content)\b,]+)", [
        "methods"  => "GET",
        "callback" => "getBlocks",
        'permission_callback' => '__return_true',
    ]);
}

function getBlocks($request)
{
    $Blocks = [];
    $BlocksIds = $request["blocks_ids"];

    $BlockTitle = [
        "Title" => __("Titulek", "PD_ADMIN_DOMAIN"),
        "Type"  => __("Statický blok", "PD_ADMIN_DOMAIN"),
        "Id"    => "title",
    ];
    $BlockContent = [
        "Title" => __("Obsah", "PD_ADMIN_DOMAIN"),
        "Type"  => __("Statický blok", "PD_ADMIN_DOMAIN"),
        "Id"    => "content",
    ];

    if (Util::issetAndNotEmpty($BlocksIds)) {
        $BlocksIds = explode(",", $BlocksIds);
        foreach ($BlocksIds as $Id) {
            if ($Id == "title" || $Id == "content") {
                if ($Id == "title") {
                    $CurentBlock = $BlockTitle;
                }
                if ($Id == "content") {
                    $CurentBlock = $BlockContent;
                }
                array_push($Blocks, $CurentBlock);
                continue;
            }

            $CurentBlock = BlockFactory::createById($Id);
            if ($CurentBlock->isTypeSelect() && $CurentBlock->isTypeClassExist()) {
                array_push($Blocks, $CurentBlock->getBlockAdmin());
            }
        }

        return new \WP_REST_Response($Blocks, 200);
    }

    $BlocksQuery = BlockQueryFactory::create(-1);

    $Blocks = $BlocksQuery->getBlocks();
    $BlocksTypes = BlockConfig::getBlockTypesTitles();

    $BlocksByTypes = [];

    $StaticBlockTypes = [
        $BlockTitle,
        $BlockContent
    ];

    $BlocksByTypes[__("Statické bloky", "PD_ADMIN_DOMAIN")] = $StaticBlockTypes;


    foreach ($BlocksTypes as $Type) {
        foreach ($Blocks as $Block) {
            if ($Type == $Block["Type"]) {
                if (!array_key_exists($Type, $BlocksByTypes)) {
                    $BlocksByTypes[$Type] = [];
                }
                array_push($BlocksByTypes[$Type], $Block);
            }
        }
    }

    return new \WP_REST_Response($BlocksByTypes, 200);
}


add_action("rest_api_init", "addGetBlocksTypes");
function addGetBlocksTypes()
{
    register_rest_route("brilo", "blockTypes", [
        "methods"  => "GET",
        "callback" => [BlockConfig::class, "getBlockTypesTitlesRest"],
        'permission_callback' => '__return_true',
    ]);
}
