<?php
/**
 * @var $args array
 * @var $all_options array
 */

$sp_obj = new SpClass();

$all_options = $args['all_options'];
?>
<div class="actual__article">
    <?php for ($i = 1; $i <= 4; $i++) { ?>
        <a href="<?= get_permalink($all_options['important_news_id_' . $i]) ?>" class="actual__single-article">
            <img class="actual__single-article_img"
                 src="<?= $sp_obj->get_thumbnail($all_options['important_news_id_' . $i], '') ?>">
            <div class="actual__single-article_titleWrapper">
                <p class="actual__single-article_titleWrapper_Title">
                    <?= get_post($all_options['important_news_id_' . $i])->post_title ?>
                </p>
                <p class="actual__single-article_description_hover">
                    <?= mb_substr(get_the_excerpt($all_options['important_news_id_' . $i]), 0, 70) . '...' ?>
                </p>
            </div>
            <p class="actual__single-article_titleWrapper_data">
                <img class="messege_min"
                     src="<?= get_template_directory_uri() ?>/raw_html/img/calendar.svg">
                <?= get_the_date('', $all_options['important_news_id_' . $i]) ?>
            </p>
        </a>
        <?php
    }; ?>
</div>