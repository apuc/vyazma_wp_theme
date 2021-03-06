<?php
/*
 * The template for displaying all single posts
 */

get_header();
$sp_obj = new SpClass();

while (have_posts()) : the_post();
    setPostViews(get_the_ID()); ?>

    <div class="container">
    <section>
        <div class="container_content1">
            <div class="container_content_section-content1">
                <div class="container_content__article_img1">
                    <a class="container_content__article_img1_wrapper"
                       href="<?= $sp_obj->get_thumbnail(get_the_ID(), '') ?>">
                        <img src="<?= $sp_obj->get_thumbnail(get_the_ID(), '') ?>" alt="">
                    </a>

                    <?php get_VK_comments_widget("apiVkComments1 transferJs"); ?>

                </div>
                <p class="">
                <p class="section-content_svg" style="display: block ">
                    <img class="section-content_svg_calendar"
                         src="<?= get_template_directory_uri() ?>/raw_html/img/calendar.svg">
                    <span style="top:-4px"> <?php the_date() ?> </span>
                </p>
                <h1 class="section__content__title"><?php the_title() ?></h1>
                <span class="container_content_section-content_description1"><?php the_content() ?>
                </span>
                </p>
                <div class="container_content_section-content__share-news1">
                    <span class="share-news-title1"> Делитесь новостями</span>
                    <?php echo do_shortcode('[widget id="zoom-social-icons-widget-2"]'); ?>
                </div>
            </div>
        </div>
    </section>


    <?php
    if (has_term('', 'news', get_the_ID())) { ?>
        <span class="oldArticleTitle1">Похожие новости </span>

        <div class="oldArticle">
            <?
            $categories = array();
            $terms = get_the_terms(get_the_ID(), 'news');
            foreach ($terms as $term) {
                array_push($categories, $term->term_id);
            }

            render_news_posts(get_news_posts_query(4, $categories)); ?>
        </div>
        <?
    }
endwhile;

?>

    </div>

<?php
get_footer();