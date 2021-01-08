<?php
/*
 * The main template file
 */
get_header();
$sp_obj = new SpClass();
?>

    <h1><?php $sp_obj->get_title(); ?></h1>
    <div class="container">
        <section>
            <?php get_main_news(); ?>

            <div class="container_oldArticle">
                <div class="container_oldArticle_top">
                    <div class="apiVkComments">
                        <h2>Последние коментарии</h2>
                        <script type="text/javascript">
                            VK.init({
                                apiId: 7721228,
                                onlyWidgets: true
                            });
                        </script>
                        <div id="vk_comments"></div>
                        <script type="text/javascript">
                            VK.Widgets.Comments("vk_comments");
                        </script>

                    </div>
                    <?php $first_posts_num = 2; // also offset
                    render_news_posts( get_news_posts_query($first_posts_num) ); ?>
                </div>
                <div>
                </div>
            </div>
            <div class="add_OlderArticle">
            </div>
            <?php
            get_load_news_button(get_news_posts_query(4, null, $first_posts_num));
            ?>
        </section>
    </div>
<?php
get_footer();