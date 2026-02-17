<?php

use Layouts\TechnologyPage\TechnologyPageFactory;
use Components\SchemaGenerator\SchemaGenerator;

$TechnologyPage = TechnologyPageFactory::create();

get_template_part(COMPONENTS_PATH . "Header/Header");
get_template_part(COMPONENTS_PATH . "Breadcrumbs/Breadcrumbs");
get_template_part(LAYOUTS_PATH . "TechnologyPage/partials/TechnologyPageIntro");
get_template_part(LAYOUTS_PATH . "TechnologyPage/partials/TechnologyPageForm");
get_template_part(LAYOUTS_PATH . "TechnologyPage/partials/TechnologyPageTechnologies");
$TechnologyPage->loopBlocks();
SchemaGenerator::addOrganization();

get_template_part(COMPONENTS_PATH . "Footer/Footer");
