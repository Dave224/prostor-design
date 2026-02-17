<?php

use Utils\Svg;

if (comments_open()) : ?>
    <section id="comments" class="post-detail-comments-section post-detail-other-section">
        <header>
            <h2 class="article-heading"><?php _e("Diskuze k článku", "PD_DOMAIN"); ?></h2>
            <div class="comments-item-reply">
                <?= Svg::renderSvg("pen"); ?>
                <span><?php _e("Odpovědet", "PD_DOMAIN"); ?></span>
            </div>
        </header>

        <?php if (have_comments()) : ?>

            <?php $number = 1; ?>
            <?php renderComments($post->ID, 0, $number); ?>
        <?php endif; ?>

        <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), "comments")) : ?>
            <p class="no-comments"><?php _e("Diskuze je uzavřena.", "PD_DOMAIN"); ?></p>
        <?php endif; ?>

        <?php ob_start(); ?>
        <?php comment_form([
            "format" => "html5",
            "class_submit" => "btn submitButton",
            "submit_button" => '<input type="submit" value="Odeslat komentář" id="%2$s" class="%3$s">',
        ]); ?>

        <?php $commentFormHtml = ob_get_clean(); ?>
        <?php echo str_replace("novalidate", "data-validate=\"jquery\"", $commentFormHtml); ?>
    </section>

<?php endif; ?>
