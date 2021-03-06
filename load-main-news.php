<?php
/**
 * @var $args array
 * @var $main_post_id int
 */

$sp_obj = new SpClass();

$main_post_id = $args['main_post_id'];

global $post;

$post = get_post($main_post_id);
setup_postdata($post);
?>

<div class="container_content">
    <div class="containerImgArticle">
        <a href="<?= get_permalink()?>" class="ArticleHref"></a>
        <img src="<?= $sp_obj->get_thumbnail(get_the_ID(), '') ?>" alt="">
    </div>
    <div class="container_content_section-content">
        <h1> <?= get_the_title();?></h1>
        <p>
            <?= get_the_excerpt(); ?>
        </p>
        <p class="section-content_svg">
            <img class="section-content_svg_calendar"
                 src="<?= get_template_directory_uri() ?>/raw_html/img/calendar.svg" alt="">
            <span> <?= get_the_date(); ?> </span>
        </p>
    </div>
</div>
<?php
wp_reset_postdata();