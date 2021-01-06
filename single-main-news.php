<?php

/**
 * @var $args array
 * @var $main_post_id int
 * @var $main_post
 */

$sp_obj = new SpClass();

$main_post_id = $args['main_post_id'];
$main_post = get_post($main_post_id);
?>

<div class="container_content">
    <img src="<?= $sp_obj->get_thumbnail($main_post_id, '') ?>" alt="">
    <div class="container_content_section-content">
        <h1 href=""> <?= $main_post->post_title; ?></h1>
        <p>
            <?= str_replace(array('<pre>', '</pre>'), '', $main_post->post_content); ?>
        </p>
        <p class="section-content_svg">
            <img class="section-content_svg_calendar"
                 src="<?= get_template_directory_uri() ?>/raw_html/img/calendar.svg" alt="">

            <span> <?= $main_post->post_date; ?> </span>
            <img class="section-content_svg_messege"
                 src="<?= get_template_directory_uri() ?>/raw_html/img/messege.svg" alt="">
        </p>
    </div>
</div>