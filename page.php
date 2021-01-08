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
                    <p class="section-content_svg"><img class="section-content_svg_calendar"
                                                        src="<?= get_template_directory_uri() ?>/raw_html/img/calendar.svg"
                                                        alt=""> <span> <?php the_date() ?> </span>
                        <img class="section-content_svg_messege1"
                             src="<?= get_template_directory_uri() ?>/raw_html/img/messege.svg" alt=""></p>
                    <h1><?php the_title() ?></h1>

                    <p class="container_content_section-content_description">
                        <?= get_the_content() ?>
                    </p>
                    <div class="container_content_section-content__share-news1"><span class="share-news-title1"> Делитесь новостями</span>
                        <div>
                            <a href="" class="share-news1"><img
                                        src="<?= get_template_directory_uri() ?>/raw_html/img/twitter-circled.svg"
                                        alt=""></a>
                            <a href="" class="share-news1"><img
                                        src="<?= get_template_directory_uri() ?>/raw_html/img/facebook-circled.svg"
                                        alt=""></a>
                            <a href="" class="share-news1"><img
                                        src="<?= get_template_directory_uri() ?>/raw_html/img/vkontakte-circled.svg"
                                        alt=""></a>
                        </div>
                    </div>
                </div>


            </div>
                <h2>Последние коментарии</h2>
                <script type="text/javascript">
                    VK.init({
                        apiId: 7722333,
                        onlyWidgets: true
                    });
                </script>
                <div id="vk_comments1"></div>
                <script type="text/javascript">
                    VK.Widgets.Comments("vk_comments1");
                </script>

        </section>
    </div>
    <p>

<?php

endwhile;

get_footer();