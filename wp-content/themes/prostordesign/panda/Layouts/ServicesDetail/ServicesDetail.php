<?php

use Components\Services\ServicesFactory;
use Components\SchemaGenerator\SchemaGenerator;

$Service = ServicesFactory::create();
SchemaGenerator::addModel($Service);

get_template_part(COMPONENTS_PATH . "Header/Header");
get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs");
get_template_part(LAYOUTS_PATH . "ServicesDetail/partials/ServicesDetailIntro");
get_template_part(LAYOUTS_PATH . "ServicesDetail/partials/ServicesDetailContent");
get_template_part(LAYOUTS_PATH . "ServicesDetail/partials/ServicesDetailAbout");
get_template_part(LAYOUTS_PATH . "ServicesDetail/partials/ServicesDetailGallery");
get_template_part(LAYOUTS_PATH . "ServicesDetail/partials/ServicesDetailForm");
$Service->loopBlocks();
get_template_part(COMPONENTS_PATH . "Footer/Footer");
