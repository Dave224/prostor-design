<?php
use Utils\Util;
$Categories = get_terms( [
        'taxonomy' => 'category',
        'hide_empty' => true,]
);
?>
<?php if(Util::arrayIssetAndNotEmpty($Categories)) { ?>
    <section class="event-planning-section base-section">
        <div class="container">
            <div class="event-planning">
                <ul>
                    <?php foreach($Categories as $Cat) {?>
                        <li <?php if($Cat->term_id == get_queried_object()->term_id) { ?>class="active-year"<?php } ?>
                        ><a href="<?= get_category_link($Cat); ?>"><?= $Cat->name; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
<?php } ?>
