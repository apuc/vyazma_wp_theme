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
                <div class="container_content__article_img1">
                    <div class="container_content__article_img1_wrapper">
                        <img src="<?= $sp_obj->get_thumbnail(get_the_ID(), '') ?>" alt="">
                    </div>
                    <div class="apiVkComments1 transferJs">
                        <h2>Последние коментарии</h2>
                        <script type="text/javascript">
                            VK.init({
                                apiId: 7722333,
                                onlyWidgets: true
                            });
                        </script>
                        <div id="vk_comments"></div>
                        <script type="text/javascript">
                            VK.Widgets.Comments("vk_comments", {limit: 5, attach: false});
                        </script>

                    </div>
                </div>
                <p class="section-content_svg">
                    <img class="section-content_svg_calendar"
                         src="<?= get_template_directory_uri() ?>/raw_html/img/calendar.svg"
                         alt=""> <span> <?php the_date() ?> </span>
                    <img class="section-content_svg_messege1"
                         src="<?= get_template_directory_uri() ?>/raw_html/img/messege.svg" alt=""></p>

                <h1><?php the_title() ?></h1>

                <p class="container_content_section-content_description1">
                    <?= str_replace(array('<pre>', '</pre>'), '', get_the_content()) ?>
                </p>

                <!-- Social share -->
                <div class="container_content_section-content__share-news1">

                    [widget id="zoom-social-icons-widget-2"]
                    <!--
                    <span class="share-news-title1"> Делитесь новостями</span>
                    <div>
                        <a href="" class="share-news1"><img
                                    src="<?/*= get_template_directory_uri() */ ?>/raw_html/img/twitter-circled.svg"
                                    alt=""></a>
                        <a href="" class="share-news1"><img
                                    src="<?/*= get_template_directory_uri() */ ?>/raw_html/img/facebook-circled.svg"
                                    alt=""></a>
                        <a href="" class="share-news1"><img
                                    src="<?/*= get_template_directory_uri() */ ?>/raw_html/img/vkontakte-circled.svg"
                                    alt=""></a>
                    </div>-->
                </div>
            </div>


        </div>
    </section>

    <span class="oldArticleTitle1">Похожие новости</span>

    <div class="oldArticle">


    <?php
    $categories = array();
    foreach (get_the_terms(get_the_ID(), 'news') as $term) {
        array_push($categories, $term->term_id);
    }

    render_news_posts(get_news_posts_query(4, $categories));

endwhile;

?> </div>
    </div>
<?php
get_footer();