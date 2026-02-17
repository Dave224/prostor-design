<?php

use Layouts\TechnologyPage\TechnologyPageFactory;
use Components\TechnologyQuery\TechnologyQueryFactory;

$TechnologyPage = TechnologyPageFactory::create();
$TechnologyQuery = TechnologyQueryFactory::createPage($TechnologyPage->getTechnologySelect(), $TechnologyPage->getTechnologyCount());

if ($TechnologyQuery->hasPosts()) {
    $TechnologyQuery->thePosts(); ?>

    <div class="container pagination-block">
        <?= KT::bootstrapPaginationCustom(true, null, $TechnologyQuery->getQuery()); ?>
    </div>
<?php } ?>
