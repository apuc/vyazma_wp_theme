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
                        <!--                    <img src="-->
                        <? //= get_template_directory_uri() ?><!--/raw_html/img/заглушка.png" alt="">-->
                        <script type="text/javascript">
                            VK.init({
                                apiId: 7721228,
                                onlyWidgets: true
                            });
                        </script>
                        <div id="vk_comments"></div>
                        <script type="text/javascript">
                            VK.Widgets.Comments("vk_comments", {limit: 3, width: "50", attach: false});
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
            get_load_news_button(4);
            ?>
        </section>
    </div>
<?php
get_footer();