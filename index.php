<?php
/*
 * The main template file
 */
get_header();
$sp_obj = new SpClass();
?>

    <h1><?php $sp_obj->get_title(); ?></h1>
    <div class="container">

        <?php get_main_news(); ?>

        <div class="container_oldArticle">
            <div class="container_oldArticle_top">
                <div class="apiVkComments">
                    <h2>Последние коментарии</h2>
                    <img src="<?= get_template_directory_uri() ?>/raw_html/img/заглушка.png" alt="">
                    <script type="text/javascript">
                        VK.init({
                            apiId: 7707931,
                            onlyWidgets: true
                        });
                    </script>
                    <div id="vk_comments"></div>
                    <script type="text/javascript">
                        /* VK.Widgets.Comments('vk_comments'); */
                    </script>

                </div>
                <?php render_news_posts(3); ?>
            </div>
            <div>
            </div>
        </div>
        <div class="add_OlderArticle">
        </div>
        <?php
        $news_posts_query = get_news_posts_query(4);
        get_load_news_button(serialize($news_posts_query->query_vars), $news_posts_query->max_num_pages);
        ?>
    </div>
<?php
get_footer();