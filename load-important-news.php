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
        <a href="" class="actual__single-article">
            <img class="actual__single-article_img"
                 src="<?= $sp_obj->get_thumbnail($all_options['important_news_id_' . $i], '') ?>" alt="">
            <div class="actual__single-article_titleWrapper">
                <p class="actual__single-article_titleWrapper_Title">
                    <?= get_post($all_options['important_news_id_' . $i])->post_title ?>
                </p>
                <p class="actual__single-article_titleWrapper_data">
                    <img class="messege_min"
                         src="<?= get_template_directory_uri() ?>/raw_html/img/message_min.svg" alt="">
                    <?= get_post($all_options['important_news_id_' . $i])->post_date ?>
                </p>
            </div>
        </a>
        <?php
    }; ?>

</div>