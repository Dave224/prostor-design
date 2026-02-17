<?php

use Components\Technology\TechnologyFactory;
use Components\SchemaGenerator\SchemaGenerator;

$Technology = TechnologyFactory::create();
SchemaGenerator::addModel($Technology);

get_template_part(COMPONENTS_PATH . "Header/Header");
get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs");
get_template_part(LAYOUTS_PATH . "TechnologyDetail/partials/TechnologyDetailIntro");
get_template_part(LAYOUTS_PATH . "TechnologyDetail/partials/TechnologyDetailContent");
get_template_part(LAYOUTS_PATH . "TechnologyDetail/partials/TechnologyDetailAbout");
get_template_part(LAYOUTS_PATH . "TechnologyDetail/partials/TechnologyDetailTable");
get_template_part(LAYOUTS_PATH . "TechnologyDetail/partials/TechnologyDetailGallery");
get_template_part(LAYOUTS_PATH . "TechnologyDetail/partials/TechnologyDetailForm");
$Technology->loopBlocks();
get_template_part(COMPONENTS_PATH . "Footer/Footer");
