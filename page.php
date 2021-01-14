<?php
/*
 * The template for displaying all single posts
 */

get_header();
$sp_obj = new SpClass();

while (have_posts()) : the_post(); ?>

    <div class="container">
        <section>
            <div class="container_content1">
                <div class="container_content_section-content1">
                    <p class="section-content_svg">
                        <img class="section-content_svg_calendar"
                             src="<?= get_template_directory_uri() ?>/raw_html/img/calendar.svg"
                             alt=""> <span> <?php the_date() ?> </span>

                    <h1><?php the_title() ?></h1>

                    <p class="container_content_section-content_description">
                        <?= get_the_content() ?>
                    </p>
                    <div class="container_content_section-content__share-news1">
                        <span class="share-news-title1"> Делитесь новостями</span>
                        <?php echo do_shortcode('[widget id="zoom-social-icons-widget-2"]'); ?>
                    </div>
                </div>


            </div>
            <?php get_VK_comments_widget(); ?>

        </section>
    </div>
    <p>

<?php

endwhile;

get_footer();