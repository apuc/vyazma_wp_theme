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
        <img src="<?= $sp_obj->get_thumbnail(get_the_ID(), '') ?>" alt="">
    </div>
    <div class="container_content_section-content">
        <h1 href=""> <?= the_title();?></h1>
        <p>
            <?= (500 < strlen(get_the_content())) ?
                substr(strip_tags(get_the_content()), 0, 500) . '...' :
                strip_tags(get_the_content()); ?>
        </p>
        <p class="section-content_svg">
            <img class="section-content_svg_calendar"
                 src="<?= get_template_directory_uri() ?>/raw_html/img/calendar.svg" alt="">

            <span> <?= get_the_date(); ?> </span>
            <img class="section-content_svg_messege"
                 src="<?= get_template_directory_uri() ?>/raw_html/img/messege.svg" alt="">
        </p>
    </div>
</div>
<?php
wp_reset_postdata();